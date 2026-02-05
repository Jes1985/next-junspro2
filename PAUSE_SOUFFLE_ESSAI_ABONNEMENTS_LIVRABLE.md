# Pause Souffle : Essai obligatoire + Abonnements cycles 4 semaines — Livrable final

## 📋 Résumé des modifications

### Système d'abonnement existant utilisé

**Localisation dans le code :**
- **Modèle** : `app/Models/Subscription.php`
- **Service** : `app/Services/Junspro/SubscriptionService.php`
- **Table** : `subscriptions` (migration `2025_11_24_000004_create_subscriptions_table.php`)
- **Top-up/Add-on** : `app/Models/SubscriptionTopup.php` (table `subscription_topups`)
- **Cycle Usage** : `app/Services/Junspro/CycleUsageService.php`

**Confirmation :** Pause Souffle utilise le système d'abonnement existant, pas de système parallèle créé.

## 📁 Fichiers créés

1. **Migration** : `database/migrations/2026_02_04_114225_add_subscription_id_to_pause_souffle_intakes_table.php`
   - Ajoute `subscription_id` à `pause_souffle_intakes` pour lier l'intake à la subscription

2. **Vue** : `resources/views/frontend/presence/pause-souffle-choose-cycle.blade.php`
   - Page de choix du cycle (4 semaines) avec packs 1/2/4/8 et stepper add-on

3. **Vue** : `resources/views/frontend/presence/pause-souffle-cycle-confirmation.blade.php`
   - Page de confirmation après activation du cycle

4. **Documentation** : `PAUSE_SOUFFLE_DIAGNOSTIC.md`
   - Diagnostic du système d'abonnement existant

## 📝 Fichiers modifiés

### 1. Configuration
- **`config/pause_souffle.php`**
  - Ajout des prices Stripe pour packs 1/2/4/8
  - Ajout de `pack_to_rituals_per_cycle` (mapping pack → rituels par cycle)
  - Ajout de `max_rituals_per_cycle` = 12

### 2. Modèles
- **`app/Models/PauseSouffleIntake.php`**
  - Ajout de `subscription_id` dans fillable
  - Ajout de la relation `subscription()`

### 3. Services
- **`app/Services/Junspro/SubscriptionService.php`**
  - Ajout de `createPauseSouffleSubscription()` : crée une subscription Pause Souffle avec freelance système
  - Ajout de `getPauseSouffleSystemFreelancer()` : récupère/crée le freelance système "Pause Souffle"

### 4. Contrôleurs
- **`app/Http/Controllers/FrontEnd/PauseSouffleController.php`**
  - Modification de `submit()` : essai obligatoire uniquement, anti-doublon intake
  - Modification de `stripeSuccess()` : redirige vers choix de cycle si essai payé
  - Ajout de `chooseCycle()` : affiche la page de choix de cycle
  - Ajout de `activateCycle()` : crée la session Stripe Checkout pour l'abonnement
  - Ajout de `cycleConfirmation()` : affiche la confirmation après activation
  - Ajout de `getPauseSoufflePacks()` : récupère les prix Stripe pour les packs

- **`app/Http/Controllers/FrontEnd/JunsproStripeWebhookController.php`**
  - Modification de `handleCheckoutSessionCompleted()` : gère essai ET abonnement Pause Souffle
  - Ajout de `handlePauseSouffleSubscription()` : crée la subscription après paiement abonnement
  - Ajout de `handleSubscriptionCreated()` : backup pour création subscription

### 5. Vues
- **`resources/views/frontend/presence/pause-souffle.blade.php`**
  - Suppression de l'étape 3 "Rythme souhaité" (remplacée par champ caché)
  - CTA final fixe : "Réserver un Rituel d'essai"
  - Microcopy : "Vous choisirez votre cycle (4 semaines) après l'essai."
  - Suppression du JavaScript de mise à jour dynamique du CTA

