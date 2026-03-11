<?php

namespace App\Console\Commands;

use App\Models\FormationModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MixFormationGong extends Command
{
    protected $signature = 'formation:mix-gong
                            {--module= : Slug du module spécifique (optionnel, sinon tous)}
                            {--lang=fr : Langue : fr, en ou all}
                            {--force : Remixer même si le fichier mixé existe déjà}
                            {--gong= : Chemin du fichier gong (défaut : formation/audio/gong.mp3)}';

    protected $description = 'Mixe le gong d\'entrée, de reset et de clôture sur les MP3 de voix générés';

    // Volume du gong relatif à la voix (en dB sous 0).
    // -14 dB = présence nette mais sans masquer la voix
    private const GONG_VOLUME_DB = -14;

    // Fade out appliqué à la queue du gong (secondes)
    private const GONG_FADE_OUT = 4.0;

    // La voix commence X secondes après le début (le gong sonne en premier)
    private const VOICE_DELAY = 5.0;

    // Délai entre la fin de la voix et le gong de clôture (secondes)
    private const GONG_CLOSE_AFTER_END = 2.0;

    public function handle(): int
    {
        // ── Vérifier ffmpeg ──────────────────────────────────────
        exec('ffmpeg -version 2>&1', $out, $code);
        if ($code !== 0) {
            $this->error('ffmpeg n\'est pas installé ou introuvable dans le PATH.');
            $this->line('Installez-le avec : winget install Gyan.FFmpeg');
            return self::FAILURE;
        }

        // ── Chemin du gong ───────────────────────────────────────
        $gongRelPath = $this->option('gong') ?? 'formation/audio/gong.mp3';
        $gongAbsPath = Storage::disk('public')->path($gongRelPath);

        if (!file_exists($gongAbsPath)) {
            $this->error("Fichier gong introuvable : {$gongAbsPath}");
            $this->line('Placez votre fichier gong dans storage/app/public/formation/audio/gong.mp3');
            return self::FAILURE;
        }

        // ── Modules à traiter ────────────────────────────────────
        $moduleSlug = $this->option('module');
        $langOption = $this->option('lang');
        $force      = $this->option('force');

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

        $this->info('🔔  Mixage gong — Formation Pause Souffle');
        $this->newLine();

        foreach ($modules as $module) {
            foreach ($langs as $lang) {
                $voixPath  = "formation/audio/{$module->slug}-{$lang}.mp3";
                $mixPath   = "formation/audio/{$module->slug}-{$lang}-mixed.mp3";

                $voixAbs   = Storage::disk('public')->path($voixPath);
                $mixAbs    = Storage::disk('public')->path($mixPath);

                if (!file_exists($voixAbs)) {
                    $this->warn("  ⚠  [{$lang}] {$module->slug} — fichier voix absent, ignoré");
                    continue;
                }

                if (!$force && file_exists($mixAbs)) {
                    $this->line("  ⏭  [{$lang}] {$module->slug} — déjà mixé");
                    continue;
                }

                // ── Durée totale du fichier voix ─────────────────
                $duration = $this->getAudioDuration($voixAbs);
                if (!$duration) {
                    $this->error("  ❌  [{$lang}] {$module->slug} — impossible de lire la durée");
                    continue;
                }

                // ── Calcul des timestamps ─────────────────────────
                // Gong d'ouverture : t=0 (avant la voix)
                // Voix démarre à VOICE_DELAY secondes
                // Gong reset : au milieu de la voix (offset par VOICE_DELAY)
                // Gong de clôture : GONG_CLOSE_AFTER_END secondes après la fin de la voix
                $voiceStart = self::VOICE_DELAY;
                $t_open     = 0;
                $t_mid      = round($voiceStart + $duration / 2);
                $t_close    = round($voiceStart + $duration + self::GONG_CLOSE_AFTER_END);

                // Si le fichier est trop court pour un gong de milieu distinct
                // (moins de 40s d'écart entre ouverture et milieu), on supprime le reset
                $useReset = ($t_mid - $t_open > 40) && ($t_close - $t_mid > 40);

                // ── Construction du filtre ffmpeg ─────────────────
                $gongVol  = pow(10, self::GONG_VOLUME_DB / 20); // dB → facteur linéaire
                $fade     = self::GONG_FADE_OUT;
                $vDelay   = $this->ms(self::VOICE_DELAY);

                // La voix est décalée de VOICE_DELAY secondes (le gong passe en premier)
                // Le fichier de sortie dure jusqu'au gong de clôture (duration=longest)
                $filterParts = [];
                $filterParts[] = "[0:a]adelay={$vDelay}|{$vDelay},apad=pad_dur=15[voice]";
                $filterParts[] = "[1:a]volume={$gongVol},afade=t=out:st=1:d={$fade}[g_open]";

                if ($useReset) {
                    $filterParts[] = "[2:a]adelay={$this->ms($t_mid)}|{$this->ms($t_mid)},volume=" . ($gongVol * 0.7) . ",afade=t=out:st=" . ($t_mid + 1) . ":d={$fade}[g_reset]";
                    $filterParts[] = "[3:a]adelay={$this->ms($t_close)}|{$this->ms($t_close)},volume={$gongVol},afade=t=out:st=" . ($t_close + 1) . ":d={$fade}[g_close]";
                    $mixInputs     = '[voice][g_open][g_reset][g_close]';
                    $nbInputs      = 4;
                    $inputArgs     = '-i ' . escapeshellarg($voixAbs)
                                   . ' -i ' . escapeshellarg($gongAbsPath)
                                   . ' -i ' . escapeshellarg($gongAbsPath)
                                   . ' -i ' . escapeshellarg($gongAbsPath);
                } else {
                    $filterParts[] = "[2:a]adelay={$this->ms($t_close)}|{$this->ms($t_close)},volume={$gongVol},afade=t=out:st=" . ($t_close + 1) . ":d={$fade}[g_close]";
                    $mixInputs     = '[voice][g_open][g_close]';
                    $nbInputs      = 3;
                    $inputArgs     = '-i ' . escapeshellarg($voixAbs)
                                   . ' -i ' . escapeshellarg($gongAbsPath)
                                   . ' -i ' . escapeshellarg($gongAbsPath);
                }

                $filterParts[] = "{$mixInputs}amix=inputs={$nbInputs}:duration=longest:normalize=0[out]";
                $filterComplex  = implode('; ', $filterParts);

                // ── Commande ffmpeg ───────────────────────────────
                $cmd = sprintf(
                    'ffmpeg -y %s -filter_complex %s -map [out] -codec:a libmp3lame -q:a 2 %s 2>&1',
                    $inputArgs,
                    escapeshellarg($filterComplex),
                    escapeshellarg($mixAbs)
                );

                exec($cmd, $output, $exitCode);

                if ($exitCode !== 0) {
                    $this->error("  ❌  [{$lang}] {$module->slug}");
                    $this->line(implode("\n", array_slice($output, -5)));
                    continue;
                }

                $sizeKo = round(filesize($mixAbs) / 1024);
                $resetInfo = $useReset ? " (gong reset à {$t_mid}s)" : '';
                $this->info("  ✅  [{$lang}] {$module->slug} — {$sizeKo} Ko | ouverture:{$t_open}s{$resetInfo} clôture:{$t_close}s");
            }
        }

        $this->newLine();
        $this->info('Mixage terminé. Les fichiers *-mixed.mp3 sont dans storage/app/public/formation/audio/');
        $this->newLine();
        $this->comment('Pour utiliser les fichiers mixés en production, mettez à jour les colonnes audio_path en base :');
        $this->comment('  php artisan formation:switch-to-mixed [--module=...] [--lang=fr]');

        return self::SUCCESS;
    }

    // ── Helpers ──────────────────────────────────────────────────

    private function getAudioDuration(string $filePath): ?float
    {
        $cmd    = sprintf('ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 %s 2>&1', escapeshellarg($filePath));
        $output = shell_exec($cmd);
        $val    = trim($output ?? '');
        return is_numeric($val) ? (float) $val : null;
    }

    /** Convertit secondes en millisecondes entières pour adelay */
    private function ms(float $seconds): int
    {
        return (int) round($seconds * 1000);
    }
}
