<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FormationModule;

$modules = FormationModule::orderBy('track')->orderBy('order')->get(['id','slug','title','track','part','order','audio_path','audio_path_en']);

echo "\n=== DETAIL COMPLET PAR MODULE ===\n\n";
echo str_pad("ID",4) . str_pad("Track",10) . str_pad("Order",7) . str_pad("Slug",45) . str_pad("Titre",50) . "FR  EN\n";
echo str_repeat("-",125)."\n";

$missingFr = [];
$missingEn = [];

foreach ($modules as $m) {
    $frOk = !empty($m->audio_path) ? '✅' : '❌';
    $enOk = !empty($m->audio_path_en) ? '✅' : '❌';
    
    if (!$m->audio_path) $missingFr[] = ['id'=>$m->id,'slug'=>$m->slug,'title'=>$m->title,'track'=>$m->track,'order'=>$m->order];
    if (!$m->audio_path_en) $missingEn[] = ['id'=>$m->id,'slug'=>$m->slug,'title'=>$m->title,'track'=>$m->track,'order'=>$m->order];
    
    echo str_pad($m->id,4) . str_pad($m->track,10) . str_pad($m->order,7) . str_pad($m->slug,45) . str_pad(mb_substr($m->title,0,48),50) . "$frOk  $enOk\n";
}

echo "\n=== MANQUANTS FR (".count($missingFr).") ===\n";
foreach ($missingFr as $m) echo "  [{$m['track']}] ord={$m['order']} {$m['slug']} — \"{$m['title']}\"\n";

echo "\n=== MANQUANTS EN (".count($missingEn).") ===\n";
foreach ($missingEn as $m) echo "  [{$m['track']}] ord={$m['order']} {$m['slug']} — \"{$m['title']}\"\n";
