# Diagnostic : Système d'abonnement existant pour Pause Souffle

## 📍 Où se trouve le système d'abonnement

### 1. Modèles & Tables
- **Table `subscriptions`** : `database/migrations/2025_11_24_000004_create_subscriptions_table.php`
  - `hours_per_week` : valeurs autorisées 1, 2, 4, 8, 12, 16, 20, 24
  - `hours_total_month` : calculé comme `hours_per_week * 4` (cycle 4 semaines)
  - `hours_remaining` : heures restantes sur le cycle
  - `stripe_subscription_id` : ID de l'abonnement Stripe
  - `status` : pending, active, paused, cancelled
  - `universe` : champ pour identifier l'univers (ex: 'corporate' pour Présence)

- **Modèle `Subscription`** : `app/Models/Subscription.php`
  - Relations : `client()`, `freelancer()`, `workSessions()`
  - Méthodes : `isActive()`, `requiresDeposit()`, `getFinalPriceAttribute()`

- **Table `subscription_topups`** : `database/migrations/2025_12_30_000001_create_subscription_topups_table.php`
  - `subscription_id` : référence à l'abonnement
  - `qty` : quantité de rituels/heures ajoutés
  - `unit_price` : prix unitaire
  - `total_price` : prix total
  - `status` : pending, paid

- **Modèle `SubscriptionTopup`** : `app/Models/SubscriptionTopup.php`
  - Relations : `subscription()`, `user()`
  - Scopes : `paid()`, `inWindow()` (fenêtre rolling 28 jours)

### 2. Services métier

- **`SubscriptionService`** : `app/Services/Junspro/SubscriptionService.php`
  - `createSubscription()` : crée un abonnement avec `hours_per_week`
  - `createStripeCheckoutSession()` : crée une session Stripe Checkout pour abonnement
  - `createDepositCheckoutSession()` : crée une session pour acompte présentiel
  - `consumeHours()` : consomme des heures d'un abonnement
  - `renewSubscription()` : renouvelle le cycle mensuel

- **`CycleUsageService`** : `app/Services/Junspro/CycleUsageService.php`
  - Gère les paliers (4, 8, 16, 24, 32 pour univers A)
  - `topupCap()` : limite max de top-up par cycle
  - `cycleMaxTotal()` : max total (palier + topup)
  - `wouldExceedCycleMax()` : vérifie si un top-up dépasse la limite
  - **Important** : Pour Corporate (univers A), max total = palier + palier (ex: 8 + 8 = 16 max)
  - **Pour Pause Souffle** : limite 12 rituels total = pack + add-on

### 3. Mapping Stripe

- **Prices Stripe** : créés dynamiquement dans `SubscriptionService::createStripeCheckoutSession()`
  - Utilise `price_data` avec `recurring` (interval: month)
  - Pas de price_id pré-configuré dans la DB
  - Les prices sont créés à la volée lors de la création de la session

- **Webhooks Stripe** : `app/Http/Controllers/FrontEnd/JunsproStripeWebhookController.php`
  - Gère `checkout.session.completed`, `payment_intent.succeeded`
  - Met à jour le statut des abonnements

### 4. Logique "packs 1/2/4/8"

- Les packs correspondent à `hours_per_week` :
  - Pack 1 rituel/4 semaines → `hours_per_week = 1` → `hours_total_month = 4`
  - Pack 2 rituels/4 semaines → `hours_per_week = 2` → `hours_total_month = 8`
  - Pack 4 rituels/4 semaines → `hours_per_week = 4` → `hours_total_month = 16`
  - Pack 8 rituels/4 semaines → `hours_per_week = 8` → `hours_total_month = 32`

### 5. Logique "add-on jusqu'à 12"

- **Système existant** : `SubscriptionTopup` permet d'ajouter des rituels
- **Limite** : gérée par `CycleUsageService::wouldExceedCycleMax()`
- **Pour Pause Souffle** : limite totale = 12 rituels/cycle
  - Si pack = 1 → add-on max = 11
  - Si pack = 2 → add-on max = 10
  - Si pack = 4 → add-on max = 8
  - Si pack = 8 → add-on max = 4

### 6. Contrôleurs existants

- **`UserController`** : `app/Http/Controllers/FrontEnd/UserController.php`
  - Méthode `topup()` : ligne 1335+ pour créer un top-up
  - Utilise `CycleUsageService` pour calculer les quotas

## ✅ Conclusion : Comment brancher Pause Souffle

1. **Essai** : Utiliser `PauseSouffleIntake` avec paiement one-time (déjà fait)
2. **Abonnements** : Utiliser `Subscription` avec :
   - `universe = 'corporate'` (ou créer 'pause-souffle')
   - `hours_per_week = 1/2/4/8` selon le pack choisi
   - `freelancer_id` : NULL ou un freelance "système" (à définir)
   - `client_id` : l'utilisateur qui a payé l'essai
3. **Add-ons** : Utiliser `SubscriptionTopup` avec limite 12 rituels total
4. **Stripe** : Créer les prices Stripe pour packs 1/2/4/8 (subscription, interval=week, interval_count=4)

## ⚠️ Points d'attention

- Le système actuel nécessite un `freelancer_id` pour créer une subscription
- Pour Pause Souffle, on peut :
  - Soit créer un freelance "système" Pause Souffle
  - Soit modifier le système pour accepter `freelancer_id = NULL` pour Pause Souffle
  - Soit créer la subscription après sélection d'un accompagnant
