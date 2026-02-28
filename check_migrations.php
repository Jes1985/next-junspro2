<?php
// Quick script to check migration status and manually create invoices table if needed

use Illuminate\Support\Facades\DB;

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check if users table exists
$hasUsers = DB::table('information_schema.tables')
  ->where('table_schema', 'junspro_db')
  ->where('table_name', 'users')
  ->exists();

echo "Users table exists: " . ($hasUsers ? 'YES' : 'NO') . "\n";

// Check invoices table
$hasInvoices = DB::table('information_schema.tables')
  ->where('table_schema', 'junspro_db')
  ->where('table_name', 'invoices')
  ->exists();

echo "Invoices table exists: " . ($hasInvoices ? 'YES' : 'NO') . "\n";

// Check migrations table count
$migrationsCount = DB::table('migrations')->count();
echo "Migrations recorded: $migrationsCount\n";

// Check if invoices migration is recorded
$hasInvoicesMigration = DB::table('migrations')
  ->where('migration', '2025_12_10_000003_create_invoices_table')
  ->exists();

echo "Invoices migration recorded: " . ($hasInvoicesMigration ? 'YES' : 'NO') . "\n";

// List all pending migrations
$completedMigrations = DB::table('migrations')->pluck('migration')->toArray();
echo "\nCompleted Migrations (" . count($completedMigrations) . "):\n";
foreach ($completedMigrations as $m) {
  echo "  - $m\n";
}
