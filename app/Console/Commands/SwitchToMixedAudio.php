<?php

namespace App\Console\Commands;

use App\Models\FormationModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SwitchToMixedAudio extends Command
{
    protected $signature = 'formation:switch-to-mixed
                            {--module= : Slug du module spécifique (optionnel)}
                            {--lang=fr : Langue : fr, en ou all}';

    protected $description = 'Met à jour les colonnes audio_path en DB pour pointer vers les fichiers *-mixed.mp3';

    public function handle(): int
    {
        $moduleSlug = $this->option('module');
        $langOption = $this->option('lang');

        $query = FormationModule::orderBy('order');
        if ($moduleSlug) {
            $query->where('slug', $moduleSlug);
        }
        $modules = $query->get();

        $langs = match($langOption) {
            'fr'  => ['fr'],
            'en'  => ['en'],
            'all' => ['fr', 'en'],
            default => ['fr'],
        };

        $this->info('🔄  Basculement vers les fichiers mixés');
        $this->newLine();

        foreach ($modules as $module) {
            foreach ($langs as $lang) {
                $mixPath = "formation/audio/{$module->slug}-{$lang}-mixed.mp3";
                $dbColumn = $lang === 'fr' ? 'audio_path' : 'audio_path_en';

                if (!Storage::disk('public')->exists($mixPath)) {
                    $this->warn("  ⚠  [{$lang}] {$module->slug} — fichier mixé absent, ignoré");
                    continue;
                }

                $module->update([$dbColumn => $mixPath]);
                $this->info("  ✅  [{$lang}] {$module->slug} → {$mixPath}");
            }
        }

        $this->newLine();
        $this->info('Basculement terminé.');

        return self::SUCCESS;
    }
}
