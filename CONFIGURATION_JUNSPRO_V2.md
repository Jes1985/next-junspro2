# Guide de Configuration Junspro V2

Ce guide détaille toutes les étapes nécessaires pour configurer Junspro V2 avec les abonnements, webhooks Stripe, CRON jobs, etc.

---

## 📋 Table des matières

1. [Configuration des variables d'environnement](#1-configuration-des-variables-denvironnement)
2. [Configuration des webhooks Stripe](#2-configuration-des-webhooks-stripe)
3. [Configuration du CRON (tâches planifiées)](#3-configuration-du-cron-tâches-planifiées)
4. [Vérification des migrations](#4-vérification-des-migrations)
5. [Configuration des notifications](#5-configuration-des-notifications)
6. [Configuration de la queue (optionnel)](#6-configuration-de-la-queue-optionnel)
7. [Test et vérification](#7-test-et-vérification)

---

## 1. Configuration des variables d'environnement

### 1.1 Ajouter les variables Stripe dans `.env`

Ouvrez votre fichier `.env` et ajoutez/modifiez les lignes suivantes :

```env
# Stripe Configuration (Junspro V2 - Abonnements)
STRIPE_KEY=pk_test_votre_cle_publique_stripe
STRIPE_SECRET=sk_test_votre_cle_secrete_stripe
STRIPE_WEBHOOK_SECRET=whsec_votre_secret_webhook_stripe
```

**Où trouver ces clés :**
- **STRIPE_KEY** : Stripe Dashboard → Developers → API keys → Publishable key
- **STRIPE_SECRET** : Stripe Dashboard → Developers → API keys → Secret key
- **STRIPE_WEBHOOK_SECRET** : Voir section 2.2

### 1.2 Vérifier la configuration dans `config/services.php`

Le fichier `config/services.php` doit contenir :

```php
'stripe' => [
    'model' => App\Models\User::class,
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
],
```

✅ **Vérification** : Ce fichier est déjà configuré correctement.

---

## 2. Configuration des webhooks Stripe

### 2.1 Créer le webhook dans Stripe Dashboard

1. **Connectez-vous à Stripe** : https://dashboard.stripe.com/
2. **Allez dans** : Developers → Webhooks
3. **Cliquez sur** : "Add endpoint" ou "Ajouter un point de terminaison"

### 2.2 Configuration du webhook

**URL du webhook** :
```
https://votre-domaine.com/junspro/stripe/webhook
```

**Pour le développement local avec ngrok** :
```
https://votre-id-ngrok.ngrok.io/junspro/stripe/webhook
```

**Description** (optionnel) :
```
Webhook Junspro V2 - Abonnements
```

### 2.3 Sélectionner les événements

Sélectionnez les événements suivants :
- ✅ **`invoice.payment_succeeded`** - Paiement réussi → abonnement actif
- ✅ **`invoice.payment_failed`** - Paiement échoué → abonnement past_due
- ✅ **`customer.subscription.deleted`** - Abonnement supprimé → annulation

### 2.4 Récupérer le secret du webhook

1. Après avoir créé le webhook, **cliquez dessus**
2. Dans la section **"Signing secret"**, cliquez sur **"Reveal"** ou **"Révéler"**
3. **Copiez le secret** (commence par `whsec_...`)
4. **Ajoutez-le dans `.env`** :
   ```env
   STRIPE_WEBHOOK_SECRET=whsec_votre_secret_ici
   ```

### 2.5 Vérifier la route webhook

La route est déjà configurée dans `routes/web.php` :

```php
Route::post('/junspro/stripe/webhook', 'FrontEnd\JunsproStripeWebhookController@handle')
    ->name('junspro.stripe.webhook')
    ->withoutMiddleware(['web']);
```

✅ **Vérification** : La route est correctement configurée.

### 2.6 Tester le webhook (optionnel)

**En local avec Stripe CLI** :
```bash
# Installer Stripe CLI (Windows)
choco install stripe-cli -y

# Écouter les événements
stripe listen --forward-to localhost:8000/junspro/stripe/webhook

# Dans un autre terminal, déclencher un événement de test
stripe trigger invoice.payment_succeeded
```

**Dans Stripe Dashboard** :
1. Allez sur votre webhook
2. Cliquez sur **"Send test webhook"**
3. Sélectionnez l'événement `invoice.payment_succeeded`
4. Vérifiez les logs dans `storage/logs/laravel.log`

---

## 3. Configuration du CRON (tâches planifiées)

### 3.1 Vérifier le scheduler dans `app/Console/Kernel.php`

Le fichier `app/Console/Kernel.php` contient déjà les tâches planifiées :

```php
protected function schedule(Schedule $schedule)
{
    // CRON quotidienne - Rappels et validations
    $schedule->job(\App\Jobs\ProcessSubscriptionReminders::class)
        ->daily()
        ->at('09:00')
        ->name('junspro-reminders');

    // CRON quotidienne - Reprogrammations abusives
    $schedule->job(\App\Jobs\ProcessAbusiveRebookings::class)
        ->daily()
        ->at('10:00')
        ->name('junspro-abusive-rebookings');

    // CRON hebdomadaire - Calcul score freelance
    $schedule->job(\App\Jobs\CalculateFreelancerScore::class)
        ->weekly()
        ->sundays()
        ->at('02:00')
        ->name('junspro-freelancer-score');
}
```

✅ **Vérification** : Les tâches sont déjà configurées.

### 3.2 Configurer le CRON sur le serveur

**Sur Linux/Unix (cPanel, VPS, etc.)** :

Ajoutez cette ligne dans votre crontab (`crontab -e`) :

```bash
* * * * * cd /chemin/vers/votre/projet && php artisan schedule:run >> /dev/null 2>&1
```

**Exemple pour un VPS** :
```bash
* * * * * cd /var/www/junspro && php artisan schedule:run >> /dev/null 2>&1
```

**Sur Windows (Task Scheduler)** :

1. Ouvrez **Task Scheduler**
2. Créez une **Basic Task**
3. **Trigger** : Toutes les minutes
4. **Action** : Démarrer un programme
5. **Programme** : `C:\php\php.exe`
6. **Arguments** : `artisan schedule:run`
7. **Dossier de départ** : `C:\chemin\vers\votre\projet`

**Sur cPanel** :

1. Allez dans **Cron Jobs**
2. Ajoutez une nouvelle tâche :
   - **Minute** : `*`
   - **Heure** : `*`
   - **Jour** : `*`
   - **Mois** : `*`
   - **Jour de la semaine** : `*`
   - **Commande** : `cd /home/votreuser/public_html && php artisan schedule:run`

### 3.3 Vérifier que le CRON fonctionne

```bash
# Tester manuellement
php artisan schedule:run

# Voir les tâches planifiées
php artisan schedule:list
```

---

## 4. Vérification des migrations

### 4.1 Exécuter les migrations

```bash
php artisan migrate
```

### 4.2 Vérifier les tables créées

Les tables suivantes doivent exister :
- ✅ `subscriptions` - Abonnements
- ✅ `work_sessions` - Sessions de travail
- ✅ `audit_logs` - Logs d'audit
- ✅ `notification_logs` - Logs de notifications
- ✅ `freelancer_profiles` - Profils freelances
- ✅ `client_profiles` - Profils clients
- ✅ `nova_notifications` - Notifications Nova (déjà créée)

### 4.3 Vérifier les colonnes dans `users`

Les colonnes suivantes doivent exister dans `users` :
- ✅ `role` - Rôle (client, freelance, admin)
- ✅ `is_verified_freelancer` - Freelance vérifié
- ✅ `is_super_freelancer` - Super Freelance
- ✅ `freelancer_score` - Score freelance

Si ces colonnes n'existent pas, exécutez :
```bash
php artisan migrate --path=database/migrations/2025_11_24_000001_update_users_table_add_role.php
php artisan migrate --path=database/migrations/2025_12_01_000001_add_junspro_fields_to_users_table.php
```

---

## 5. Configuration des notifications

### 5.1 Vérifier les canaux de notification

Les notifications sont enregistrées dans `notification_logs`. Pour envoyer des emails réels, vous devez configurer :

**Dans `.env`** :
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@junspro.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 5.2 Créer les notifications Laravel (optionnel)

Pour envoyer des emails réels, créez des classes de notification :

```bash
php artisan make:notification SubscriptionPaymentSucceeded
php artisan make:notification SubscriptionPaymentFailed
php artisan make:notification WorkSessionDelivered
```

Puis modifiez `JunsproStripeWebhookController@notifyUser` pour utiliser ces notifications.

---

## 6. Configuration de la queue (optionnel)

### 6.1 Pour améliorer les performances

Si vous avez beaucoup de notifications ou de tâches, configurez une queue :

**Dans `.env`** :
```env
QUEUE_CONNECTION=database
# ou
QUEUE_CONNECTION=redis
```

**Créer la table jobs** :
```bash
php artisan queue:table
php artisan migrate
```

**Démarrer le worker** :
```bash
php artisan queue:work
```

**Ou avec Supervisor (production)** :
```ini
[program:junspro-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /chemin/vers/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/chemin/vers/worker.log
```

---

## 7. Test et vérification

### 7.1 Checklist de vérification

- [ ] Variables Stripe configurées dans `.env`
- [ ] Webhook Stripe créé et secret ajouté
- [ ] Route webhook accessible (`/junspro/stripe/webhook`)
- [ ] Migrations exécutées
- [ ] CRON configuré sur le serveur
- [ ] Tables créées dans la base de données
- [ ] Notifications configurées (optionnel)
- [ ] Queue configurée (optionnel)

### 7.2 Tests à effectuer

**Test 1 : Créer un abonnement**
1. Aller sur `/freelance/{id}`
2. Cliquer sur "S'abonner maintenant"
3. Vérifier que l'abonnement est créé dans la base de données

**Test 2 : Webhook Stripe**
1. Utiliser Stripe CLI pour envoyer un événement de test
2. Vérifier les logs dans `storage/logs/laravel.log`
3. Vérifier que l'abonnement est mis à jour

**Test 3 : CRON**
1. Exécuter manuellement : `php artisan schedule:run`
2. Vérifier les logs pour voir si les jobs sont exécutés

**Test 4 : Notifications**
1. Créer un abonnement
2. Vérifier qu'une entrée est créée dans `notification_logs`

---

## 8. URLs importantes

- **Webhook Stripe** : `POST /junspro/stripe/webhook`
- **Dashboard Client** : `/account/subscriptions`
- **Dashboard Freelance** : `/freelancer/subscriptions`
- **Profil Freelance** : `/freelance/{id}`
- **Nova Admin** : `/nova`

---

## 9. Dépannage

### Erreur "Webhook signature verification failed"

- Vérifiez que `STRIPE_WEBHOOK_SECRET` correspond au secret du webhook
- Vérifiez que l'URL du webhook est correcte
- Vérifiez les logs dans `storage/logs/laravel.log`

### Erreur "Table doesn't exist"

- Exécutez `php artisan migrate`
- Vérifiez que toutes les migrations sont exécutées

### CRON ne fonctionne pas

- Vérifiez que le CRON est configuré sur le serveur
- Testez manuellement avec `php artisan schedule:run`
- Vérifiez les permissions du fichier `artisan`

### Notifications non envoyées

- Vérifiez la configuration SMTP dans `.env`
- Vérifiez les logs dans `storage/logs/laravel.log`
- Testez l'envoi d'email avec `php artisan tinker` :
  ```php
  Mail::raw('Test', function($msg) { $msg->to('votre@email.com')->subject('Test'); });
  ```

---

## 10. Support

Pour toute question ou problème :
1. Vérifiez les logs dans `storage/logs/laravel.log`
2. Vérifiez les logs Stripe dans le Dashboard
3. Vérifiez que toutes les étapes de ce guide sont complétées

---

**Dernière mise à jour** : Décembre 2025

