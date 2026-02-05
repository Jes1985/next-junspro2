# Configuration Pause Souffle - Stripe

## 📋 Configuration requise

### 1. Créer les Prices dans Stripe Dashboard

Vous devez créer 3 prices dans Stripe Dashboard :

#### A. Pause Souffle — Rituel d'essai (1 session)
- **Type** : One-time payment
- **Montant** : À définir (ex: 50€)
- **Devise** : EUR
- **Nom du produit** : "Pause Souffle — Rituel d'essai"

#### B. Pause Souffle — Cycle 4 semaines
- **Type** : Subscription (recurring)
- **Interval** : Week
- **Interval count** : 4
- **Montant** : À définir (ex: 150€)
- **Devise** : EUR
- **Nom du produit** : "Pause Souffle — Cycle 4 semaines"

#### C. Pause Souffle — Accompagnement 3 mois
- **Type** : Subscription (recurring)
- **Interval** : Month
- **Interval count** : 3
- **Montant** : À définir (ex: 400€)
- **Devise** : EUR
- **Nom du produit** : "Pause Souffle — Accompagnement 3 mois"

### 2. Configurer les Price IDs dans .env

Une fois les prices créés dans Stripe, récupérez leurs IDs (commencent par `price_`) et ajoutez-les dans votre fichier `.env` :

```env
PAUSE_SOUFFLE_PRICE_TRIAL=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_CYCLE_4W=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_CYCLE_3M=price_xxxxxxxxxxxxx
```

### 3. Configurer le Webhook Stripe

Dans Stripe Dashboard → Webhooks, ajoutez un endpoint pointant vers :
```
https://votre-domaine.com/junspro/stripe/webhook
```

**Événements à sélectionner** :
- ✅ `checkout.session.completed`
- ✅ `payment_intent.succeeded`

Ces événements permettront de mettre à jour automatiquement le statut des intakes Pause Souffle après paiement.

## 🔄 Flux de paiement

1. **Utilisateur remplit le formulaire** (7 étapes)
2. **Sélection du rythme** : 1 session / 4 semaines / 3 mois
3. **Création de l'intake** avec statut `pending_payment`
4. **Création de la session Stripe Checkout** selon le plan choisi
5. **Redirection vers Stripe** pour le paiement
6. **Webhook Stripe** met à jour le statut à `paid`
7. **Redirection vers la page de confirmation** avec options pour choisir un accompagnant

## 📊 Structure de la base de données

### Table `pause_souffle_intakes`

- `id` : ID unique
- `user_id` : ID de l'utilisateur (nullable)
- `email`, `first_name`, `last_name` : Informations client
- `energy`, `clarity`, `tension` : Réponses du questionnaire (0-10)
- `situation` : Dirigeant, salarié, parent, etc.
- `rythme` : 1-session, 4-semaines, 3-mois
- `protect` : JSON array des éléments à protéger
- `preference` : douce, structuree, spirituel
- `plan_key` : trial, cycle_4w, cycle_3m
- `stripe_price_id` : ID du price Stripe utilisé
- `status` : pending_payment, paid, cancelled
- `stripe_checkout_session_id` : ID de la session Stripe
- `stripe_payment_intent_id` : ID du payment intent
- `paid_at` : Date de paiement
- `metadata` : JSON pour données supplémentaires

## 🎯 Routes

- `GET /presence/pause-souffle` : Page du formulaire
- `POST /presence/pause-souffle/submit` : Soumission du formulaire → création session Stripe
- `GET /presence/pause-souffle/stripe/success` : Page de confirmation après paiement
- `GET /presence/pause-souffle/stripe/cancel` : Page d'annulation

## 🔍 Vérifications

1. ✅ Migration créée et exécutée
2. ✅ Modèle `PauseSouffleIntake` créé
3. ✅ Configuration `config/pause_souffle.php` créée
4. ✅ Contrôleur modifié pour créer les sessions Stripe
5. ✅ Webhook configuré dans `JunsproStripeWebhookController`
6. ✅ Page de confirmation créée
7. ✅ CTA dynamique dans la vue selon le plan choisi
8. ✅ Domaine "Pause Souffle" ajouté dans `config/services_universes.php`
9. ✅ Spécialisations ajoutées dans `ServicesController`
10. ✅ Module service phare ajouté sur la page Présence

## ⚠️ Notes importantes

- Les prices Stripe doivent être créés **avant** de tester le flux de paiement
- Le webhook doit être configuré pour que les statuts soient mis à jour automatiquement
- En mode développement, utilisez Stripe CLI pour tester les webhooks localement
- Les montants sont configurables dans Stripe Dashboard, pas dans le code
