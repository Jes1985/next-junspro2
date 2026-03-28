<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TABLES formation/parcours ===\n";
$tables = DB::select('SHOW TABLES');
foreach($tables as $t) {
    $v = array_values((array)$t)[0];
    if(strpos($v,'form')!==false || strpos($v,'parco')!==false) echo $v."\n";
}

echo "\n=== COLONNES formation_modules ===\n";
$cols = DB::select('SHOW COLUMNS FROM formation_modules');
foreach($cols as $c) echo "  {$c->Field} ({$c->Type})\n";

echo "\n=== MODULES PAR TRACK ===\n";
$modules = DB::table('formation_modules')->orderBy('track')->orderBy('order')->get();
foreach ($modules as $m) {
    $arr = (array)$m;
    $id = $arr['id'];
    $slug = $arr['slug'];
    $title = mb_substr($arr['title'], 0, 50);
    $order = $arr['order'];
    $track = $arr['track'] ?? '?';
    $part  = $arr['part'] ?? '?';
    echo "TRACK={$track} part={$part} ord={$order} #{$id} [{$slug}] {$title}\n";
}
echo "\nTotal: ".count($modules)." modules\n";

echo "\n=== TRACKS DISTINCTS ===\n";
$tracks = DB::table('formation_modules')->select('track','part')->distinct()->orderBy('track')->orderBy('part')->get();
foreach($tracks as $t) echo "  track='{$t->track}' part={$t->part}\n";
