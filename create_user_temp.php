<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Voir les valeurs ENUM du role
$cols = DB::select("SHOW COLUMNS FROM users LIKE 'role'");
echo "Role column: " . json_encode($cols) . "\n";

$hashed = Hash::make('y');
$now = now();

$existing = User::where('email', 'jesulsim2@gmail.com')->first();
if ($existing) {
    echo "Utilisateur déjà existant: id=" . $existing->id . "\n";
    DB::table('users')->where('email','jesulsim2@gmail.com')->update([
        'password' => $hashed,
        'status' => 1,
        'email_verified_at' => $now,
        'updated_at' => $now,
    ]);
    echo "Mot de passe mis à jour.\n";
} else {
    DB::table('users')->insert([
        'name' => 'Jesulsim',
        'email' => 'jesulsim2@gmail.com',
        'password' => $hashed,
        'is_freelancer' => 1,
        'is_client' => 1,
        'status' => 1,
        'email_verified_at' => $now,
        'created_at' => $now,
        'updated_at' => $now,
    ]);
    $u = User::where('email', 'jesulsim2@gmail.com')->first();
    echo "Compte créé avec succès! id=" . $u->id . "\n";
}

echo "Email: jesulsim2@gmail.com\n";
echo "Mot de passe: y\n";
echo "Done.\n";