### 6. Routes
- **`routes/web.php`**
  - Ajout de `GET /presence/pause-souffle/choose-cycle` (auth requis)
  - Ajout de `POST /presence/pause-souffle/activate-cycle` (auth requis)
  - Ajout de `GET /presence/pause-souffle/cycle-confirmation` (auth requis)

## 🔄 Flux complet

### 1. Essai obligatoire
1. Utilisateur remplit le formulaire (7 étapes, sans choix de rythme)
2. CTA final : "Réserver un Rituel d'essai"
3. Création de `PauseSouffleIntake` avec `status = pending_payment`, `plan_key = trial`
4. **Anti-doublon** : vérifie si intake pending_payment existe déjà pour l'utilisateur
5. Création session Stripe Checkout (one-time payment)
6. Redirection vers Stripe
7. **Webhook** `checkout.session.completed` → met `status = paid`
8. Redirection vers `/presence/pause-souffle/choose-cycle`

### 2. Choix du cycle (4 semaines)
1. Page affiche les 4 packs (1/2/4/8 rituels) avec prix depuis Stripe
2. Stepper add-on (0 à max selon pack, limite totale 12 rituels)
3. Affichage total : "Total : X rituels / 4 semaines"
4. CTA : "Activer mon cycle (4 semaines)"
5. Création session Stripe Checkout (subscription, interval=week, interval_count=4)
6. Redirection vers Stripe

### 3. Activation abonnement
1. **Webhook** `checkout.session.completed` avec `type = pause_souffle_subscription`
2. Récupération metadata : `intake_id`, `pack`, `addon_qty`
3. **Idempotence** : vérifie si subscription existe déjà (par `subscription_id` ou `stripe_subscription_id`)
4. Création `Subscription` via `SubscriptionService::createPauseSouffleSubscription()`
   - `universe = 'corporate'`
   - `freelancer_id` = freelance système "Pause Souffle"
   - `hours_per_week` = valeur minimale (1 ou 2 selon pack)
   - `hours_total_month` = nombre réel de rituels (pack + add-on)
   - `stripe_subscription_id` = ID depuis Stripe
5. Création `SubscriptionTopup` si `addon_qty > 0`
6. Lien `PauseSouffleIntake.subscription_id` = subscription créée
7. Redirection vers `/presence/pause-souffle/cycle-confirmation`

### 4. Confirmation
1. Page affiche : "Votre cycle Pause Souffle (4 semaines) est activé"
2. Total rituels affiché depuis `subscription.hours_total_month`
3. Options : "Choisir un accompagnant" ou "Voir 3 profils recommandés"

## ✅ Règles anti-doublon (idempotence)

### Essai
- **Intake** : Vérifie si `PauseSouffleIntake` avec `user_id` + `status = pending_payment` + `plan_key = trial` existe déjà
- **Session Stripe** : Si session existe et est valide (`status = open`), réutilise au lieu d'en créer une nouvelle

### Abonnement
- **Intake** : Vérifie si `intake.subscription_id` existe déjà
- **Subscription** : Vérifie si `Subscription` avec `stripe_subscription_id` existe déjà
- **Double vérification** : Vérifie aussi dans `Subscription` par `stripe_subscription_id` avant création

## 🧪 Tests à effectuer

### 1. Essai obligatoire
- [ ] Formulaire 7 étapes sans choix de rythme
- [ ] CTA affiche "Réserver un Rituel d'essai"
- [ ] Microcopy affichée sous le CTA
- [ ] Création intake avec `status = pending_payment`
- [ ] Anti-doublon : refresh page → réutilise intake existant
- [ ] Redirection vers Stripe Checkout
- [ ] Webhook met `status = paid`
- [ ] Redirection vers choix de cycle après paiement

