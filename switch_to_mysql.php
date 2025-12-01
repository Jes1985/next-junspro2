<?php

/**
 * Script pour basculer de SQLite vers MySQL
 * 
 * Utilisation:
 * 1. Installez et démarrez MySQL
 * 2. Créez la base de données et l'utilisateur (voir INSTALL_MYSQL.md)
 * 3. Exécutez: php switch_to_mysql.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Migration vers MySQL ===\n\n";

// Lire le fichier .env
$envFile = __DIR__ . '/.env';
$envContent = file_get_contents($envFile);

// Vérifier si MySQL est déjà configuré
if (strpos($envContent, 'DB_CONNECTION=mysql') !== false) {
    echo "MySQL est déjà configuré dans .env\n";
    echo "Voulez-vous tester la connexion ? (o/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    
    if (trim($line) !== 'o' && trim($line) !== 'O') {
        echo "Annulé.\n";
        exit(0);
    }
} else {
    // Modifier .env pour MySQL
    $envContent = preg_replace('/DB_CONNECTION=sqlite/', 'DB_CONNECTION=mysql', $envContent);
    $envContent = preg_replace('/#DB_HOST=127\.0\.0\.1/', 'DB_HOST=127.0.0.1', $envContent);
    $envContent = preg_replace('/#DB_PORT=3306/', 'DB_PORT=3306', $envContent);
    $envContent = preg_replace('/#DB_DATABASE=junspro/', 'DB_DATABASE=junspro', $envContent);
    $envContent = preg_replace('/#DB_USERNAME=junspro_user/', 'DB_USERNAME=junspro_user', $envContent);
    $envContent = preg_replace('/#DB_PASSWORD=junspro2025/', 'DB_PASSWORD=junspro2025', $envContent);
    
    file_put_contents($envFile, $envContent);
    echo "✓ Fichier .env mis à jour pour MySQL\n";
}

// Tester la connexion
echo "\nTest de connexion à MySQL...\n";
try {
    DB::connection()->getPdo();
    echo "✓ Connexion MySQL réussie !\n\n";
    
    echo "Exécution des migrations...\n";
    \Artisan::call('migrate:fresh', ['--force' => true]);
    echo "✓ Migrations exécutées avec succès\n\n";
    
    echo "Création de l'utilisateur admin...\n";
    $user = \App\Models\User::firstOrCreate(
        ['email' => 'admin@junspro.com'],
        [
            'name' => 'Administrateur',
            'password' => \Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]
    );
    echo "✓ Utilisateur admin créé/vérifié\n";
    echo "   Email: admin@junspro.com\n";
    echo "   Mot de passe: admin123\n\n";
    
    echo "=== Migration terminée avec succès ===\n";
    echo "Vous pouvez maintenant accéder à Nova: http://127.0.0.1:8000/nova\n";
    
} catch (\Exception $e) {
    echo "✗ Erreur de connexion: " . $e->getMessage() . "\n";
    echo "\nVérifiez que:\n";
    echo "1. MySQL est installé et démarré\n";
    echo "2. La base de données 'junspro' existe\n";
    echo "3. L'utilisateur 'junspro_user' existe avec le bon mot de passe\n";
    echo "4. Les identifiants dans .env sont corrects\n";
    exit(1);
}



