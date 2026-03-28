<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$langs = DB::table('languages')->select('id','name','code','is_default')->get();
foreach ($langs as $l) {
    echo $l->id . ' | ' . $l->name . ' | code=[' . $l->code . '] | is_default=' . $l->is_default . PHP_EOL;
}
