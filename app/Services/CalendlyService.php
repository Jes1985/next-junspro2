<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Mission;

class CalendlyService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.calendly.com';

    public function __construct()
    {
        $this->apiKey = config('services.calendly.api_key');
    }

    /**
     * Crée un lien de réservation Calendly pour une mission
     */
    public function createEventLink(Mission $mission)
    {
        try {
            $userUri = $this->getCurrentUserUri();
            
            if (!$userUri) {
                throw new \Exception('Unable to get Calendly user URI');
            }

            // Créer un événement planifié (scheduled event)
            // Note: Vous devrez configurer votre événement type dans Calendly
            $eventTypeUri = config('services.calendly.event_type_uri');
            
            // Générer le lien de réservation
            $link = $this->generateSchedulingLink($userUri, $eventTypeUri, $mission);
            
            return $link;
        } catch (\Exception $e) {
            Log::error('Calendly error: ' . $e->getMessage());
            // Retourner un lien par défaut si l'API échoue
            return config('services.calendly.default_link');
        }
    }

    /**
     * Récupère les détails d'un événement Calendly
     */
    public function getEvent($eventUri)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/scheduled_events/' . basename($eventUri));

            if ($response->successful()) {
                return $response->json()['resource'];
            }
        } catch (\Exception $e) {
            Log::error('Calendly get event error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Récupère l'URI de l'utilisateur Calendly actuel
     */
    protected function getCurrentUserUri()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/users/me');

            if ($response->successful()) {
                return $response->json()['resource']['uri'];
            }
        } catch (\Exception $e) {
            Log::error('Calendly get user error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Génère un lien de planification avec les métadonnées de la mission
     */
    protected function generateSchedulingLink($userUri, $eventTypeUri, Mission $mission)
    {
        // Pour Calendly, on peut créer un lien de planification avec invitee
        // ou utiliser un webhook pour être notifié des réservations
        
        // Méthode simple: retourner le lien de planification avec les paramètres
        $baseLink = config('services.calendly.scheduling_link');
        
        // Ajouter des métadonnées dans l'URL ou utiliser webhooks
        return $baseLink . '?invitee_email=' . urlencode($mission->client_email) . 
               '&name=' . urlencode($mission->client_nom) . 
               '&custom_questions[0][question]=Mission%20ID&custom_questions[0][answer]=' . $mission->id_mission;
    }
}


