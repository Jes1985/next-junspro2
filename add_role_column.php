<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

if (!Schema::hasColumn('users', 'role')) {
    try {
        DB::statement("ALTER TABLE users ADD COLUMN role VARCHAR(20) DEFAULT 'client' CHECK(role IN ('client', 'freelance', 'admin'))");
        echo "✓ Colonne 'role' ajoutée avec succès.\n";
    } catch (\Exception $e) {
        echo "Erreur: " . $e->getMessage() . "\n";
    }
} else {
    echo "La colonne 'role' existe déjà.\n";
}



