<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

if (Schema::hasTable('work_sessions')) {
    echo "Table work_sessions exists\n";
    $columns = DB::select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'work_sessions' AND TABLE_SCHEMA = DATABASE()");
    foreach ($columns as $col) {
        echo "- " . $col->COLUMN_NAME . "\n";
    }
} else {
    echo "Table work_sessions does not exist\n";
}
