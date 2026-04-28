<?php
/**
 * patch_breathing_mod00.php
 *
 * Corrige la section respiration 5-5-5 dans l'audio du module 00 (FR + EN).
 * Ne régénère que la fin de chaque audio (~10 min), pas l'heure entière.
 *
 * Stratégie :
 *  1. Extraire le script complet du module depuis GenerateFormationAudio.php
 *  2. Estimer la durée de l'intro (tout avant l'ancre de splice)
 *  3. Couper l'audio original dans la grande pause (15s) juste avant l'ancre
 *  4. Générer le patch audio (fin corrigée) via ElevenLabs — même logique que scriptToFiles()
 *  5. Concaténer original_coupé + silence_pontet + patch via ffmpeg
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\ElevenLabsService;

// ─── Extraction du script heredoc depuis GenerateFormationAudio.php ───────

function extractModuleScript(string $phpFile, string $slug, int $occurrence = 1): string
{
    $content = file_get_contents($phpFile);
    $pattern = '/\'' . preg_quote($slug, '/') . '\'\s*=>\s*<<<\'SCRIPT\'(.*?)^SCRIPT,/ms';
    if (!preg_match_all($pattern, $content, $matches)) {
        return '';
    }
    $idx = $occurrence - 1;
    return isset($matches[1][$idx]) ? trim($matches[1][$idx]) : '';
}

// ─── Estimation durée script jusqu'à une ancre (pauses + TTS) ────────────

function estimateDurationUpTo(string $script, string $anchor): float
{
    $pos = mb_strpos($script, $anchor);
    if ($pos === false) {
        echo "  WARN: ancre introuvable dans script\n";
        return 0.0;
    }
    $portion = mb_substr($script, 0, $pos);

    // Somme des pauses explicites
    preg_match_all('/\[pause\s*([\d.]+)s\]/', $portion, $m);
    $pauseTotal = (float) array_sum(array_map('floatval', $m[1]));

    // Estimation TTS : ~2.7 mots/seconde (voix méditation apaisante)
    $textOnly = preg_replace('/\[pause\s*[\d.]+s\]/', ' ', $portion);
    $textOnly = preg_replace('/\[pause\s*[\d.]+s\]/', ' ', $portion);
    $textOnly = preg_replace('/[^\w\s]/u', ' ', $textOnly);
    $words    = preg_split('/\s+/', trim($textOnly), -1, PREG_SPLIT_NO_EMPTY);
    $ttsTime  = count($words) / 2.7;

    return $pauseTotal + $ttsTime;
}

// ─── scriptToFiles : texte + pauses → tableau de MP3 ──────────────────────
// Réplique fidèle de la méthode privée de GenerateFormationAudio

function scriptToFiles(
    string          $script,
    ElevenLabsService $elevenLabs,
    string          $tmp,
    string          $id,
    array           &$cleanup,
    string          $lang
): array {
    $parts        = [];
    $silCache     = [];
    $idx          = 0;
    $buffer       = '';
    $MIN_REAL_SIL = 4.0;
    $langCode     = ($lang === 'en') ? 'en' : 'fr';

    $segments = preg_split(
        '/\[pause\s*(\d+(?:\.\d+)?)s\]/',
        $script,
        -1,
        PREG_SPLIT_DELIM_CAPTURE
    );

    $flushBuffer = function () use (
        &$buffer, &$parts, &$idx, &$cleanup,
        $tmp, $id, $elevenLabs, $langCode
    ) {
        $clean = trim(preg_replace('/[ \t]{2,}/', ' ', $buffer));
        if ($clean === '') { $buffer = ''; return; }

        $f = "{$tmp}/{$id}_t{$idx}.mp3";
        echo "    TTS [" . mb_strlen($clean) . " chars]\n";
        file_put_contents(
            $f,
            $elevenLabs->textToSpeech(
                $clean,
                ElevenLabsService::DEFAULT_VOICE_ID,
                0.88, 0.75, 0.0,
                $langCode
            )
        );
        $parts[]   = $f;
        $cleanup[] = $f;
        $idx++;
        $buffer = '';
        sleep(1);
    };

    for ($i = 0; $i < count($segments); $i++) {
        if ($i % 2 === 0) {
            $buffer .= $segments[$i];
        } else {
            $sec = (float) $segments[$i];
            if ($sec >= $MIN_REAL_SIL) {
                $flushBuffer();
                $dur = (int) round($sec);
                if (!isset($silCache[$dur])) {
                    $sf = "{$tmp}/{$id}_sil{$dur}s.mp3";
                    exec(sprintf(
                        'ffmpeg -y -f lavfi -i anullsrc=r=24000:cl=mono -t %d'
                        . ' -codec:a libmp3lame -q:a 4 %s 2>&1',
                        $dur, escapeshellarg($sf)
                    ));
                    $silCache[$dur] = $sf;
                    $cleanup[]      = $sf;
                }
                $parts[] = $silCache[$dur];
            } else {
                // Pause courte : ponctuation naturelle dans le TTS
                $buffer .= ($sec <= 1.5) ? ', ' : '. ';
            }
        }
    }
    $flushBuffer();

    return $parts;
}

// ─── Concaténation MP3 via ffmpeg concat demuxer ──────────────────────────

function concatMp3(array $files, string $outFile, string $tmp, string $id, array &$cleanup): bool
{
    $listFile  = "{$tmp}/{$id}_list.txt";
    $cleanup[] = $listFile;

    $lines = [];
    foreach ($files as $f) {
        if ($f && file_exists($f)) {
            // Chemin POSIX pour ffmpeg (même sur Windows)
            $safe    = str_replace('\\', '/', $f);
            $lines[] = "file '" . str_replace("'", "\\'", $safe) . "'";
        }
    }
    file_put_contents($listFile, implode("\n", $lines));

    exec(sprintf(
        'ffmpeg -y -f concat -safe 0 -i %s -codec:a libmp3lame -q:a 2 %s 2>&1',
        escapeshellarg($listFile), escapeshellarg($outFile)
    ), $out, $ret);

    if ($ret !== 0) {
        echo "  WARN ffmpeg concat: " . implode("\n  ", $out) . "\n";
    }
    return file_exists($outFile) && filesize($outFile) > 1000;
}

// ─── Durée d'un fichier MP3 (ffprobe) ────────────────────────────────────

function getAudioDuration(string $path): float
{
    exec(
        'ffprobe -v quiet -print_format compact=print_section=0'
        . ' -show_entries format=duration ' . escapeshellarg($path),
        $out
    );
    preg_match('/duration=([\d.]+)/', implode('', $out), $m);
    return (float) ($m[1] ?? 0);
}

// ─── Configuration par langue ─────────────────────────────────────────────

$config = [
    'fr' => [
        // Premier heredoc du slug dans le fichier (= FR)
        'occurrence' => 1,
        // Texte juste après la grande pause de 15s = point de splice
        'anchor'     => "Je vais maintenant vous proposer un moment de souffle.",
        // Nombre de secondes à recouper dans la grande pause (leadSil = tampon ajouté au patch)
        'leadSil'    => 8,
    ],
    'en' => [
        // Deuxième heredoc du slug dans le fichier (= EN)
        'occurrence' => 2,
        'anchor'     => "I'm now going to invite you into a moment of breath.",
        'leadSil'    => 8,
    ],
];

// ─── Boucle principale ────────────────────────────────────────────────────

$phpFile = __DIR__ . '/app/Console/Commands/GenerateFormationAudio.php';
$slug    = '00-prologue-la-vie-na-pas-dage';

$elevenLabs = new ElevenLabsService();
$tmpBase    = sys_get_temp_dir() . '/mod00_patch';
if (!is_dir($tmpBase)) mkdir($tmpBase, 0777, true);

foreach (['fr', 'en'] as $lang) {
    echo "\n" . str_repeat('=', 50) . "\n";
    echo "  MODULE 00 — {$lang}\n";
    echo str_repeat('=', 50) . "\n";

    $cleanup = [];

    try {
        // 1. Extraire le script complet
        $fullScript = extractModuleScript($phpFile, $slug, $config[$lang]['occurrence']);
        if (!$fullScript) {
            echo "❌ Script introuvable pour {$slug} occ={$config[$lang]['occurrence']}\n";
            continue;
        }
        echo "  Script extrait : " . mb_strlen($fullScript) . " caractères\n";

        // 2. Identifier l'ancre de splice
        $anchor    = $config[$lang]['anchor'];
        $anchorPos = mb_strpos($fullScript, $anchor);
        if ($anchorPos === false) {
            echo "❌ Ancre introuvable : «{$anchor}»\n";
            continue;
        }

        $tailScript = mb_substr($fullScript, $anchorPos);
        echo "  Tail script : " . mb_strlen($tailScript) . " caractères\n";

        // 3. Estimer la durée de l'intro
        $introDuration = estimateDurationUpTo($fullScript, $anchor);
        $leadSil       = $config[$lang]['leadSil'];
        $cutAt         = max(0.0, $introDuration - $leadSil);

        echo "  Intro estimée : " . round($introDuration) . "s\n";
        echo "  Point de coupe : " . round($cutAt) . "s "
            . "(intro - {$leadSil}s = dans la pause de 15s avant l'ancre)\n";

        // 4. Vérifier l'existence de l'audio original
        $audioPath = storage_path("app/public/formation/audio/{$slug}-{$lang}.mp3");
        if (!file_exists($audioPath)) {
            echo "❌ Audio introuvable : {$audioPath}\n";
            continue;
        }
        $totalDuration = getAudioDuration($audioPath);
        echo "  Durée audio original : " . round($totalDuration) . "s\n";

        if ($cutAt >= $totalDuration || $cutAt <= 0) {
            echo "❌ Point de coupe invalide ({$cutAt}s sur {$totalDuration}s)\n";
            continue;
        }

        $id  = "m00_{$lang}_" . time();
        $tmp = $tmpBase;

        // 5. Couper l'audio original au point de splice
        echo "  Découpe de l'original à {$cutAt}s...\n";
        $origCutFile = "{$tmp}/{$id}_origcut.mp3";
        $cleanup[]   = $origCutFile;
        exec(sprintf(
            'ffmpeg -y -i %s -t %.3f -codec:a libmp3lame -q:a 2 %s 2>&1',
            escapeshellarg($audioPath), $cutAt, escapeshellarg($origCutFile)
        ), $cutOut, $cutRet);

        if (!file_exists($origCutFile) || filesize($origCutFile) < 1000) {
            echo "❌ Erreur découpe : " . implode("\n  ", $cutOut) . "\n";
            continue;
        }

        // 6. Silence de raccord (leadSil secondes pour combler la pause avant l'ancre)
        $leadSilFile = "{$tmp}/{$id}_lead.mp3";
        $cleanup[]   = $leadSilFile;
        exec(sprintf(
            'ffmpeg -y -f lavfi -i anullsrc=r=24000:cl=mono -t %d'
            . ' -codec:a libmp3lame -q:a 4 %s 2>&1',
            $leadSil, escapeshellarg($leadSilFile)
        ));

        // 7. Générer le patch TTS (tail corrigée = ancre + breathing 5-5-5 + outro)
        echo "  Génération TTS du patch ({$lang})...\n";
        $tailParts = scriptToFiles($tailScript, $elevenLabs, $tmp, $id, $cleanup, $lang);

        if (empty($tailParts)) {
            echo "❌ Aucun fichier TTS généré\n";
            continue;
        }
        echo "  Fichiers TTS générés : " . count($tailParts) . "\n";

        // 8. Assembler : origCut + leadSil + tailParts
        echo "  Assemblage final...\n";
        $allParts  = array_merge([$origCutFile, $leadSilFile], $tailParts);
        $finalFile = "{$tmp}/{$id}_final.mp3";
        $cleanup[] = $finalFile;

        if (!concatMp3($allParts, $finalFile, $tmp, $id, $cleanup)) {
            echo "❌ Erreur assemblage final\n";
            continue;
        }

        $finalDuration = getAudioDuration($finalFile);
        echo "  Durée finale : " . round($finalDuration) . "s "
            . "(original : " . round($totalDuration) . "s)\n";

        // 9. Backup + remplacement
        $backupPath = $audioPath . '.bak';
        if (!copy($audioPath, $backupPath)) {
            echo "  WARN : impossible de créer le backup\n";
        } else {
            echo "  Backup : {$backupPath}\n";
        }

        if (!copy($finalFile, $audioPath)) {
            echo "❌ Impossible de remplacer {$audioPath}\n";
            continue;
        }

        echo "✅ Audio {$lang} patché avec succès !\n";

    } catch (\Throwable $e) {
        echo "❌ Exception : " . $e->getMessage() . "\n";
        echo $e->getTraceAsString() . "\n";
    } finally {
        foreach ($cleanup as $f) {
            if (file_exists($f)) @unlink($f);
        }
    }
}

echo "\n" . str_repeat('=', 50) . "\n";
echo "  Patch terminé.\n";
echo "  Backups : storage/app/public/formation/audio/{$slug}-fr.mp3.bak\n";
echo "                                                  {$slug}-en.mp3.bak\n";
echo str_repeat('=', 50) . "\n";
