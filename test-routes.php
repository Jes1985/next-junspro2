<?php
// Test temporaire pour vérifier les routes
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = [
    'user.messages.index' => route('user.messages.index'),
    'user.projects_sessions.index' => route('user.projects_sessions.index'),
    'user.subscriptions.index' => route('user.subscriptions.index'),
    'user.settings.index' => route('user.settings.index'),
];

foreach ($routes as $name => $url) {
    echo "$name => $url\n";
}
