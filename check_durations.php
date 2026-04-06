<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$modules = DB::select("SELECT `order`, slug, title, activities FROM formation_modules WHERE track='praticien' AND is_active=1 ORDER BY `order`");

$grandTotal = 0;

foreach ($modules as $m) {
    $acts = json_decode($m->activities, true) ?? [];
    $modTotal = 0;
    foreach ($acts as $a) {
        $dur = $a['duration'] ?? '';
        if (preg_match('/(\d+)h(\d+)?/', $dur, $match)) {
            $mins = ((int)$match[1]) * 60 + (isset($match[2]) ? (int)$match[2] : 0);
        } elseif (preg_match('/(\d+)\s*min/', $dur, $match)) {
            $mins = (int)$match[1];
        } else {
            $mins = 0;
        }
        $modTotal += $mins;
    }
    $grandTotal += $modTotal;
    $h = floor($modTotal / 60);
    $min = $modTotal % 60;
    $label = $h > 0 ? "{$h}h" . ($min > 0 ? str_pad($min, 2, '0', STR_PAD_LEFT) : '') : "{$min}min";
    echo str_pad($m->order, 3) . " | " . str_pad($m->slug, 50) . " | $label ($modTotal min) | " . count($acts) . " activites\n";
}

echo str_repeat("-", 80) . "\n";
$totalH = floor($grandTotal / 60);
$totalMin = $grandTotal % 60;
echo "TOTAL MODULES EN LIGNE : {$grandTotal} min = {$totalH}h" . ($totalMin > 0 ? str_pad($totalMin, 2, '0', STR_PAD_LEFT) : '') . "\n";
$totalAvecVisio = $grandTotal + 180; // +3h visio
$pctVisio = round(180 / $totalAvecVisio * 100);
$pctLigne = round($grandTotal / $totalAvecVisio * 100);
echo "TOTAL AVEC 3h VISIO : " . round($totalAvecVisio / 60, 1) . "h ($totalAvecVisio min)\n";
echo "  => Modules en ligne : $pctLigne%\n";
echo "  => Visio : $pctVisio%\n";
