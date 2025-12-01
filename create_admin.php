<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

// Vérifier si la colonne role existe
if (!Schema::hasColumn('users', 'role')) {
    echo "La colonne 'role' n'existe pas. Exécution de la migration...\n";
    \Artisan::call('migrate', ['--path' => 'database/migrations/2025_11_24_000001_update_users_table_add_role.php']);
}

// Vérifier si l'utilisateur existe déjà
$existingUser = User::where('email', 'admin@junspro.com')->first();

if ($existingUser) {
    echo "L'utilisateur admin@junspro.com existe déjà.\n";
    echo "ID: " . $existingUser->id . "\n";
    echo "Email: " . $existingUser->email . "\n";
    echo "Nom: " . $existingUser->name . "\n";
    echo "Rôle: " . ($existingUser->role ?? 'non défini') . "\n";
} else {
    // Créer l'utilisateur admin
    $user = User::create([
        'name' => 'Administrateur',
        'email' => 'admin@junspro.com',
        'password' => Hash::make('admin123'),
        'email_verified_at' => now(),
        'role' => 'admin',
    ]);
    
    echo "✓ Utilisateur admin créé avec succès !\n";
    echo "Email: " . $user->email . "\n";
    echo "Mot de passe: admin123\n";
    echo "ID: " . $user->id . "\n";
    echo "Rôle: " . $user->role . "\n";
}

echo "\nVous pouvez maintenant vous connecter à Nova avec ces identifiants.\n";
echo "URL: http://127.0.0.1:8000/nova\n";
