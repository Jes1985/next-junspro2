<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FormationModule;

$slugs = ['12-je-transmets-le-rituel','06-je-visualise-ma-vie','08-je-renforce-ma-discipline','09-je-transmets-le-rituel','07-je-maitrise-la-vision','07-je-transmets-le-rituel'];
foreach ($slugs as $s) {
    foreach (FormationModule::where('slug', $s)->get() as $m) {
        echo "ID={$m->id} [{$m->track}] {$m->slug}\n";
        echo "  audio_path     = {$m->audio_path}\n";
        echo "  audio_path_en  = {$m->audio_path_en}\n";
        // Vérifier si le fichier existe sur disque
        $frFile = storage_path("app/public/{$m->audio_path}");
        $enFile = storage_path("app/public/{$m->audio_path_en}");
        echo "  FR sur disque  = " . (($m->audio_path && file_exists($frFile)) ? "OUI" : "NON") . "\n";
        echo "  EN sur disque  = " . (($m->audio_path_en && file_exists($enFile)) ? "OUI" : "NON") . "\n\n";
    }
}
