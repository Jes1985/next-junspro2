<?php

/**
 * Script pour changer le theme_version à 3 (nouveau design Junspro V2)
 * 
 * Usage: php changer-theme-v3.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "  🎨 CHANGEMENT DU THÈME VERS VERSION 3\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    // Vérifier la version actuelle
    $currentVersion = DB::table('basic_settings')->value('theme_version');
    echo "📋 Version actuelle : " . ($currentVersion ?? 'non définie') . "\n\n";
    
    // Changer vers la version 3
    DB::table('basic_settings')->update(['theme_version' => 3]);
    
    echo "✅ Theme version changé vers 3 (Nouveau design Junspro V2)\n";
    echo "\n";
    echo "🔄 Actions à faire :\n";
    echo "   1. Vider le cache : php artisan view:clear\n";
    echo "   2. Recharger votre navigateur (Ctrl+F5 pour forcer)\n";
    echo "   3. Vous devriez voir le nouveau design !\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "\n";
    echo "💡 Vérifiez que la table basic_settings existe et contient une ligne.\n";
}

echo "\n═══════════════════════════════════════════════════════════\n";
echo "\n";

