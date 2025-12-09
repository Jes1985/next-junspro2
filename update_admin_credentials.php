<?php

/**
 * Script pour mettre à jour tous les emails/mots de passe admin
 * Remplace tous les emails/mots de passe par admin@junspro.com / admin123
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Mise à jour des identifiants admin ===\n\n";

$newEmail = 'admin@junspro.com';
$newPassword = 'admin123';
$passwordHash = Hash::make($newPassword);

// 1. Mettre à jour la table users
echo "1. Mise à jour de la table users...\n";
try {
    if (Schema::hasTable('users')) {
        // Vérifier quelle colonne email existe
        $emailColumn = null;
        if (Schema::hasColumn('users', 'email')) {
            $emailColumn = 'email';
        } elseif (Schema::hasColumn('users', 'email_address')) {
            $emailColumn = 'email_address';
        }
        
        if ($emailColumn) {
            // Supprimer tous les autres admins
            $query = DB::table('users');
            if (Schema::hasColumn('users', 'role')) {
                $deleted = $query->where($emailColumn, '!=', $newEmail)
                    ->where(function($q) use ($emailColumn) {
                        $q->where('role', 'admin')
                          ->orWhere($emailColumn, 'like', '%admin%');
                    })
                    ->delete();
            } else {
                $deleted = $query->where($emailColumn, '!=', $newEmail)
                    ->where($emailColumn, 'like', '%admin%')
                    ->delete();
            }
            
            if ($deleted > 0) {
                echo "   ✓ {$deleted} utilisateur(s) admin supprimé(s)\n";
            }
            
            // Créer ou mettre à jour l'admin
            $adminData = [
                'password' => $passwordHash,
                'email_verified_at' => now(),
            ];
            
            // Gérer les colonnes name
            if (Schema::hasColumn('users', 'name')) {
                $adminData['name'] = 'Administrateur';
            } elseif (Schema::hasColumn('users', 'first_name')) {
                $adminData['first_name'] = 'Administrateur';
                if (Schema::hasColumn('users', 'last_name')) {
                    $adminData['last_name'] = 'Junspro';
                }
            }
            
            if (Schema::hasColumn('users', 'role')) {
                $adminData['role'] = 'admin';
            }
            
            if (Schema::hasColumn('users', 'username')) {
                $adminData['username'] = 'admin';
            }
            
            DB::table('users')->updateOrInsert(
                [$emailColumn => $newEmail],
                $adminData
            );
            
            echo "   ✓ Utilisateur admin créé/mis à jour : {$newEmail}\n";
            echo "   ✓ Mot de passe : {$newPassword}\n";
        } else {
            echo "   ℹ️  Aucune colonne email trouvée dans users\n";
        }
    } else {
        echo "   ℹ️  Table users n'existe pas\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Erreur : " . $e->getMessage() . "\n";
}

// 2. Mettre à jour la table admins (si elle existe)
echo "\n2. Mise à jour de la table admins...\n";
try {
    if (Schema::hasTable('admins')) {
        // Supprimer tous les autres admins
        $deleted = DB::table('admins')
            ->where('email', '!=', $newEmail)
            ->delete();
        
        if ($deleted > 0) {
            echo "   ✓ {$deleted} admin(s) supprimé(s)\n";
        }
        
        // Créer ou mettre à jour l'admin
        DB::table('admins')->updateOrInsert(
            ['email' => $newEmail],
            [
                'first_name' => 'Administrateur',
                'last_name' => 'Junspro',
                'username' => 'admin',
                'email' => $newEmail,
                'password' => $passwordHash,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        echo "   ✓ Admin créé/mis à jour : {$newEmail}\n";
    } else {
        echo "   ℹ️  Table admins n'existe pas\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Erreur : " . $e->getMessage() . "\n";
}

// 3. Mettre à jour basic_settings (to_mail)
echo "\n3. Mise à jour de basic_settings...\n";
try {
    if (Schema::hasTable('basic_settings')) {
        DB::table('basic_settings')
            ->where('to_mail', '!=', $newEmail)
            ->where('to_mail', 'like', '%admin%')
            ->update(['to_mail' => $newEmail]);
        
        echo "   ✓ Email admin mis à jour dans basic_settings\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Erreur : " . $e->getMessage() . "\n";
}

// 4. Mettre à jour subscribers (si nécessaire)
echo "\n4. Nettoyage des subscribers...\n";
try {
    if (Schema::hasTable('subscribers')) {
        if (Schema::hasColumn('subscribers', 'email')) {
            $deleted = DB::table('subscribers')
                ->where('email', 'like', '%admin%')
                ->where('email', '!=', $newEmail)
                ->delete();
            
            if ($deleted > 0) {
                echo "   ✓ {$deleted} subscriber(s) admin supprimé(s)\n";
            }
        } else {
            echo "   ℹ️  Colonne 'email' n'existe pas dans subscribers\n";
        }
    }
} catch (\Exception $e) {
    echo "   ✗ Erreur : " . $e->getMessage() . "\n";
}

echo "\n=== Mise à jour terminée ===\n\n";
echo "📋 Identifiants admin unifiés :\n";
echo "   Email : {$newEmail}\n";
echo "   Mot de passe : {$newPassword}\n\n";
echo "🔗 URLs d'accès :\n";
echo "   Nova : http://localhost:8000/nova\n";
echo "   Admin Backend : http://localhost:8000/admin/login\n\n";

