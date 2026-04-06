<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// IDs fantômes à supprimer (ne sont PAS dans FormationService::MODULES_SEED)
// - ID 14 : praticien ord=7 07-je-maitrise-la-vision (doublon, ancienne version)
// - ID 41 : praticien ord=7 07-je-transmets-le-rituel (ancienne numérotation)
// - ID 42 : praticien ord=8 08-je-maitrise-la-vision (doublon fantôme)
// - ID 43 : praticien ord=9 09-je-transmets-le-rituel (mauvais chemin audio)
// - ID 24 : praticien ord=9 09-je-me-fais-confiance (ancienne version)
// - ID 23 : praticien ord=10 10-je-fais-face (ancienne version)
// - ID 16 : praticien ord=11 11-je-transmets-le-rituel (ancienne version)
$toDelete = [14, 41, 42, 43, 24, 23, 16];

echo "Suppression des entrées fantômes...\n";
foreach ($toDelete as $id) {
    $m = DB::table('formation_modules')->where('id', $id)->first();
    if ($m) {
        DB::table('formation_modules')->where('id', $id)->delete();
        echo "  ✅ Supprimé ID=$id [{$m->track}] {$m->slug} — {$m->title}\n";
    } else {
        echo "  ⚠️  ID=$id introuvable\n";
    }
}

// Corriger le chemin FR faux sur ID 15 (08-je-renforce-ma-discipline)
// Le fichier n'existe pas sur disque, on efface le chemin pour que la génération le crée correctement
DB::table('formation_modules')->where('id', 15)->update(['audio_path' => null, 'audio_path_en' => null]);
echo "\n✅ ID=15 (08-je-renforce-ma-discipline) : chemins audio remis à NULL\n";

// Corriger le chemin FR faux sur ID 50 (12-je-transmets-le-rituel parcours)
// Le fichier n'existe pas sur disque, on efface le chemin
DB::table('formation_modules')->where('id', 50)->update(['audio_path' => null, 'audio_path_en' => null]);
echo "✅ ID=50 (12-je-transmets-le-rituel parcours) : chemins audio remis à NULL\n";

echo "\nFait.\n";
