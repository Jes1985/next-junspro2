# PHASE 0 — AUDIT GLOBAL STRIPE / ABONNEMENTS

**Date**: 3 février 2026  
**Statut**: ✅ Audit complet terminé

---

## 🔍 A) CAUSE DE L'ERREUR "Configuration de paiement invalide"

### Localisation exacte

**Fichier**: `app/Http/Controllers/FrontEnd/PauseSouffleController.php`

**Ligne 91** (essai) :
```php
$priceId = config("pause_souffle.stripe_prices.{$planKey}");
if (!$priceId) {
    Log::error('Stripe price ID non configuré pour essai', ['plan_key' => $planKey]);
    return back()->withErrors(['error' => 'Configuration de paiement invalide. Veuillez réessayer.'])->withInput();
}
```

**Ligne 345** (pack cycle) :
```php
$priceId = config("pause_souffle.stripe_prices.{$pack}");
if (!$priceId) {
    Log::error('Stripe price ID non configuré pour pack', ['pack' => $pack]);
    return back()->withErrors(['error' => 'Configuration de paiement invalide.'])->withInput();
}
```

### Cause racine

1. **Price IDs manquants dans `.env`** :
   - `PAUSE_SOUFFLE_PRICE_TRIAL` non défini ou null
   - `PAUSE_SOUFFLE_PRICE_PACK_1/2/4/8` non définis ou null
   - `config("pause_souffle.stripe_prices.trial")` retourne `null`

2. **Incohérence source de vérité Stripe** :
   - `StripeService` utilise `config('services.stripe.secret')` dans le constructeur (ligne 15)
   - Mais `SubscriptionService::getStripeSecret()` récupère depuis DB (`OnlineGateway`)
   - `PauseSouffleController` utilise directement `config('services.stripe.secret')` (ligne 350)
   - **Problème** : Si `.env` n'est pas à jour mais que DB est à jour (ou vice versa), incohérence

3. **Webhook manquant `checkout.session.completed`** :
   - Le webhook `JunsproStripeWebhookController` ne gère PAS `checkout.session.completed` dans le switch (ligne 52-75)
   - Seulement `invoice.payment_succeeded`, `invoice.paid`, `invoice.payment_failed`, `customer.subscription.deleted`, `customer.subscription.created`
   - La méthode `handleCheckoutSessionCompleted()` existe (ligne 202) mais n'est jamais appelée

---

## 📊 B) CARTOGRAPHIE COMPLÈTE "PAIEMENT / ABONNEMENT"

### 1. Pause Souffle (`/presence/pause-souffle`)

#### Essai obligatoire (one-time)
- **URL**: `POST /presence/pause-souffle/submit`
- **Route**: `presence.pause-souffle.submit`
- **Controller**: `PauseSouffleController@submit` (ligne 53)
- **Service utilisé**: `StripeService::createPauseSouffleCheckoutSession()` (ligne 149)
- **Vue**: `resources/views/frontend/presence/pause-souffle.blade.php`
- **Modèle/DB**: `PauseSouffleIntake` (table `pause_souffle_intakes`)
- **Événement webhook attendu**: `checkout.session.completed` (NON GÉRÉ actuellement)
- **Price ID source**: `config('pause_souffle.stripe_prices.trial')` → `env('PAUSE_SOUFFLE_PRICE_TRIAL')`

#### Abonnement cycle 4 semaines
- **URL**: `POST /presence/pause-souffle/activate-cycle`
- **Route**: `pause-souffle.activate-cycle`
- **Controller**: `PauseSouffleController@activateCycle` (ligne 285)
- **Service utilisé**: Création directe `\Stripe\Checkout\Session::create()` (ligne 355)
- **Vue**: `resources/views/frontend/presence/pause-souffle-choose-cycle.blade.php`
- **Modèle/DB**: `Subscription` (table `subscriptions`) + `PauseSouffleIntake.subscription_id`
- **Événement webhook attendu**: `checkout.session.completed` avec `type = pause_souffle_subscription` (NON GÉRÉ actuellement)
- **Price ID source**: `config("pause_souffle.stripe_prices.{$pack}")` → `env('PAUSE_SOUFFLE_PRICE_PACK_1/2/4/8')`

