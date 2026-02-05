# FIX 500 - Pause Souffle Stripe Configuration

**Date**: 4 février 2026  
**Statut**: ✅ Corrections appliquées

---

## 🔍 CAUSE EXACTE DU 500

### Erreur identifiée
```
Stripe price ID non configuré pour essai {"plan_key":"trial"}
```

### Cause racine
1. **Variable d'environnement manquante** : `PAUSE_SOUFFLE_PRICE_TRIAL` non définie dans `.env`
2. **Configuration non validée** : Le contrôleur ne vérifiait pas la configuration avant de créer la session
3. **Gestion d'erreurs insuffisante** : Les erreurs Stripe retournaient 500 au lieu de 422 avec message clair

---

## ✅ CORRECTIONS APPLIQUÉES

### 1. Amélioration de la gestion d'erreurs (`PauseSouffleController`)

#### Méthode `submit()` (essai)
- ✅ Vérification de `STRIPE_SECRET` avant création de session
- ✅ Vérification de `PAUSE_SOUFFLE_PRICE_TRIAL` avec message d'erreur détaillé
- ✅ Gestion spécifique des erreurs Stripe API (`InvalidRequestException`)
- ✅ Messages d'erreur clairs pour l'utilisateur
- ✅ Logs détaillés avec stack trace

#### Méthode `activateCycle()` (abonnement)
- ✅ Vérification de `STRIPE_SECRET` avant création de session
- ✅ Vérification des price_id pour chaque pack avec message d'erreur détaillé
- ✅ Vérification des routes success/cancel avant création
- ✅ Gestion spécifique des erreurs Stripe API
- ✅ Logs détaillés avec contexte complet

### 2. Amélioration du service (`StripeService`)

#### Méthode `createPauseSouffleCheckoutSession()`
- ✅ Vérification de `STRIPE_SECRET` avec message d'erreur explicite
- ✅ Vérification du `price_id` avec indication de la variable env manquante
- ✅ Vérification des routes success/cancel avant création
- ✅ Gestion spécifique des erreurs Stripe API
- ✅ Logs détaillés pour chaque étape

### 3. Documentation (`.env.example`)
- ✅ Ajout des variables `PAUSE_SOUFFLE_PRICE_*` avec commentaires explicatifs
- ✅ Format recommandé pour chaque variable

---

## 📋 CONFIGURATION REQUISE

### Variables d'environnement à ajouter dans `.env`

```env
# Pause Souffle Stripe Price IDs (créer dans Stripe Dashboard)
# Essai (one-time payment)
PAUSE_SOUFFLE_PRICE_TRIAL="price_xxxxx"

# Packs cycles 4 semaines (subscription, interval=week, interval_count=4)
PAUSE_SOUFFLE_PRICE_PACK_1="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_2="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_4="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_8="price_xxxxx"
```

### Création des Prices dans Stripe Dashboard

#### 1. Essai (one-time)
- **Type**: One-time payment
- **Montant**: À définir selon votre pricing
- **Currency**: EUR
- **Product**: "Pause Souffle - Rituel d'essai"

#### 2. Packs cycles 4 semaines (subscription)
- **Type**: Recurring
- **Interval**: Week
- **Interval count**: 4
- **Montant**: À définir selon votre pricing
- **Currency**: EUR
- **Product**: "Pause Souffle - Pack X rituels / 4 semaines"

---

## 🔄 FLOW COMPLET (après corrections)

### Essai obligatoire
1. ✅ Utilisateur remplit les 7 étapes
2. ✅ CTA "Réserver un Rituel d'essai"
3. ✅ Validation de la configuration Stripe
4. ✅ Création `PauseSouffleIntake` avec `status = pending_payment`
5. ✅ Création session Stripe Checkout (one-time)
6. ✅ Redirection vers Stripe
7. ✅ **Webhook** `checkout.session.completed` → `status = paid`
8. ✅ Redirection vers `/presence/pause-souffle/choose-cycle`

### Abonnement cycle 4 semaines
1. ✅ Utilisateur choisit pack (1/2/4/8) + add-on (jusqu'à 12)
2. ✅ Validation de la configuration Stripe
3. ✅ Création session Stripe Checkout (subscription)
4. ✅ Redirection vers Stripe
5. ✅ **Webhook** `checkout.session.completed` → création `Subscription`
6. ✅ Redirection vers `/presence/pause-souffle/cycle-confirmation`

---

## 🛠️ ACTIONS À EFFECTUER

### 1. Ajouter les variables dans `.env`
```bash
# Copier depuis .env.example et remplacer les valeurs
PAUSE_SOUFFLE_PRICE_TRIAL="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_1="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_2="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_4="price_xxxxx"
PAUSE_SOUFFLE_PRICE_PACK_8="price_xxxxx"
```

### 2. Vider le cache de configuration
```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Créer les Prices dans Stripe Dashboard
- Se connecter à Stripe Dashboard
- Créer les products et prices selon les spécifications ci-dessus
- Copier les price_id dans `.env`

### 4. Tester le flow complet
1. Essai : `/presence/pause-souffle` → remplir formulaire → clic "Réserver un Rituel d'essai"
2. Vérifier que la session Stripe se crée sans erreur
3. Tester le webhook avec Stripe CLI
4. Vérifier que l'intake passe à `status = paid`
5. Tester le choix de cycle et l'activation

---

## 📊 FICHIERS MODIFIÉS

1. **`app/Http/Controllers/FrontEnd/PauseSouffleController.php`**
   - Amélioration gestion d'erreurs `submit()`
   - Amélioration gestion d'erreurs `activateCycle()`

2. **`app/Services/StripeService.php`**
   - Amélioration validation configuration `createPauseSouffleCheckoutSession()`

3. **`.env.example`**
   - Ajout variables `PAUSE_SOUFFLE_PRICE_*`

---

## ✅ TESTS À EFFECTUER

### Test 1 : Configuration manquante
- ❌ Sans `PAUSE_SOUFFLE_PRICE_TRIAL` → doit retourner 422 avec message clair
- ✅ Avec `PAUSE_SOUFFLE_PRICE_TRIAL` → doit créer la session

### Test 2 : Price ID invalide
- ❌ Avec `PAUSE_SOUFFLE_PRICE_TRIAL="price_invalid"` → doit retourner 422 avec message clair
- ✅ Avec `PAUSE_SOUFFLE_PRICE_TRIAL="price_valid"` → doit créer la session

### Test 3 : Flow complet
- ✅ Essai → paiement → webhook → choix cycle → activation → webhook → confirmation

---

## 🎯 RÉSULTAT ATTENDU

- ✅ Plus aucune erreur 500
- ✅ Messages d'erreur clairs pour l'utilisateur (422)
- ✅ Logs détaillés pour le débogage
- ✅ Configuration validée avant chaque opération Stripe
- ✅ Idempotence garantie (pas de double paiement/subscription)
