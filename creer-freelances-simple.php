<?php

/**
 * Script simple pour créer des freelances de test
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\Hash;

echo "\nCréation de freelances de test...\n\n";

$freelances = [
    ['name' => 'Sophie Martin', 'email' => 'sophie.martin@test.com', 'rate' => 45, 'country' => 'FR'],
    ['name' => 'John Smith', 'email' => 'john.smith@test.com', 'rate' => 65, 'country' => 'US'],
    ['name' => 'Maria Garcia', 'email' => 'maria.garcia@test.com', 'rate' => 55, 'country' => 'ES'],
    ['name' => 'David Chen', 'email' => 'david.chen@test.com', 'rate' => 75, 'country' => 'CN'],
    ['name' => 'Emma Wilson', 'email' => 'emma.wilson@test.com', 'rate' => 60, 'country' => 'GB'],
];

$created = 0;

foreach ($freelances as $data) {
    try {
        // Créer ou récupérer l'utilisateur (utiliser email_address ou username selon la structure)
        $user = User::firstOrCreate(
            ['email_address' => $data['email']],
            [
                'username' => strtolower(str_replace(' ', '.', $data['name'])),
                'first_name' => explode(' ', $data['name'])[0] ?? $data['name'],
                'last_name' => explode(' ', $data['name'])[1] ?? '',
                'password' => Hash::make('password123'),
                'status' => 1,
            ]
        );

        // Mettre à jour les champs Junspro si la colonne existe
        try {
            $user->update([
                'country_code' => $data['country'],
                'is_freelancer' => true,
                'is_verified_freelancer' => true,
            ]);
        } catch (\Exception $e) {
            // Colonnes pas encore créées, on continue
        }

        // Créer le profil freelance
        $profile = FreelancerProfile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'hourly_rate' => $data['rate'],
                'reliability_score' => rand(85, 100),
                'bio' => 'Freelance expert en développement web et design.',
                'is_verified' => true,
            ]
        );

        echo "✅ " . $data['name'] . " créé(e) - " . $data['rate'] . " €/h\n";
        $created++;
    } catch (\Exception $e) {
        echo "❌ Erreur pour " . $data['name'] . ": " . $e->getMessage() . "\n";
    }
}

echo "\n✅ " . $created . " freelances créés avec succès !\n";
echo "💡 Rechargez la page pour voir les freelances dans le slider.\n\n";