### 2. Abonnements universels (autres univers)

#### Abonnement standard (projects, lessons, at-home, etc.)
- **URL**: `POST /freelancer/{id}/subscribe` (via `FreelancerController`)
- **Route**: `freelancer.subscribe`
- **Controller**: `FreelancerController@subscribe` (ligne ~476)
- **Service utilisé**: `SubscriptionService::createStripeCheckoutSession()` (ligne 214)
- **Vue**: N/A (redirection Stripe)
- **Modèle/DB**: `Subscription` (table `subscriptions`)
- **Événement webhook attendu**: `invoice.payment_succeeded` (GÉRÉ ligne 56)
- **Price ID source**: **DYNAMIQUE** via `price_data` (pas de price_id pré-configuré, ligne 240-254)

#### Acompte présentiel
- **URL**: Via `SubscriptionService::createDepositCheckoutSession()` (ligne 140)
- **Service utilisé**: `SubscriptionService::createDepositCheckoutSession()`
- **Modèle/DB**: `Subscription` avec `deposit_amount`, `deposit_paid_at`
- **Événement webhook attendu**: `checkout.session.completed` (NON GÉRÉ)
- **Price ID source**: **DYNAMIQUE** via `price_data` (ligne 189)

### 3. HomeSwap (abonnement annuel)

- **URL**: Via `ClientMissionController@homeSwapCheckout`
- **Route**: `mission.homeswap.checkout`
- **Service utilisé**: `StripeService::createHomeSwapCheckoutSession()` (ligne 88)
- **Modèle/DB**: N/A (géré via metadata)
- **Événement webhook attendu**: `checkout.session.completed` (NON GÉRÉ)
- **Price ID source**: **DYNAMIQUE** via `price_data` (ligne 98-108)

### 4. Missions one-time

- **URL**: Via `ClientMissionController@stripeCheckout`
- **Route**: `mission.stripe.checkout`
- **Service utilisé**: `StripeService::createCheckoutSession()` (ligne 21)
- **Modèle/DB**: `Mission` (table `missions`)
- **Événement webhook attendu**: `checkout.session.completed` (géré dans `ClientMissionController@stripeWebhook` ligne 153)
- **Price ID source**: **DYNAMIQUE** via `price_data` (ligne 30-36)

---

## 💾 C) SOURCE DE VÉRITÉ PRICING

### Stockage Price IDs

#### 1. Pause Souffle (config file)
**Fichier**: `config/pause_souffle.php` (ligne 23-30)
```php
'stripe_prices' => [
    'trial' => env('PAUSE_SOUFFLE_PRICE_TRIAL', null),
    'pack_1' => env('PAUSE_SOUFFLE_PRICE_PACK_1', null),
    'pack_2' => env('PAUSE_SOUFFLE_PRICE_PACK_2', null),
    'pack_4' => env('PAUSE_SOUFFLE_PRICE_PACK_4', null),
    'pack_8' => env('PAUSE_SOUFFLE_PRICE_PACK_8', null),
],
```

**Variables .env requises**:
```env
PAUSE_SOUFFLE_PRICE_TRIAL=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_1=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_2=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_4=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_8=price_xxxxxxxxxxxxx
```

#### 2. Autres univers (dynamique)
- **Pas de price_id pré-configuré**
- Utilisation de `price_data` dans `Session::create()` (prix calculé dynamiquement)
- **SubscriptionService** (ligne 240-254) : `price_data` avec `recurring.interval = 'month'` (⚠️ PAS 4 semaines)
- **Pause Souffle activateCycle** (ligne 355-373) : utilise `price` (price_id pré-configuré) avec `mode = 'subscription'`

### Mapping packs → rituels

**Fichier**: `config/pause_souffle.php` (ligne 50-68)
```php
'pack_to_rituals_per_cycle' => [
    'pack_1' => 1,
    'pack_2' => 2,
    'pack_4' => 4,
    'pack_8' => 8,
],
'pack_to_hours_per_week' => [
    'pack_1' => 1,
    'pack_2' => 1,
    'pack_4' => 1,
    'pack_8' => 2,
],
'max_rituals_per_cycle' => 12,
```

### Cycle x4 semaines

