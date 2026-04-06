<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TRACK PRATICIEN — ordre 1-9 ===\n";
$rows = DB::table('formation_modules')
    ->where('track','praticien')
    ->orderBy('order')
    ->get(['order','slug','audio_path','audio_path_en']);
foreach ($rows as $m) {
    $fr = $m->audio_path    ? 'OK' : 'NULL';
    $en = $m->audio_path_en ? 'OK' : 'NULL';
    echo sprintf("  %2d | %-40s | FR:%s | EN:%s\n", $m->order, $m->slug, $fr, $en);
}

echo "\n=== TRACK PARCOURS — ordre 1-9 ===\n";
$rows2 = DB::table('formation_modules')
    ->where('track','parcours')
    ->orderBy('order')
    ->get(['order','slug','audio_path','audio_path_en']);
foreach ($rows2 as $m) {
    $fr = $m->audio_path    ? 'OK' : 'NULL';
    $en = $m->audio_path_en ? 'OK' : 'NULL';
    echo sprintf("  %2d | %-40s | FR:%s | EN:%s\n", $m->order, $m->slug, $fr, $en);
}

echo "\n=== TRACK MENTOR ===\n";
$rows3 = DB::table('formation_modules')
    ->where('track','mentor')
    ->orderBy('order')
    ->get(['order','slug','audio_path','audio_path_en']);
foreach ($rows3 as $m) {
    $fr = $m->audio_path    ? 'OK' : 'NULL';
    $en = $m->audio_path_en ? 'OK' : 'NULL';
    echo sprintf("  %2d | %-45s | FR:%s | EN:%s\n", $m->order, $m->slug, $fr, $en);
}
