<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FreelancerProfile;
use App\Models\User;

echo "\n🔍 Vérification des freelances...\n\n";

// Vérifier tous les freelances
$allFreelances = FreelancerProfile::with('user')->get();
echo "📊 Total freelances : " . $allFreelances->count() . "\n\n";

if ($allFreelances->count() > 0) {
    echo "📋 Détails des freelances :\n";
    foreach ($allFreelances as $f) {
        $user = $f->user;
        echo "\n  ID: " . $f->id . "\n";
        echo "  User ID: " . $f->user_id . "\n";
        echo "  Nom: " . ($user ? ($user->first_name . ' ' . $user->last_name) : 'NULL') . "\n";
        echo "  Hourly Rate: " . ($f->hourly_rate ?? 'NULL') . "\n";
        echo "  Reliability Score: " . ($f->reliability_score ?? 'NULL') . "\n";
        echo "  User exists: " . ($user ? 'OUI' : 'NON') . "\n";
        if ($user) {
            echo "  is_super_freelancer: " . ($user->is_super_freelancer ? 'OUI' : 'NON') . "\n";
            echo "  is_verified_freelancer: " . ($user->is_verified_freelancer ? 'OUI' : 'NON') . "\n";
        }
    }
    
    // Tester la requête exacte du HomeController
    echo "\n\n🔍 Test de la requête du HomeController :\n";
    try {
        $heroFreelancers = FreelancerProfile::query()
            ->with(['user'])
            ->whereHas('user', function ($q) {
                $q->where(function($subQ) {
                    $subQ->where('is_super_freelancer', true)
                         ->orWhere('is_verified_freelancer', true);
                });
            })
            ->whereNotNull('hourly_rate')
            ->whereBetween('hourly_rate', [10, 299])
            ->orderByDesc('reliability_score')
            ->limit(12)
            ->get();
        
        echo "  Résultat requête super/verified : " . $heroFreelancers->count() . " freelances\n";
        
        // Test sans les conditions super/verified
        $allValidFreelances = FreelancerProfile::query()
            ->with(['user'])
            ->whereNotNull('hourly_rate')
            ->whereBetween('hourly_rate', [10, 299])
            ->orderByDesc('reliability_score')
            ->limit(12)
            ->get();
        
        echo "  Résultat requête sans super/verified : " . $allValidFreelances->count() . " freelances\n";
        
        if ($allValidFreelances->count() > 0) {
            echo "\n✅ Des freelances valides existent ! Le problème vient de la requête.\n";
        }
    } catch (\Exception $e) {
        echo "  ❌ Erreur : " . $e->getMessage() . "\n";
    }
} else {
    echo "❌ Aucun freelance trouvé dans la base de données.\n";
}

echo "\n";

