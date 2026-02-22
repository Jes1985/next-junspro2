<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAvailabilitySlotsTableSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Créer la table
            DB::statement('
                CREATE TABLE IF NOT EXISTS availability_slots (
                    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    user_id BIGINT UNSIGNED NOT NULL,
                    start_at TIMESTAMP NOT NULL,
                    end_at TIMESTAMP NOT NULL,
                    status VARCHAR(20) NOT NULL DEFAULT "available",
                    timezone VARCHAR(60) NOT NULL DEFAULT "Europe/Paris",
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL,
                    KEY idx_user_id (user_id),
                    KEY idx_start_at (start_at),
                    CONSTRAINT availability_slots_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ');

            echo "✅ Table availability_slots créée/vérifiée avec succès!\n";
        } catch (\Exception $e) {
            echo "❌ Erreur lors de la création de la table: " . $e->getMessage() . "\n";
        }
    }
}
