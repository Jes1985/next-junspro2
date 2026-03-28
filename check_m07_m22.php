<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$slugs = [
    '07-mouvement-et-posture','08-systeme-nerveux','09-gestion-des-emotions',
    '10-sommeil-et-recuperation','11-relation-alimentation','12-presence-a-soi',
    '13-confiance-corporelle','14-interactions-sociales','15-activite-physique',
    '16-loisirs-et-vie','17-relation-a-lautre','18-intimite-et-energie',
    '19-medecines-complementaires','20-vivre-choisir-reconstruire',
    '21-entretenir-nos-relations','22-nutrition-et-vitalite',
];

$ok = 0;
$errors = [];

foreach ($slugs as $slug) {
    $m = \Illuminate\Support\Facades\DB::table('formation_modules')->where('slug', $slug)->first();
    if (!$m) {
        $errors[] = "MISSING: $slug";
        continue;
    }
    $acts = json_decode($m->activities, true);
    $cnt  = is_array($acts) ? count($acts) : 0;
    $intro = $m->intro_text ? 'OK' : 'NULL';
    $audio = $m->audio_path ? 'OK' : 'NULL';
    $status = ($cnt === 7 && $intro === 'OK' && $audio === 'OK') ? '✅' : '❌';
    if ($status === '✅') $ok++;
    else $errors[] = "$slug : activities=$cnt intro=$intro audio=$audio";
    echo "$status $slug | activities=$cnt | intro=$intro | audio=$audio\n";
}

echo "\n--- RÉSULTAT : $ok/".count($slugs)." modules parfaits ---\n";
if ($errors) {
    echo "\nProblèmes :\n";
    foreach ($errors as $e) echo "  $e\n";
}
