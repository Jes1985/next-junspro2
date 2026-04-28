<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$mods = \App\Models\Module::orderBy('order')->get(['id','title','slug','order','position']);
foreach ($mods as $m) {
    $pos = $m->order ?? $m->position ?? $m->id;
    if ($pos >= 32 && $pos <= 36) {
        echo $m->id . ' | order:'.$m->order.' | pos:'.($m->position??'').' | ' . $m->slug . ' | ' . $m->title . PHP_EOL;
    }
}
