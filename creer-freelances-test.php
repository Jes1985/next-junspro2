<?php

/**
 * Script pour créer des freelances de test avec photos
 * 
 * Usage: php creer-freelances-test.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "  👥 CRÉATION DE FREELANCES DE TEST\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    // Vérifier combien de freelances existent déjà
    $existingCount = FreelancerProfile::count();
    echo "📊 Freelances existants : " . $existingCount . "\n\n";

    if ($existingCount > 0) {
        echo "✅ Des freelances existent déjà dans la base de données.\n";
        echo "💡 Pour voir les freelances dans le slider, assurez-vous qu'ils ont :\n";
        echo "   - hourly_rate entre 10 et 299\n";
        echo "   - user avec is_super_freelancer OU is_verified_freelancer = true\n";
        echo "   - Ou simplement un hourly_rate valide\n\n";
        
        // Afficher quelques exemples
        $examples = FreelancerProfile::with('user')
            ->whereNotNull('hourly_rate')
            ->whereBetween('hourly_rate', [10, 299])
            ->limit(5)
            ->get();
        
        if ($examples->count() > 0) {
            echo "📋 Exemples de freelances trouvés :\n";
            foreach ($examples as $f) {
                $user = $f->user;
                echo "   - " . ($user->name ?? 'Sans nom') . " (" . $f->hourly_rate . " €/h)\n";
            }
        }
    } else {
        echo "⚠️  Aucun freelance trouvé. Voulez-vous créer des freelances de test ?\n";
        echo "💡 Pour créer des freelances, vous pouvez :\n";
        echo "   1. Utiliser Laravel Nova (interface admin)\n";
        echo "   2. Créer manuellement via php artisan tinker\n";
        echo "   3. Importer depuis une base de données existante\n\n";
    }

    // Vérifier les utilisateurs qui pourraient devenir freelances
    $potentialFreelancers = User::where('is_freelancer', true)
        ->orWhere('is_verified_freelancer', true)
        ->orWhere('is_super_freelancer', true)
        ->count();
    
    echo "👤 Utilisateurs marqués comme freelances : " . $potentialFreelancers . "\n\n";

    if ($potentialFreelancers > 0 && $existingCount == 0) {
        echo "💡 Il y a des utilisateurs marqués comme freelances mais pas de FreelancerProfile.\n";
        echo "   Créez des FreelancerProfile pour ces utilisateurs via Nova.\n\n";
    }

    echo "═══════════════════════════════════════════════════════════\n";
    echo "\n";

} catch (\Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "\n";
}

