<?php

namespace App\Http\Controllers\FrontEnd\Freelance;

use App\Http\Controllers\Controller;
use App\Models\AvailabilitySlot;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AvailabilityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $timezone = $request->string('timezone', 'Europe/Paris');
        $week = $request->string('week', Carbon::now($timezone)->startOfWeek(Carbon::MONDAY)->toDateString());

        $weekStart = Carbon::parse($week, $timezone)->startOfWeek(Carbon::MONDAY);
        $weekEnd = (clone $weekStart)->endOfWeek(Carbon::SUNDAY);

        $startUtc = (clone $weekStart)->utc();
        $endUtc = (clone $weekEnd)->setTimezone('UTC');

        $slots = AvailabilitySlot::query()
            ->where('user_id', $user->id)
            ->where(function ($q) use ($startUtc, $endUtc) {
                $q->where('start_at', '<', $endUtc)
                  ->where('end_at', '>', $startUtc);
            })
            ->orderBy('start_at')
            ->get()
            ->map(fn ($slot) => $this->transformSlot($slot, $timezone))
            ->values();

        return response()->json([
            'week_start' => $weekStart->toDateString(),
            'week_end' => $weekEnd->toDateString(),
            'timezone' => $timezone,
            'slots' => $slots,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $data = $this->validatePayload($request);
        Log::info('AvailabilityController@store - Validated data:', $data);

        $slot = new AvailabilitySlot();
        $slot->user_id = $user->id;
        $slot->timezone = $data['timezone'];

        [$startUtc, $endUtc] = $this->convertToUtc($data['date'], $data['start_time'], $data['end_time'], $data['timezone']);

        if ($startUtc->greaterThanOrEqualTo($endUtc)) {
            return response()->json(['message' => 'L\'heure de fin doit être après l\'heure de début.'], 422);
        }

        if ($this->hasOverlap($user->id, $startUtc, $endUtc)) {
            return response()->json(['message' => 'Créneau en chevauchement avec un autre.'], 422);
        }

        $slot->start_at = $startUtc;
        $slot->end_at = $endUtc;
        $slot->status = $data['status'];
        $slot->save();

        Log::info('AvailabilityController@store - Slot saved:', [
            'id' => $slot->id,
            'status' => $slot->status,
            'start_at' => $slot->start_at,
            'end_at' => $slot->end_at,
        ]);

        return response()->json([
            'message' => 'Créneau créé',
            'slot' => $this->transformSlot($slot, $data['timezone']),
        ], 201);
    }

    public function update(Request $request, AvailabilitySlot $slot): JsonResponse
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($slot->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $this->validatePayload($request);
        Log::info('AvailabilityController@update - Validated data:', $data);

        [$startUtc, $endUtc] = $this->convertToUtc($data['date'], $data['start_time'], $data['end_time'], $data['timezone']);

        if ($startUtc->greaterThanOrEqualTo($endUtc)) {
            return response()->json(['message' => 'L\'heure de fin doit être après l\'heure de début.'], 422);
        }

        if ($this->hasOverlap($user->id, $startUtc, $endUtc, $slot->id)) {
            return response()->json(['message' => 'Créneau en chevauchement avec un autre.'], 422);
        }

        $slot->start_at = $startUtc;
        $slot->end_at = $endUtc;
        $slot->status = $data['status'];
        $slot->timezone = $data['timezone'];
        $slot->save();

        Log::info('AvailabilityController@update - Slot updated:', [
            'id' => $slot->id,
            'status' => $slot->status,
            'start_at' => $slot->start_at,
            'end_at' => $slot->end_at,
        ]);

        return response()->json([
            'message' => 'Créneau mis à jour',
            'slot' => $this->transformSlot($slot, $data['timezone']),
        ]);
    }

    public function destroy(AvailabilitySlot $slot): JsonResponse
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($slot->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $slot->delete();

        return response()->json(['message' => 'Créneau supprimé']);
    }

    private function validatePayload(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'status' => ['required', 'in:' . AvailabilitySlot::STATUS_AVAILABLE . ',' . AvailabilitySlot::STATUS_UNAVAILABLE],
            'timezone' => ['nullable', 'timezone:all'],
        ], [], [
            'date' => 'date',
            'start_time' => 'heure de début',
            'end_time' => 'heure de fin',
            'status' => 'statut',
            'timezone' => 'fuseau horaire',
        ]);
    }

    private function convertToUtc(string $date, string $startTime, string $endTime, ?string $timezone): array
    {
        $tz = $timezone ?: 'Europe/Paris';
        $start = Carbon::parse($date . ' ' . $startTime, $tz);
        $end = Carbon::parse($date . ' ' . $endTime, $tz);

        return [$start->clone()->utc(), $end->clone()->utc()];
    }

    private function hasOverlap(int $userId, Carbon $startUtc, Carbon $endUtc, ?int $ignoreId = null): bool
    {
        $query = AvailabilitySlot::query()
            ->where('user_id', $userId)
            ->where(function ($q) use ($startUtc, $endUtc) {
                $q->where('start_at', '<', $endUtc)
                  ->where('end_at', '>', $startUtc);
            });

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    private function transformSlot(AvailabilitySlot $slot, string $timezone): array
    {
        $tz = $timezone ?: 'Europe/Paris';
        $startLocal = $slot->start_at->copy()->setTimezone($tz);
        $endLocal = $slot->end_at->copy()->setTimezone($tz);

        return [
            'id' => $slot->id,
            'status' => $slot->status,
            'timezone' => $tz,
            'start_at_local' => $startLocal->toIso8601String(),
            'end_at_local' => $endLocal->toIso8601String(),
            'date' => $startLocal->toDateString(),
            'start_time' => $startLocal->format('H:i'),
            'end_time' => $endLocal->format('H:i'),
        ];
    }
}
