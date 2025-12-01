<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Mission;

class ZoomService
{
    protected $accountId;
    protected $clientId;
    protected $clientSecret;
    protected $baseUrl = 'https://api.zoom.us/v2';
    protected $accessToken = null;

    public function __construct()
    {
        $this->accountId = config('services.zoom.account_id');
        $this->clientId = config('services.zoom.client_id');
        $this->clientSecret = config('services.zoom.client_secret');
    }

    /**
     * Obtient un token d'accès OAuth
     */
    protected function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        try {
            $response = Http::asForm()->post('https://zoom.us/oauth/token', [
                'grant_type' => 'account_credentials',
                'account_id' => $this->accountId,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

            if ($response->successful()) {
                $this->accessToken = $response->json()['access_token'];
                return $this->accessToken;
            }
        } catch (\Exception $e) {
            Log::error('Zoom OAuth error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Crée une réunion Zoom pour une mission
     */
    public function createMeeting(Mission $mission)
    {
        $token = $this->getAccessToken();
        
        if (!$token) {
            throw new \Exception('Unable to get Zoom access token');
        }

        try {
            // Récupérer l'utilisateur principal
            $userId = $this->getPrimaryUserId();
            
            if (!$userId) {
                throw new \Exception('Unable to get Zoom user ID');
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/users/' . $userId . '/meetings', [
                'topic' => 'Mission Junspro - ' . $mission->client_nom,
                'type' => 2, // Réunion planifiée
                'start_time' => $mission->date_rdv ? $mission->date_rdv->format('Y-m-d\TH:i:s\Z') : null,
                'duration' => 40, // 40 minutes maximum (limite gratuite)
                'timezone' => 'Europe/Paris',
                'settings' => [
                    'host_video' => true,
                    'participant_video' => true,
                    'join_before_host' => false,
                    'mute_upon_entry' => false,
                    'waiting_room' => true, // Salle d'attente pour sécurité
                ],
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Zoom API error: ' . $response->body());
                throw new \Exception('Failed to create Zoom meeting');
            }
        } catch (\Exception $e) {
            Log::error('Zoom create meeting error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Récupère l'ID de l'utilisateur principal Zoom
     */
    protected function getPrimaryUserId()
    {
        $token = $this->getAccessToken();
        
        if (!$token) {
            return null;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($this->baseUrl . '/users/me');

            if ($response->successful()) {
                return $response->json()['id'];
            }
        } catch (\Exception $e) {
            Log::error('Zoom get user error: ' . $e->getMessage());
        }

        return config('services.zoom.user_id'); // Fallback si configuré
    }
}