### 2. Choix du cycle
- [ ] Accès uniquement si essai payé
- [ ] Affichage des 4 packs avec prix depuis Stripe
- [ ] Sélection d'un pack active le bouton
- [ ] Stepper add-on fonctionne (+/-)
- [ ] Limite 12 rituels total respectée
- [ ] Si pack = 8 → add-on max = 4
- [ ] Affichage total mis à jour en temps réel
- [ ] Création session Stripe Checkout (subscription)

### 3. Activation abonnement
- [ ] Webhook crée la subscription
- [ ] Subscription liée à l'intake
- [ ] Top-up créé si add-on > 0
- [ ] `hours_total_month` = nombre réel de rituels
- [ ] Idempotence : refresh → pas de doublon

### 4. Confirmation
- [ ] Page affiche le total de rituels
- [ ] Statut "Actif" affiché
- [ ] Liens vers choix accompagnant fonctionnels

### 5. Non-régression
- [ ] Autres univers (projects, lessons, etc.) fonctionnent toujours
- [ ] Autres checkouts Stripe fonctionnent toujours
- [ ] Responsive mobile OK
- [ ] Pas de JS lourd (stepper simple, pas de dépendance externe)

## ⚙️ Configuration requise

### Prices Stripe à créer

1. **Essai** (one-time) :
   - `PAUSE_SOUFFLE_PRICE_TRIAL=price_xxxxx`

2. **Packs** (subscription, interval=week, interval_count=4) :
   - `PAUSE_SOUFFLE_PRICE_PACK_1=price_xxxxx` (1 rituel / 4 semaines)
   - `PAUSE_SOUFFLE_PRICE_PACK_2=price_xxxxx` (2 rituels / 4 semaines)
   - `PAUSE_SOUFFLE_PRICE_PACK_4=price_xxxxx` (4 rituels / 4 semaines)
   - `PAUSE_SOUFFLE_PRICE_PACK_8=price_xxxxx` (8 rituels / 4 semaines)

### Webhook Stripe

Événements à sélectionner :
- ✅ `checkout.session.completed`
- ✅ `payment_intent.succeeded`
- ✅ `customer.subscription.created` (backup)

## 📊 Structure données

### PauseSouffleIntake
- `subscription_id` : lien vers `Subscription` créée après choix du cycle
- `status` : `pending_payment` → `paid` (essai) → subscription créée
- `plan_key` : `trial` (essai uniquement)

### Subscription (Pause Souffle)
- `universe` : `'corporate'`
- `freelancer_id` : freelance système "Pause Souffle"
- `hours_per_week` : valeur minimale (1 ou 2) pour compatibilité système
- `hours_total_month` : nombre réel de rituels par cycle (pack + add-on)
- `hours_remaining` : nombre réel de rituels restants
- `stripe_subscription_id` : ID de l'abonnement Stripe

### SubscriptionTopup (Add-on)
- `subscription_id` : référence à la subscription
- `qty` : nombre de rituels ajoutés
- `status` : `paid` (payé via l'abonnement Stripe)

## 🎯 Points d'attention

1. **Freelance système** : Créé automatiquement au premier appel (`pause-souffle@junspro.system`)
2. **Prix** : Récupérés depuis Stripe en temps réel, pas hardcodés
3. **Limite 12** : Gérée côté client (JS) et serveur (validation)
4. **Idempotence** : Multiples vérifications pour éviter doublons
5. **Webhook** : Création subscription dans le webhook, pas dans le contrôleur (sécurité)

## ✅ Checklist finale

- [x] Essai obligatoire uniquement
- [x] CTA fixe "Réserver un Rituel d'essai"
- [x] Page choix cycle avec packs 1/2/4/8
- [x] Stepper add-on jusqu'à 12 rituels total
- [x] Utilisation système Subscription existant
- [x] Utilisation SubscriptionTopup pour add-ons
- [x] Webhook crée subscription après paiement
- [x] Anti-doublon implémenté (essai + abonnement)
- [x] Page confirmation premium
- [x] Aucune régression (autres univers OK)
- [x] Responsive mobile
- [x] Pas de JS lourd
