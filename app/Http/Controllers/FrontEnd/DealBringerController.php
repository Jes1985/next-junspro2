<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\MentorshipDealSubmission;
use App\Services\Mentorship\DifficultyScoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealBringerController extends Controller
{
    /** GET /mentorat/apporter-un-projet */
    public function show()
    {
        $internRates  = DifficultyScoringService::DEAL_BRINGER_INTERN_RATES;
        $juniorRates  = DifficultyScoringService::DEAL_BRINGER_JUNIOR_RATES;
        $stdIntern    = DifficultyScoringService::INTERN_RATES;
        $stdJunior    = DifficultyScoringService::JUNIOR_RATES;

        // Historique pour l'utilisateur connecté
        $submissions = Auth::check()
            ? MentorshipDealSubmission::where('user_id', Auth::id())
                ->latest()->take(5)->get()
            : collect();

        return view('frontend.mentorship.deal-bringer', compact(
            'internRates', 'juniorRates', 'stdIntern', 'stdJunior', 'submissions'
        ));
    }

    /** POST /mentorat/apporter-un-projet */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'profile_type'        => 'required|in:intern,junior',
            'contact_name'        => 'required|string|max:120',
            'contact_email'       => 'nullable|email|max:180',
            'contact_company'     => 'nullable|string|max:180',
            'sector'              => 'nullable|string|max:100',
            'how_found'           => 'required|string|max:255',
            'mission_title'       => 'required|string|max:200',
            'mission_description' => 'required|string|max:2000',
            'budget_estimate'     => 'nullable|integer|min:0|max:999999',
            'timeline'            => 'nullable|string|max:80',
            'technologies'        => 'nullable|string|max:400',
            'deliverables'        => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status']  = 'pending';

        // Préfigurer le bonus selon le profil (sera précisé au moment de la validation)
        $rates = $validated['profile_type'] === 'junior'
            ? DifficultyScoringService::DEAL_BRINGER_JUNIOR_RATES
            : DifficultyScoringService::DEAL_BRINGER_INTERN_RATES;

        $validated['bonus_applied'] = sprintf(
            '+10 %% → entre %d %% et %d %% du net',
            min($rates),
            max($rates)
        );

        MentorshipDealSubmission::create($validated);

        return redirect()
            ->route('mentorship.deal-bringer')
            ->with('success', 'Votre déclaration a été transmise à votre mentor pour validation. 🎉');
    }
}
