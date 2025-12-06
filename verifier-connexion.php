<?php

/**
 * Script simple pour vérifier la connexion à la base de données
 * 
 * Usage: php verifier-connexion.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "  🔍 VÉRIFICATION DE LA CONNEXION BASE DE DONNÉES\n";
echo "═══════════════════════════════════════════════════════════\n\n";

// 1. Afficher la configuration
echo "📋 Configuration (.env):\n";
echo "   DB_CONNECTION: " . Config::get('database.default') . "\n";
echo "   DB_HOST: " . Config::get('database.connections.mysql.host') . "\n";
echo "   DB_PORT: " . Config::get('database.connections.mysql.port') . "\n";
echo "   DB_DATABASE: " . Config::get('database.connections.mysql.database') . "\n";
echo "   DB_USERNAME: " . Config::get('database.connections.mysql.username') . "\n";
echo "   DB_PASSWORD: " . (Config::get('database.connections.mysql.password') ? '***' : '(vide)') . "\n\n";

// 2. Tester la connexion
echo "🔌 Test de connexion...\n";
try {
    $pdo = DB::connection()->getPdo();
    $databaseName = DB::connection()->getDatabaseName();
    
    echo "   ✅ Connexion réussie !\n";
    echo "   📊 Base de données connectée: " . $databaseName . "\n\n";
    
    // 3. Compter les tables
    $tables = DB::select('SHOW TABLES');
    $tableCount = count($tables);
    
    echo "📊 Statistiques:\n";
    echo "   Nombre de tables: " . $tableCount . "\n";
    
    // 4. Vérifier si c'est junspro_db (74 tables)
    if ($tableCount == 74) {
        echo "   ✅ C'est bien junspro_db (74 tables détectées) !\n";
    } elseif ($tableCount > 0) {
        echo "   ⚠️  Nombre de tables différent de 74 (base: " . $tableCount . ")\n";
    }
    
    // 5. Afficher quelques tables pour confirmation
    echo "\n📋 Quelques tables trouvées:\n";
    $sampleTables = array_slice($tables, 0, 10);
    foreach ($sampleTables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "   - " . $tableName . "\n";
    }
    
    if ($tableCount > 10) {
        echo "   ... et " . ($tableCount - 10) . " autres tables\n";
    }
    
    echo "\n✅ Tout est correct ! Votre application est connectée à: " . $databaseName . "\n";
    
} catch (\Exception $e) {
    echo "   ❌ Erreur de connexion !\n";
    echo "   Message: " . $e->getMessage() . "\n";
    echo "\n💡 Vérifiez que:\n";
    echo "   1. MySQL est démarré dans Laragon (icône verte)\n";
    echo "   2. Le fichier .env contient les bonnes informations\n";
    echo "   3. La base de données existe\n";
    exit(1);
}

echo "\n═══════════════════════════════════════════════════════════\n";
echo "\n";