**Problème identifié** :
- `SubscriptionService::createStripeCheckoutSession()` utilise `interval = 'month'` (ligne 252)
- **Pause Souffle** devrait utiliser `interval = 'week'` avec `interval_count = 4` mais utilise des price_id pré-configurés
- Les price_id Stripe doivent être créés avec `interval = 'week'` et `interval_count = 4` dans Stripe Dashboard

---

## ⚙️ D) STRIPE SETUP ACTUEL

### Configuration .env

**Fichier**: `config/services.php` (ligne 34-38)
```php
'stripe' => [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
],
```

**Variables .env**:
```env
STRIPE_KEY=pk_test_xxxxx
STRIPE_SECRET=sk_test_xxxxx
STRIPE_WEBHOOK_SECRET=whsec_xxxxx
```

### Source de vérité Stripe (INCOHÉRENCE)

#### Méthode 1 : Config (.env)
- **Utilisé par**: `StripeService` (constructeur ligne 15), `PauseSouffleController` (ligne 350)
- **Source**: `config('services.stripe.secret')` → `env('STRIPE_SECRET')`

#### Méthode 2 : Base de données
- **Utilisé par**: `SubscriptionService::getStripeSecret()` (ligne 330), `JunsproStripeWebhookController` (ligne 27)
- **Source**: `OnlineGateway::where('keyword', 'stripe')->first()->information['secret']`
- **Table**: `online_gateways` (colonne `information` JSON)

**⚠️ PROBLÈME** : Deux sources de vérité différentes. Si `.env` n'est pas à jour mais que DB est à jour, incohérence.

### Webhook Stripe

#### Endpoint
- **Route**: `POST /junspro/stripe/webhook`
- **Route name**: `junspro.stripe.webhook`
- **Controller**: `JunsproStripeWebhookController@handle` (ligne 21)

#### Événements gérés actuellement
- ✅ `invoice.payment_succeeded` / `invoice.paid` / `invoice_payment.paid` → `handlePaymentSucceeded()` (ligne 83)
- ✅ `invoice.payment_failed` / `invoice.payment_action_required` → `handlePaymentFailed()` (ligne 135)
- ✅ `customer.subscription.deleted` → `handleSubscriptionDeleted()` (ligne 172)
- ✅ `customer.subscription.created` → `handleSubscriptionCreated()` (ligne 68)
- ❌ **`checkout.session.completed`** → `handleCheckoutSessionCompleted()` existe (ligne 202) mais **N'EST PAS APPELÉ**

#### Webhook secret
- **Source**: `OnlineGateway::where('keyword', 'stripe')->first()->information['webhook_secret']` (ligne 42)
- **Vérification**: Signature vérifiée ligne 45

---

## 🔧 E) PROBLÈMES IDENTIFIÉS

### Problème 1 : Price IDs manquants
- **Cause**: Variables `.env` non définies ou null
- **Impact**: Erreur "Configuration de paiement invalide"
- **Solution**: Vérifier/créer les price_id dans Stripe Dashboard et les configurer dans `.env`

### Problème 2 : Webhook `checkout.session.completed` non géré
- **Cause**: Le switch dans `JunsproStripeWebhookController@handle` ne gère pas cet événement
- **Impact**: Les paiements one-time (essai Pause Souffle) ne sont pas confirmés automatiquement
- **Solution**: Ajouter `case 'checkout.session.completed':` dans le switch

### Problème 3 : Incohérence source Stripe secret
- **Cause**: Deux méthodes différentes (`config()` vs DB)
- **Impact**: Si `.env` et DB diffèrent, erreurs inattendues
- **Solution**: Centraliser via une seule méthode (recommandé: DB via `SubscriptionService::getStripeSecret()`)

### Problème 4 : Cycle x4 semaines non respecté
- **Cause**: `SubscriptionService::createStripeCheckoutSession()` utilise `interval = 'month'` au lieu de `interval = 'week'` avec `interval_count = 4`
- **Impact**: Facturation mensuelle au lieu de tous les 4 semaines
- **Solution**: Corriger pour utiliser `interval = 'week'` et `interval_count = 4` OU utiliser des price_id pré-configurés avec cette périodicité

