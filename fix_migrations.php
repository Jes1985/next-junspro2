<?php
// Script pour marquer toutes les migrations comme déjà exécutées

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Vider la table migrations
DB::table('migrations')->truncate();

// Récupérer tous les fichiers de migration
$files = glob(__DIR__ . '/database/migrations/*.php');
sort($files);

$inserted = 0;
foreach ($files as $file) {
    $name = pathinfo($file, PATHINFO_FILENAME);
    DB::table('migrations')->insert([
        'migration' => $name,
        'batch' => 1,
    ]);
    $inserted++;
}

echo "OK: $inserted migrations marquées comme exécutées.\n";

// Vérifier les données restaurées
$users = DB::table('users')->count();
$freelancers = DB::table('freelancer_profiles')->count();
$subscriptions = DB::table('subscriptions')->count();

echo "Données restaurées:\n";
echo "  - Utilisateurs: $users\n";
echo "  - Freelances: $freelancers\n";
echo "  - Abonnements: $subscriptions\n";

// Afficher les utilisateurs
$usersList = DB::table('users')->select('id','email_address','username','first_name','last_name','status')->get();
echo "\nListe des utilisateurs:\n";
foreach ($usersList as $u) {
    echo "  id={$u->id} email={$u->email_address} username={$u->username} nom={$u->first_name} {$u->last_name}\n";
}
