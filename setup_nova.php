<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

echo "🚀 Configuration de Laravel Nova pour Junspro\n";
echo "==========================================\n\n";

// 1. Vérifier/Créer l'utilisateur admin
echo "1. Vérification de l'utilisateur admin...\n";
try {
    $existingUser = User::where('email', 'admin@junspro.com')->first();

    if ($existingUser) {
        echo "   ✓ Utilisateur admin@junspro.com existe déjà (ID: {$existingUser->id})\n";
    } else {
        // Créer l'utilisateur admin
        $user = User::create([
            'name' => 'Administrateur Nova',
            'email' => 'admin@junspro.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        
        // Ajouter le rôle si la colonne existe
        if (Schema::hasColumn('users', 'role')) {
            $user->role = 'admin';
            $user->save();
        }
        
        echo "   ✓ Utilisateur admin créé avec succès !\n";
        echo "   Email: admin@junspro.com\n";
        echo "   Mot de passe: admin123\n";
    }
} catch (\Exception $e) {
    echo "   ⚠️  Impossible de se connecter à la base de données\n";
    echo "   ℹ️  Exécutez ce script sur le serveur où la base de données est accessible\n";
    echo "   Message: " . $e->getMessage() . "\n";
}

// 2. Vider le cache
echo "\n2. Vidage du cache...\n";
Artisan::call('config:clear');
echo "   ✓ Cache de configuration vidé\n";

Artisan::call('cache:clear');
echo "   ✓ Cache général vidé\n";

Artisan::call('route:clear');
echo "   ✓ Cache des routes vidé\n";

Artisan::call('view:clear');
echo "   ✓ Cache des vues vidé\n";

// 3. Vérifier la configuration
echo "\n3. Vérification de la configuration...\n";
$novaConfig = config('nova');
if ($novaConfig) {
    echo "   ✓ Configuration Nova chargée\n";
    echo "   - Path: " . ($novaConfig['path'] ?? '/nova') . "\n";
    echo "   - App Name: " . ($novaConfig['name'] ?? 'Nova') . "\n";
} else {
    echo "   ⚠️  Configuration Nova non trouvée\n";
}

// 4. Vérifier les routes Nova (sans charger les contrôleurs)
echo "\n4. Vérification des routes Nova...\n";
try {
    // Vérifier que NovaServiceProvider est enregistré
    $providers = config('app.providers');
    if (in_array('App\Providers\NovaServiceProvider', $providers)) {
        echo "   ✓ NovaServiceProvider est enregistré\n";
    } else {
        echo "   ⚠️  NovaServiceProvider n'est pas enregistré dans config/app.php\n";
    }
} catch (\Exception $e) {
    echo "   ⚠️  Erreur lors de la vérification: " . $e->getMessage() . "\n";
}

echo "\n✅ Configuration terminée !\n\n";
echo "📋 Informations de connexion Nova :\n";
echo "   URL: " . (env('APP_URL', 'http://localhost') . '/nova') . "\n";
echo "   Email: admin@junspro.com\n";
echo "   Mot de passe: admin123\n\n";
echo "⚠️  IMPORTANT : Changez le mot de passe après la première connexion !\n";
echo "⚠️  N'oubliez pas d'ajouter votre clé de licence Nova dans le fichier .env\n";
echo "   (NOVA_LICENSE_KEY=votre_cle_ici)\n\n";

