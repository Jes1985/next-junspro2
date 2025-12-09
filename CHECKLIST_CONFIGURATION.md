# Checklist de Configuration Junspro V2

## ✅ Ce qui est DÉJÀ fait

### 1. Code et Structure
- ✅ Contrôleur webhook Stripe créé (`JunsproStripeWebhookController`)
- ✅ Routes webhooks configurées (`/junspro/stripe/webhook`)
- ✅ Jobs CRON créés :
  - ✅ `ProcessSubscriptionReminders`
  - ✅ `ProcessAbusiveRebookings`
  - ✅ `CalculateFreelancerScore`
- ✅ Scheduler configuré dans `app/Console/Kernel.php`
- ✅ Services créés :
  - ✅ `SubscriptionService`
  - ✅ `RectificationService`
- ✅ Modèles mis à jour (Subscription, WorkSession, etc.)
- ✅ Migrations créées

### 2. CRON
- ✅ CRON configuré sur le serveur
- ✅ Tâches planifiées détectées et fonctionnelles
- ✅ Scheduler Laravel opérationnel

### 3. Base de données
- ✅ Table `nova_notifications` créée
- ✅ Migrations disponibles

---

## ⚠️ Ce qui reste à faire

### 1. Configuration Stripe (OBLIGATOIRE)

#### 1.1 Variables d'environnement
Ajouter dans `.env` sur le serveur :
```env
STRIPE_KEY=pk_test_votre_cle_publique
STRIPE_SECRET=sk_test_votre_cle_secrete
STRIPE_WEBHOOK_SECRET=whsec_votre_secret_webhook
```

**Où trouver :**
- Stripe Dashboard → Developers → API keys
- Pour le webhook secret : voir section 1.2

#### 1.2 Webhook Stripe Dashboard
1. Aller sur : https://dashboard.stripe.com/webhooks
2. Cliquer sur "Add endpoint"
3. URL : `https://votre-domaine.com/junspro/stripe/webhook`
4. Événements à sélectionner :
   - ✅ `invoice.payment_succeeded`
   - ✅ `invoice.payment_failed`
   - ✅ `customer.subscription.deleted`
5. Copier le secret (commence par `whsec_...`)
6. L'ajouter dans `.env` comme `STRIPE_WEBHOOK_SECRET`

### 2. Vérification des migrations (RECOMMANDÉ)

Sur le serveur, vérifier que toutes les migrations sont exécutées :
```bash
cd /var/www/junspro
php artisan migrate:status
```

Si des migrations sont "Pending", les exécuter :
```bash
php artisan migrate
```

### 3. Configuration des notifications (OPTIONNEL)

Si vous voulez envoyer des emails réels, configurer SMTP dans `.env` :
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@junspro.com
MAIL_FROM_NAME="Junspro"
```

### 4. Configuration de la queue (OPTIONNEL - pour performance)

Si vous avez beaucoup de trafic :
```env
QUEUE_CONNECTION=database
```

Puis créer la table :
```bash
php artisan queue:table
php artisan migrate
```

Et démarrer le worker :
```bash
php artisan queue:work
```

---

## 📋 Checklist rapide

- [ ] Variables Stripe ajoutées dans `.env`
- [ ] Webhook Stripe créé dans le dashboard
- [ ] Secret webhook ajouté dans `.env`
- [ ] Migrations exécutées (`php artisan migrate`)
- [ ] Notifications configurées (optionnel)
- [ ] Queue configurée (optionnel)

---

## 🎯 Prochaines étapes recommandées

1. **Configurer Stripe** (obligatoire pour les paiements)
2. **Vérifier les migrations** (pour s'assurer que toutes les tables existent)
3. **Tester le système** (créer un abonnement de test)

---

## ✅ Une fois tout configuré

Le système sera 100% opérationnel pour :
- ✅ Créer des abonnements
- ✅ Gérer les paiements Stripe
- ✅ Recevoir les webhooks
- ✅ Exécuter les tâches CRON automatiquement
- ✅ Envoyer des notifications
- ✅ Calculer les scores freelance

