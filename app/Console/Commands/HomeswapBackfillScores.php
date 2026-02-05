<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FreelancerProfile;

class HomeswapBackfillScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homeswap:backfill-scores {--force : Force recalculation even if score already exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalcule les scores HomeSwap pour tous les profils ayant des données HomeSwap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Recherche des profils avec des données HomeSwap...');

        $query = FreelancerProfile::whereNotNull('homeswap_property_type');
        
        if (!$this->option('force')) {
            // Par défaut, ne recalculer que ceux sans score
            $query->where(function($q) {
                $q->whereNull('homeswap_score')
                  ->orWhereNull('homeswap_points_per_night');
            });
        }

        $profiles = $query->get();
        $total = $profiles->count();

        if ($total === 0) {
            $this->info('Aucun profil à traiter.');
            return 0;
        }

        $this->info("Traitement de {$total} profil(s)...");

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $updated = 0;
        $errors = 0;

        foreach ($profiles as $profile) {
            try {
                $result = $profile->computeHomeswapScore();
                
                $profile->homeswap_score = $result['score'];
                $profile->homeswap_points_per_night = $result['points_per_night'];
                
                // Sauvegarder sans déclencher les hooks (pour éviter double calcul)
                $profile->saveQuietly();
                
                $updated++;
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Erreur pour le profil #{$profile->id}: " . $e->getMessage());
                $errors++;
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✓ {$updated} profil(s) mis à jour avec succès.");
        
        if ($errors > 0) {
            $this->warn("⚠ {$errors} erreur(s) rencontrée(s).");
        }

        return 0;
    }
}
