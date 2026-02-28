<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Count invoices
$count = DB::table('invoices')->count();
echo "Number of invoices in table: $count\n";

if ($count > 0) {
  echo "\nFirst 3 invoices:\n";
  $invoices = DB::table('invoices')->limit(3)->get();
  foreach ($invoices as $inv) {
    echo "  ID: {$inv->id}, Client: {$inv->client_id}, Amount: {$inv->amount}, Status: {$inv->status}\n";
  }
} else {
  echo "\n✓ Table is empty - safe to recreate with correct schema\n";
}
