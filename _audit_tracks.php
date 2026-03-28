<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$tracks = DB::table('formation_modules')
    ->selectRaw('track, part, count(*) as nb, min(`order`) as min_o, max(`order`) as max_o')
    ->groupBy('track', 'part')
    ->orderBy('track')->orderBy('part')
    ->get();

echo "=== RÉSUMÉ PAR TRACK/PART ===\n";
foreach ($tracks as $t) {
    echo "track={$t->track} | part={$t->part} | modules={$t->nb} | orders {$t->min_o}→{$t->max_o}\n";
}

echo "\n=== PARCOURS (tous) ===\n";
$mods = DB::table('formation_modules')
    ->where('track','parcours')
    ->orderBy('order')
    ->get(['order','part','slug','is_active']);
foreach ($mods as $m) {
    echo ($m->is_active ? '  [✓]' : '  [ ]')." order={$m->order} part={$m->part} [{$m->slug}]\n";
}

echo "\n=== PRATICIEN (tous) ===\n";
$mods2 = DB::table('formation_modules')
    ->where('track','praticien')
    ->orderBy('order')
    ->get(['order','part','slug','is_active']);
foreach ($mods2 as $m) {
    echo ($m->is_active ? '  [✓]' : '  [ ]')." order={$m->order} part={$m->part} [{$m->slug}]\n";
}
