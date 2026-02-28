<?php
// Check invoices table structure and register migration if needed

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Get invoices table structure
$columns = DB::select("DESCRIBE junspro_db.invoices");
echo "Current invoices table structure:\n";
foreach ($columns as $col) {
  echo "  {$col->Field} ({$col->Type}) - Nullable: {$col->Null}\n";
}

echo "\n✓ Checking for key columns:\n";
echo "  client_id exists: " . (collect($columns)->contains(fn($c) => $c->Field === 'client_id') ? 'YES ✓' : 'NO ✗') . "\n";
echo "  freelancer_id exists: " . (collect($columns)->contains(fn($c) => $c->Field === 'freelancer_id') ? 'YES ✓' : 'NO ✗') . "\n";
echo "  amount_client_total exists: " . (collect($columns)->contains(fn($c) => $c->Field === 'amount_client_total') ? 'YES ✓' : 'NO ✗') . "\n";

// Now register this migration in the migrations table
echo "\nRegistering invoices table migration...\n";
DB::table('migrations')->insert([
  'migration' => '2025_12_10_000003_create_invoices_table',
  'batch' => 30,  // Next batch after existing 30 migrations
]);

echo "✓ Migration registered successfully!\n";

// Verify it was registered
$hasInvoicesMigration = DB::table('migrations')
  ->where('migration', '2025_12_10_000003_create_invoices_table')
  ->exists();

echo "Verification: Invoices migration now recorded: " . ($hasInvoicesMigration ? 'YES ✓' : 'NO ✗') . "\n";
