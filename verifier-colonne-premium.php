<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "\nVérification de la colonne is_premium...\n\n";

try {
    $columns = DB::select('SHOW COLUMNS FROM service_categories');
    $hasIsPremium = false;
    
    foreach ($columns as $col) {
        $field = is_object($col) ? $col->Field : $col['Field'];
        echo "  - $field\n";
        if ($field === 'is_premium') {
            $hasIsPremium = true;
        }
    }
    
    echo "\n";
    if ($hasIsPremium) {
        echo "✅ La colonne 'is_premium' existe !\n";
    } else {
        echo "❌ La colonne 'is_premium' n'existe pas.\n";
    }
} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

echo "\n";

