<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "\n🔍 Vérification des tables Junspro V2...\n\n";

$requiredTables = [
    'freelancer_profiles',
    'client_profiles',
    'subscriptions',
    'work_sessions',
    'audit_logs',
    'notification_logs',
    'chat_messages',
    'complaints'
];

$missing = [];
$existing = [];

foreach ($requiredTables as $table) {
    try {
        DB::select("SELECT 1 FROM `$table` LIMIT 1");
        $existing[] = $table;
        echo "✅ $table\n";
    } catch (\Exception $e) {
        $missing[] = $table;
        echo "❌ $table (n'existe pas)\n";
    }
}

echo "\n";
if (empty($missing)) {
    echo "✅ Toutes les tables existent !\n";
} else {
    echo "⚠️  Tables manquantes : " . implode(', ', $missing) . "\n";
    echo "\n💡 Exécutez : php artisan migrate --path=database/migrations/2025_11_24_000002_create_freelancer_profiles_table.php\n";
}

echo "\n";

