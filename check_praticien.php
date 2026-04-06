<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FormationModule;

echo "\n=== MODULES PRATICIEN (tous) ===\n\n";
$modules = FormationModule::where('track','praticien')->orderBy('order')->get();
foreach ($modules as $m) {
    $fr = $m->audio_path ? 'FR:✅' : 'FR:❌';
    $en = $m->audio_path_en ? 'EN:✅' : 'EN:❌';
    $frDisk = $m->audio_path && file_exists(storage_path("app/public/{$m->audio_path}")) ? 'disk✅' : 'disk❌';
    $enDisk = $m->audio_path_en && file_exists(storage_path("app/public/{$m->audio_path_en}")) ? 'disk✅' : 'disk❌';
    echo "ID={$m->id} ord={$m->order} [{$m->slug}]\n";
    echo "  Titre: {$m->title}\n";
    echo "  $fr($frDisk) $en($enDisk)\n\n";
}

echo "\n=== MODULES PARCOURS à problème ===\n\n";
$slugs = ['12-je-transmets-le-rituel','06-je-visualise-ma-vie'];
foreach ($slugs as $s) {
    foreach (FormationModule::where('slug',$s)->where('track','parcours')->get() as $m) {
        $fr = $m->audio_path ? 'FR:✅' : 'FR:❌';
        $en = $m->audio_path_en ? 'EN:✅' : 'EN:❌';
        $frDisk = $m->audio_path && file_exists(storage_path("app/public/{$m->audio_path}")) ? 'disk✅' : 'disk❌';
        $enDisk = $m->audio_path_en && file_exists(storage_path("app/public/{$m->audio_path_en}")) ? 'disk✅' : 'disk❌';
        echo "ID={$m->id} ord={$m->order} {$m->track} [{$m->slug}]\n";
        echo "  Titre: {$m->title}\n";
        echo "  $fr($frDisk) $en($enDisk)\n\n";
    }
}
