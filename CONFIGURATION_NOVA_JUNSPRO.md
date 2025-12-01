# Configuration Complète Nova pour Junspro

Ce guide vous explique comment finaliser la configuration de Nova pour qu'il fonctionne parfaitement avec Junspro.

## ✅ Vérifications Préalables

Nova est déjà partiellement configuré dans votre projet. Voici ce qui est déjà en place :

- ✅ `NovaServiceProvider` est enregistré dans `config/app.php`
- ✅ Configuration Nova dans `config/nova.php`
- ✅ Routes Nova configurées
- ✅ Ressources Nova créées

## 🔧 Étapes de Configuration

### Étape 1 : Configurer les Variables d'Environnement

Ajoutez ces variables dans votre fichier `.env` :

```env
# Nova Configuration
NOVA_LICENSE_KEY=votre_cle_licence_nova
NOVA_APP_NAME=Junspro Admin
NOVA_DOMAIN_NAME=test.junspro.com
NOVA_GUARD=web
NOVA_PASSWORDS=users
NOVA_STORAGE_DISK=public
```

**Important :**
- `NOVA_LICENSE_KEY` : Votre clé de licence Nova (obtenue lors de l'achat)
- `NOVA_APP_NAME` : Le nom qui apparaîtra dans Nova
- `NOVA_DOMAIN_NAME` : Votre domaine (optionnel, pour restreindre l'accès)
- `NOVA_GUARD` : Le guard d'authentification à utiliser (généralement `web`)

### Étape 2 : Configurer l'Accès à Nova (Gate)

Modifiez le fichier `app/Providers/NovaServiceProvider.php` :

```php
protected function gate(): void
{
    Gate::define('viewNova', function (User $user) {
        // Autoriser l'accès selon le rôle ou l'email
        return in_array($user->email, [
            'admin@junspro.com',  // Remplacez par votre email admin
            'votre-email@example.com',
        ]) || $user->role === 'admin'; // Ou selon votre logique de rôle
    });
}
```

**Options de configuration :**

**Option A : Par email (Simple)**
```php
Gate::define('viewNova', function (User $user) {
    return in_array($user->email, [
        'admin@junspro.com',
        'autre-admin@junspro.com',
    ]);
});
```

**Option B : Par rôle (Recommandé)**
```php
Gate::define('viewNova', function (User $user) {
    // Si vous avez un champ 'role' dans votre table users
    return $user->role === 'admin' || $user->role === 'super_admin';
    
    // OU si vous avez une relation avec une table roles
    // return $user->hasRole('admin');
});
```

**Option C : Toujours autoriser en développement**
```php
Gate::define('viewNova', function (User $user) {
    if (app()->environment('local')) {
        return true; // Autoriser tout le monde en local
    }
    
    return in_array($user->email, [
        'admin@junspro.com',
    ]);
});
```

### Étape 3 : Enregistrer les Ressources Nova

Vérifiez que toutes vos ressources Nova sont bien enregistrées. Nova les détecte automatiquement, mais vous pouvez aussi les enregistrer manuellement dans `NovaServiceProvider` :

```php
protected function resources(): array
{
    return [
        \App\Nova\User::class,
        \App\Nova\ClientProfile::class,
        \App\Nova\FreelancerProfile::class,
        \App\Nova\Subscription::class,
        \App\Nova\WorkSession::class,
        \App\Nova\PremiumService::class,
        \App\Nova\Reward::class,
        \App\Nova\TransferRequest::class,
        \App\Nova\WellnessPlan::class,
        \App\Nova\Transaction::class,
        \App\Nova\OnlineGateway::class,
        \App\Nova\OfflineGateway::class,
        \App\Nova\PaymentInvoice::class,
        \App\Nova\Meeting::class,
        \App\Nova\CalendarSlot::class,
        \App\Nova\Rebooking::class,
        \App\Nova\Mission::class,
        // Ajoutez toutes vos ressources ici
    ];
}
```

**Note :** Nova détecte automatiquement les ressources dans `app/Nova/`, donc cette étape est optionnelle.

### Étape 4 : Créer un Utilisateur Admin pour Nova

Vous devez créer un utilisateur dans votre table `users` qui pourra accéder à Nova :

```bash
php artisan tinker
```

Puis dans tinker :

```php
$user = \App\Models\User::create([
    'name' => 'Admin Nova',
    'email' => 'admin@junspro.com',
    'password' => bcrypt('votre-mot-de-passe-securise'),
    'role' => 'admin', // Selon votre structure
]);

// Vérifier que l'utilisateur peut accéder à Nova
Gate::forUser($user)->allows('viewNova'); // Doit retourner true
```

**OU** utilisez le script existant :

```bash
php create_admin.php
```

### Étape 5 : Vérifier la Configuration de l'Authentification

Assurez-vous que votre configuration d'authentification dans `config/auth.php` est correcte :

```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    // ... autres guards
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
],
```

### Étape 6 : Publier les Assets Nova (si nécessaire)

Si les assets Nova ne sont pas présents :

```bash
php artisan nova:publish
```

### Étape 7 : Vider le Cache

Après toutes les modifications :

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 🚀 Accéder à Nova

Une fois configuré, accédez à Nova via :

**URL :** `https://test.junspro.com/nova`

**Connexion :**
- Email : L'email de l'utilisateur autorisé (configuré dans la gate)
- Mot de passe : Le mot de passe de cet utilisateur

## 🔍 Vérification de la Configuration

### Test 1 : Vérifier que Nova est accessible

```bash
php artisan route:list | grep nova
```

Vous devriez voir les routes Nova listées.

### Test 2 : Vérifier la Gate

```bash
php artisan tinker
```

```php
$user = \App\Models\User::where('email', 'admin@junspro.com')->first();
Gate::forUser($user)->allows('viewNova'); // Doit retourner true
```

### Test 3 : Vérifier les Ressources

Accédez à `https://test.junspro.com/nova` et vérifiez que toutes vos ressources apparaissent dans le menu de gauche.

## 📋 Checklist de Configuration

- [ ] Variables d'environnement configurées dans `.env`
- [ ] Gate `viewNova` configurée dans `NovaServiceProvider`
- [ ] Utilisateur admin créé avec email autorisé
- [ ] Mot de passe défini pour l'utilisateur admin
- [ ] Cache vidé (`php artisan config:clear`)
- [ ] Assets Nova publiés (si nécessaire)
- [ ] Accès à Nova testé via `/nova`
- [ ] Toutes les ressources visibles dans Nova

## 🐛 Dépannage

### Problème : "403 Forbidden" ou "Access Denied"

**Solution :**
1. Vérifiez que votre email est dans la liste de la gate
2. Vérifiez que l'utilisateur existe dans la base de données
3. Vérifiez que la gate retourne `true` pour votre utilisateur

```php
// Dans tinker
$user = \App\Models\User::where('email', 'votre-email@example.com')->first();
Gate::forUser($user)->allows('viewNova');
```

### Problème : "Route not found" ou 404

**Solution :**
1. Vérifiez que `NovaServiceProvider` est dans `config/app.php`
2. Videz le cache : `php artisan route:clear`
3. Vérifiez les routes : `php artisan route:list | grep nova`

### Problème : Les ressources n'apparaissent pas

**Solution :**
1. Vérifiez que les fichiers existent dans `app/Nova/`
2. Vérifiez que les classes sont correctement nommées
3. Videz le cache : `php artisan config:clear`

### Problème : Erreur de licence

**Solution :**
1. Vérifiez que `NOVA_LICENSE_KEY` est défini dans `.env`
2. Vérifiez que la clé est valide
3. En développement local, vous pouvez laisser vide (Nova fonctionne en mode démo)

## 🔐 Sécurité

### Recommandations

1. **Restreindre l'accès par domaine** (optionnel) :
   ```env
   NOVA_DOMAIN_NAME=test.junspro.com
   ```

2. **Utiliser HTTPS** en production

3. **Limiter les emails autorisés** dans la gate

4. **Utiliser des mots de passe forts** pour les admins Nova

5. **Activer l'authentification à deux facteurs** (si disponible dans votre version de Nova)

## 📝 Exemple de Configuration Complète

### `.env`
```env
NOVA_LICENSE_KEY=votre-cle-licence
NOVA_APP_NAME=Junspro Admin
NOVA_DOMAIN_NAME=test.junspro.com
NOVA_GUARD=web
NOVA_PASSWORDS=users
```

### `app/Providers/NovaServiceProvider.php`
```php
protected function gate(): void
{
    Gate::define('viewNova', function (User $user) {
        // Autoriser les admins
        return $user->role === 'admin' 
            || in_array($user->email, [
                'admin@junspro.com',
            ]);
    });
}
```

## 🎯 Prochaines Étapes

Une fois Nova configuré :

1. **Personnaliser les ressources** : Modifiez les fichiers dans `app/Nova/` pour personnaliser l'affichage
2. **Créer des actions personnalisées** : Ajoutez des actions pour automatiser des tâches
3. **Configurer les filtres** : Ajoutez des filtres pour faciliter la recherche
4. **Personnaliser le dashboard** : Modifiez `app/Nova/Dashboards/Main.php`

## 📚 Ressources

- [Documentation Laravel Nova](https://nova.laravel.com/docs)
- Guide des ressources : `NOVA_RESOURCES.md`
- Guide de migration : `MIGRATION_LARAVEL_12_NOVA.md`

