<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "\n🎨 Vérification du thème...\n\n";

try {
    $themeVersion = DB::table('basic_settings')->value('theme_version');
    
    echo "Theme version actuelle: " . ($themeVersion ?? 'non défini') . "\n";
    echo "\n";
    
    if ($themeVersion == 1) {
        echo "📋 Vous utilisez actuellement le THÈME 1 (ancien design)\n";
    } elseif ($themeVersion == 2) {
        echo "📋 Vous utilisez actuellement le THÈME 2\n";
    } elseif ($themeVersion == 3) {
        echo "✅ Vous utilisez le THÈME 3 (nouveau design Junspro V2)\n";
    } else {
        echo "⚠️  Thème non défini ou inconnu\n";
    }
    
    echo "\n💡 Pour changer le thème, mettez à jour theme_version dans la table basic_settings\n";
    echo "   Version 3 = Nouveau design Junspro V2\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

echo "\n";

