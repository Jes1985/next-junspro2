<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Aligne la table `migrations` sur la structure standard Laravel (id, migration, batch)
     * et supprime toute colonne non standard (ex. "Colonne 4" sans défaut qui provoque
     * "Field 'Colonne 4' doesn't have a default value" à l'insert).
     */
    public function up(): void
    {
        $tableName = config('database.migrations', 'migrations');
        $standardColumns = ['id', 'migration', 'batch'];

        $columns = Schema::getColumnListing($tableName);
        if ($columns === []) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();
        $prefix = Schema::getConnection()->getTablePrefix();
        $fullTable = $prefix . $tableName;

        foreach ($columns as $column) {
            if (in_array($column, $standardColumns, true)) {
                continue;
            }
            if ($driver === 'mysql' || $driver === 'mariadb') {
                DB::statement('ALTER TABLE `' . str_replace('`', '``', $fullTable) . '` DROP COLUMN `' . str_replace('`', '``', $column) . '`');
            } elseif ($driver === 'pgsql') {
                DB::statement('ALTER TABLE "' . str_replace('"', '""', $fullTable) . '" DROP COLUMN "' . str_replace('"', '""', $column) . '"');
            }
            // SQLite : ignorer (DROP COLUMN non supporté avant 3.35) ou à traiter manuellement
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
