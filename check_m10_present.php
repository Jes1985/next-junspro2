<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Vérifier le nouveau module
$m = \Illuminate\Support\Facades\DB::table('formation_modules')
    ->where('slug', '10-vivre-ici-et-maintenant')
    ->where('track', 'parcours')
    ->first();

if (!$m) { echo "❌ Module introuvable!\n"; exit; }

$acts = json_decode($m->activities, true);
echo "✅ Module trouvé : {$m->title}\n";
echo "   order={$m->order} | part={$m->part} | week_label={$m->week_label}\n";
echo "   intro_text=" . ($m->intro_text ? 'OK' : 'NULL') . "\n";
echo "   audio_path=" . ($m->audio_path ?: 'NULL') . "\n";
echo "   activities=" . count($acts) . " activités\n\n";

foreach ($acts as $i => $a) {
    echo "   [".($i+1)."] [{$a['type']}] {$a['title']} — {$a['duration']}\n";
}

echo "\n--- Vérification modules Formation 1 (part=1) ---\n";
$part1 = \Illuminate\Support\Facades\DB::table('formation_modules')
    ->where('track', 'parcours')
    ->where('part', 1)
    ->orderBy('order')
    ->get(['order', 'title', 'week_label', 'slug']);

foreach ($part1 as $mod) {
    echo "  [{$mod->week_label}] order={$mod->order} — {$mod->title}\n";
}

echo "\n--- Premier module de Formation 2 (part=2) ---\n";
$first2 = \Illuminate\Support\Facades\DB::table('formation_modules')
    ->where('track', 'parcours')
    ->where('part', 2)
    ->orderBy('order')
    ->first(['order', 'title', 'week_label', 'slug']);
echo "  [{$first2->week_label}] order={$first2->order} — {$first2->title} ({$first2->slug})\n";
