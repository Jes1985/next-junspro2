<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Ordre exact : le rituel passe à la fin (12), les autres comblent le trou au 5
$updates = [
    '00-comprendre-le-corps'                        => 0,
    '01-je-me-connais-pour-accompagner'             => 1,
    '02-je-maitrise-les-outils-du-souffle'          => 2,
    '07-je-maitrise-la-vision'                      => 3,
    '08-je-renforce-ma-discipline'                  => 4,
    '10-la-posture-du-praticien'                    => 5,
    '11-lire-un-client-adapter-le-protocole'        => 6,
    '12-construire-une-pratique-professionnelle'    => 7,
    '13-limites-contre-indications-responsabilite'  => 8,
    '14-la-relation-de-soin'                        => 9,
    '15-signature-du-praticien'                     => 10,
    '16-l-argent-du-soin'                           => 11,
    '09-je-transmets-le-rituel'                     => 12,
];

foreach ($updates as $slug => $order) {
    App\Models\FormationModule::where('slug', $slug)
        ->where('track', 'praticien')
        ->update(['order' => $order]);
}

// Vérification finale
$modules = App\Models\FormationModule::where('track','praticien')
    ->where('is_active', true)
    ->orderBy('order')
    ->get(['id','slug','order']);

echo "=== Ordre final Formation Praticien ===".PHP_EOL;
foreach($modules as $i => $m) {
    echo 'Module '.str_pad($i+1,2,'0',STR_PAD_LEFT).' | order='.$m->order.' | '.$m->slug.PHP_EOL;
}
echo 'TOTAL: '.$modules->count().' modules'.PHP_EOL;
