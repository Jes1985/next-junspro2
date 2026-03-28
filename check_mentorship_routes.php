<?php
define('LARAVEL_START', microtime(true));
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'localhost';
$request = Illuminate\Http\Request::capture();
try { $response = $kernel->handle($request); } catch (\Throwable $e) { echo 'KERNEL_ERR: '.$e->getMessage().' | '.$e->getFile().':'.$e->getLine().PHP_EOL; }
$router = $app->make('router');
$routes = $router->getRoutes();
$found = []; $all = [];
foreach ($routes as $r) { $n=$r->getName()??''; $all[]=$n; if(str_contains($n,'mentorship')||str_contains($r->uri(),'mentorat')) $found[]=($n?:'(no name)').' '.implode('|',$r->methods()).' /'.$r->uri(); }
echo 'Total routes: '.count($all).PHP_EOL;
if(empty($found)) { echo 'NO mentorship routes!'.PHP_EOL; $s=array_filter($all,fn($n)=>str_contains($n,'scheduler.api.homeswap')); echo 'homeswap scheduler: '.(empty($s)?'MISSING':'PRESENT').PHP_EOL; }
else { foreach($found as $f) echo 'FOUND: '.$f.PHP_EOL; }
exit;

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    echo "PHP Error [$errno]: $errstr in $errfile on line $errline\n";
});

try {
    $app->boot();
} catch (\Throwable $e) {
    echo "BOOT ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

// Essayer de charger web.php directement et capturer l'erreur
$routeErrors = [];
try {
    $router = $app->make('router');
    $routes = $router->getRoutes();
    $allRoutes = [];
    foreach ($routes as $route) {
        $allRoutes[] = $route->getName() . ' | ' . $route->uri();
    }
    echo 'Total routes: ' . count($allRoutes) . "\n";
    
    $mentorshipRoutes = array_filter($allRoutes, fn($r) => str_contains($r, 'mentorship') || str_contains($r, 'mentorat'));
    if (empty($mentorshipRoutes)) {
        echo "❌ AUCUNE route mentorship trouvée !\n";
        // Montrer les 5 dernières routes pour voir où ça s'arrête
        echo "\nDernieres routes enregistrees:\n";
        foreach (array_slice($allRoutes, -10) as $r) {
            echo "  $r\n";
        }
    } else {
        echo "✅ Routes mentorship (" . count($mentorshipRoutes) . ") :\n";
        foreach ($mentorshipRoutes as $r) echo "  $r\n";
    }
} catch (\Throwable $e) {
    echo "ROUTE ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
