<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rows = DB::table('formation_modules')
    ->where('track','parcours')
    ->orderBy('order')
    ->get(['slug','intro_text_en']);

$nullCount = 0;
foreach ($rows as $r) {
    $has = $r->intro_text_en ? 'OK  ' : 'NULL';
    if (!$r->intro_text_en) { $nullCount++; echo "$has | ".$r->slug."\n"; }
}
echo "Total NULL: $nullCount / ".count($rows)."\n";
