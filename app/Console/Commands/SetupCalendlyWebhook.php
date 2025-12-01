<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SetupCalendlyWebhook extends Command
{
    protected $signature = 'calendly:setup-webhook 
                            {--token= : Calendly Personal Access Token}
                            {--url= : Webhook URL}';
    
    protected $description = 'Configure automatiquement le webhook Calendly';

    public function handle()
    {
        $this->info('🚀 Configuration du webhook Calendly...');
        $this->newLine();

        // Récupérer les paramètres
        $token = $this->option('token') ?: config('services.calendly.api_key');
        $webhookUrl = $this->option('url') ?: 'https://junspro.com/mission/calendly/callback';

        if (!$token) {
            $this->error('❌ Token Calendly non trouvé. Utilisez --token=VOTRE_TOKEN ou configurez CALENDLY_API_KEY dans .env');
            return 1;
        }

        $this->info("URL du webhook: $webhookUrl");
        $this->newLine();

        // Étape 1: Récupérer les informations utilisateur
        $this->info('1. Récupération des informations utilisateur...');
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->get('https://api.calendly.com/users/me');

        if (!$response->successful()) {
            $this->error('❌ Erreur: Impossible de récupérer les informations utilisateur.');
            $this->error('Code HTTP: ' . $response->status());
            $this->error('Réponse: ' . $response->body());
            return 1;
        }

        $user = $response->json();
        $orgUri = $user['resource']['current_organization'];
        $userName = $user['resource']['name'];

        $this->info("✓ Utilisateur trouvé: $userName");
        $this->info("✓ Organisation: $orgUri");
        $this->newLine();

        // Étape 2: Vérifier les webhooks existants
        $this->info('2. Vérification des webhooks existants...');
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->get('https://api.calendly.com/webhook_subscriptions', [
            'organization' => $orgUri,
        ]);

        if ($response->successful()) {
            $webhooks = $response->json();
            if (isset($webhooks['collection'])) {
                foreach ($webhooks['collection'] as $webhook) {
                    if ($webhook['callback_url'] === $webhookUrl) {
                        $this->warn('⚠️  Un webhook avec cette URL existe déjà!');
                        $this->info('   URI: ' . $webhook['uri']);
                        $this->info('   Statut: ' . $webhook['state']);
                        $this->newLine();
                        
                        if (!$this->confirm('Voulez-vous créer un nouveau webhook?', false)) {
                            $this->info('Annulation.');
                            return 0;
                        }
                        break;
                    }
                }
            }
        }

        // Étape 3: Créer le webhook
        $this->info('3. Création du webhook...');
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post('https://api.calendly.com/webhook_subscriptions', [
            'url' => $webhookUrl,
            'events' => ['invitee.created'],
            'organization' => $orgUri,
        ]);

        if ($response->successful()) {
            $webhook = $response->json();
            $this->newLine();
            $this->info('✅ Webhook créé avec succès!');
            $this->newLine();
            $this->info('📋 Détails:');
            $this->line('   URI: ' . $webhook['resource']['uri']);
            $this->line('   URL: ' . $webhook['resource']['callback_url']);
            $this->line('   Événements: ' . implode(', ', $webhook['resource']['events']));
            $this->line('   Statut: ' . $webhook['resource']['state']);
            $this->newLine();
            $this->info('🎉 Configuration terminée!');
            $this->info('Le webhook sera appelé quand un invité crée une réservation.');
            $this->newLine();
            
            return 0;
        } else {
            $this->error('❌ Erreur lors de la création du webhook.');
            $this->error('Code HTTP: ' . $response->status());
            $this->error('Réponse: ' . $response->body());
            
            if (strpos($response->body(), 'already exists') !== false) {
                $this->newLine();
                $this->warn('⚠️  Le webhook existe peut-être déjà. Vérifiez dans Calendly.');
            }
            
            return 1;
        }
    }
}