### Problème 5 : `StripeService` utilise config() dans constructeur
- **Cause**: `StripeService::__construct()` appelle `Stripe::setApiKey(config('services.stripe.secret'))` (ligne 15)
- **Impact**: Si `.env` n'est pas à jour, toutes les méthodes de `StripeService` échouent
- **Solution**: Utiliser `SubscriptionService::getStripeSecret()` ou récupérer depuis DB à chaque appel

---

## 📋 F) ROUTES STRIPE IDENTIFIÉES

### Routes checkout/abonnement

1. **Pause Souffle**
   - `POST /presence/pause-souffle/submit` → Essai
   - `POST /presence/pause-souffle/activate-cycle` → Abonnement cycle
   - `GET /presence/pause-souffle/stripe/success` → Success essai
   - `GET /presence/pause-souffle/stripe/cancel` → Cancel essai
   - `GET /presence/pause-souffle/choose-cycle` → Choix cycle
   - `GET /presence/pause-souffle/cycle-confirmation` → Confirmation abonnement

2. **Abonnements universels**
   - `POST /freelancer/{id}/subscribe` → Abonnement standard
   - `GET /subscription/stripe/success` → Success abonnement
   - `GET /subscription/stripe/cancel` → Cancel abonnement

3. **HomeSwap**
   - `POST /homeswap/checkout` → Abonnement annuel
   - `GET /mission/stripe/success` → Success (avec `type=homeswap`)

4. **Missions**
   - `POST /mission/stripe/checkout` → Paiement one-time mission
   - `POST /mission/stripe/webhook` → Webhook missions

### Routes webhook

1. **Webhook principal Junspro**
   - `POST /junspro/stripe/webhook` → `JunsproStripeWebhookController@handle`
   - **Événements**: `invoice.*`, `customer.subscription.*` (mais PAS `checkout.session.completed`)

2. **Webhook missions**
   - `POST /mission/stripe/webhook` → `ClientMissionController@stripeWebhook`
   - **Événements**: `checkout.session.completed` (géré ligne 153)

3. **Webhook Stripe Connect**
   - `POST /api/webhooks/stripe-connect` → `StripeConnectWebhookController@handle`
   - **Événements**: Connect-specific

---

## 🎯 G) RÉSUMÉ DES CORRECTIONS NÉCESSAIRES

### Priorité 1 (bloquant)
1. ✅ Ajouter gestion `checkout.session.completed` dans `JunsproStripeWebhookController`
2. ✅ Centraliser récupération Stripe secret (utiliser DB partout)
3. ✅ Vérifier/créer price_id Stripe pour Pause Souffle et les configurer dans `.env`

### Priorité 2 (important)
4. ✅ Corriger `StripeService` pour ne pas utiliser config() dans constructeur
5. ✅ Corriger cycle x4 semaines dans `SubscriptionService` (ou utiliser price_id pré-configurés)
6. ✅ Améliorer gestion erreurs (logs détaillés + message user utile)

### Priorité 3 (amélioration)
7. ✅ Idempotence webhook (vérifier event_id déjà traité)
8. ✅ Tests end-to-end sur plusieurs univers

---

## 📝 H) FICHIERS À MODIFIER (ESTIMATION)

### Phase 1 — Réparation Stripe Core
- `app/Services/StripeService.php` (constructeur)
- `app/Http/Controllers/FrontEnd/JunsproStripeWebhookController.php` (ajouter `checkout.session.completed`)
- `app/Http/Controllers/FrontEnd/PauseSouffleController.php` (utiliser `getStripeSecret()` depuis DB)

### Phase 2 — Abonnements universels
- `app/Services/Junspro/SubscriptionService.php` (corriger cycle x4 semaines)
- `app/Http/Controllers/FrontEnd/JunsproStripeWebhookController.php` (idempotence)

### Phase 3 — Pause Souffle
- Déjà fait (validations corrigées précédemment)

---

## ✅ VALIDATION AUDIT

- [x] Cause erreur "Configuration de paiement invalide" identifiée
- [x] Cartographie complète routes/controllers/services
- [x] Source de vérité pricing identifiée
- [x] Stripe setup analysé (incohérences trouvées)
- [x] Webhook analysé (événements manquants identifiés)
- [x] Problèmes prioritaires listés

**🛑 STOP : Audit complet terminé. Prêt pour Phase 1.**
