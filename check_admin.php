<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ADMINS ===\n";
$admins = DB::table('admins')->select('id','email','role_id')->get();
foreach ($admins as $a) {
    echo "id=$a->id email=$a->email role_id=$a->role_id\n";
}

echo "\n=== USER 1 EMAIL ===\n";
$u1 = DB::table('users')->where('id',1)->first();
if ($u1) echo "id=$u1->id email=$u1->email_address name=$u1->first_name $u1->last_name\n";

echo "\n=== COLONNES TABLE USERS ===\n";
$cols = DB::getSchemaBuilder()->getColumnListing('users');
foreach ($cols as $c) { echo "  $c\n"; }

echo "\n=== USERS (premiers 5) ===\n";
$users = DB::table('users')->limit(5)->get();
foreach ($users as $u) {
    $arr = (array)$u;
    $preview = array_slice($arr, 0, 6);
    echo implode(' | ', array_map(fn($k,$v) => "$k=".substr((string)$v,0,30), array_keys($preview), $preview)) . "\n";
}
