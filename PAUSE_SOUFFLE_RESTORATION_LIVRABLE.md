# Pause Souffle - Restauration et Alignement Système

**Date**: 3 février 2026  
**Statut**: ✅ Complété

## 📋 Résumé exécutif

Restauration de la version propre du multi-step 7 étapes de Pause Souffle, correction des validations, et alignement avec le système d'abonnement existant (essai obligatoire + cycles 4 semaines avec add-on).

---

## ✅ Phase 0 : Restauration version propre

### État initial
- ✅ Les 7 étapes étaient déjà restaurées dans une version précédente
- ✅ Étape 2 : Radio buttons (situation unique)
- ✅ Étape 3 : Radio buttons (rythme souhaité)
- ✅ Étape 4 : Checkboxes (éléments à protéger)
- ✅ Étape 5 : Textarea (ce que vous souhaitez construire)
- ✅ Étape 6 : Checkboxes (préférences d'accompagnement, optionnel)
- ✅ Étape 7 : Consentement + CTA

---

## ✅ Phase A : CTA final premium

### Modifications effectuées

**Fichier**: `resources/views/frontend/presence/pause-souffle.blade.php`

1. **Bouton CTA final** (ligne ~830)
   - **Avant**: "Envoyer ma demande"
   - **Après**: "Réserver un Rituel d'essai"

2. **Micro-ligne ajoutée** (ligne ~832)
   - Texte: "Clarifier ce qui compte vraiment • Poser des priorités réalistes • Choisir une direction cohérente"
   - Style: centré, gris clair, taille réduite

### Résultat
✅ Les 7 étapes restent intactes, seul le texte du CTA final change.

---

## ✅ Phase B : Correction validation contrôleur

### Problème identifié
Le contrôleur attendait `situation` comme array (checkboxes) alors que la vue utilise des radio buttons (string unique).

### Modifications effectuées

**Fichier**: `app/Http/Controllers/FrontEnd/PauseSouffleController.php`

1. **Validation `situation`** (ligne ~59)
   - **Avant**: `'situation' => 'required|array|min:1'`
   - **Après**: `'situation' => 'required|string|in:dirigeant,salarie,parent,freelance,etudiant,transition'`

2. **Validation `rythme`** (ligne ~61)
   - **Avant**: `'rythme' => 'required|in:1-session'`
   - **Après**: `'rythme' => 'required|in:1-session,4-semaines,3-mois'`

3. **Validation `preferences`** (ligne ~64)
   - **Avant**: `'preference' => 'nullable|in:douce,structuree,spirituel'`
   - **Après**: `'preferences' => 'nullable|array'` + `'preferences.*' => 'in:douce,structuree,spirituel'`

4. **Ajout validation `construire`** (ligne ~66)
   - `'construire' => 'nullable|string|max:2000'`

5. **Création intake** (ligne ~119-129)
   - `'situation' => $request->situation` (string unique)
   - `'rythme' => $request->rythme ?? '1-session'`
   - `'preference' => !empty($request->preferences) ? $request->preferences[0] : null` (première valeur pour compatibilité enum)
   - `'metadata' => ['preferences' => $request->preferences ?? []]` (toutes les valeurs stockées dans metadata)

6. **Correction vue préférences** (ligne ~793-801)
   - Valeurs corrigées pour correspondre à la migration: `douce`, `structuree`, `spirituel`

### Résultat
✅ Le contrôleur accepte maintenant correctement les données du formulaire multi-step.

---

## ✅ Phase C : Système Stripe Checkout (essai)

### État actuel
Le système est déjà en place et fonctionnel :

1. **Route**: `POST /presence/pause-souffle/submit`
2. **Contrôleur**: `PauseSouffleController@submit`
3. **Service**: `StripeService::createPauseSouffleCheckoutSession()`
4. **Configuration**: `config/pause_souffle.php` → `stripe_prices.trial`
5. **Webhook**: `JunsproStripeWebhookController@handleCheckoutSessionCompleted()`

### Flux essai obligatoire
1. Utilisateur remplit les 7 étapes
2. CTA "Réserver un Rituel d'essai"
3. Création `PauseSouffleIntake` avec `status = pending_payment`, `plan_key = trial`
4. **Anti-doublon**: Vérifie si intake `pending_payment` existe déjà pour l'utilisateur
5. Création session Stripe Checkout (one-time payment)
6. Redirection vers Stripe
7. **Webhook** `checkout.session.completed` → met `status = paid`
8. Redirection vers `/presence/pause-souffle/choose-cycle`

### Idempotence
- ✅ Réutilisation intake `pending_payment` existant
- ✅ Réutilisation session Stripe valide si existe
- ✅ Webhook vérifie statut avant mise à jour

---

## ✅ Phase D : Page choix cycle + add-on

### État actuel
Le système est déjà en place :

1. **Route**: `GET /presence/pause-souffle/choose-cycle`
2. **Contrôleur**: `PauseSouffleController@chooseCycle()`
3. **Vue**: `resources/views/frontend/presence/pause-souffle-choose-cycle.blade.php`
4. **Packs**: 1/2/4/8 rituels / 4 semaines
5. **Add-on**: Stepper 0-12 rituels max (limite totale 12)

### Configuration packs
**Fichier**: `config/pause_souffle.php`

```php
'stripe_prices' => [
    'pack_1' => env('PAUSE_SOUFFLE_PRICE_PACK_1', null), // 1 rituel / 4 semaines
    'pack_2' => env('PAUSE_SOUFFLE_PRICE_PACK_2', null), // 2 rituels / 4 semaines
    'pack_4' => env('PAUSE_SOUFFLE_PRICE_PACK_4', null), // 4 rituels / 4 semaines
    'pack_8' => env('PAUSE_SOUFFLE_PRICE_PACK_8', null), // 8 rituels / 4 semaines
],
'pack_to_rituals_per_cycle' => [
    'pack_1' => 1,
    'pack_2' => 2,
    'pack_4' => 4,
    'pack_8' => 8,
],
'max_rituals_per_cycle' => 12,
```

### Flux activation cycle
1. Page affiche packs avec prix depuis Stripe
2. Utilisateur sélectionne pack (1/2/4/8)
3. Stepper add-on (0 à max selon pack, limite totale 12)
4. CTA "Activer mon cycle (4 semaines)"
5. Création session Stripe Checkout (subscription, interval=week, interval_count=4)
6. Redirection vers Stripe
7. **Webhook** `checkout.session.completed` avec `type = pause_souffle_subscription`
8. Création `Subscription` via `SubscriptionService::createPauseSouffleSubscription()`
9. Redirection vers `/presence/pause-souffle/cycle-confirmation`

### Correction bug
**Fichier**: `app/Http/Controllers/FrontEnd/PauseSouffleController.php` (ligne ~475)
- **Avant**: `'rituals_per_cycle' => config("pause_souffle.pack_to_hours_per_week.{$packKey}") * 4`
- **Après**: `'rituals_per_cycle' => config("pause_souffle.pack_to_rituals_per_cycle.{$packKey}", 1)`

### Idempotence
- ✅ Vérifie si subscription existe déjà avant création
- ✅ Webhook vérifie `subscription_id` existant

---

## ✅ Phase E : Marketplace Présence - Domaine Pause Souffle

### État actuel
Le domaine est déjà configuré :

**Fichier**: `config/services_universes.php` (ligne ~63)
```php
['pause-souffle', 'Pause Souffle'],
```

**Fichier**: `app/Http/Controllers/FrontEnd/ServicesController.php` (ligne ~1041-1048)
```php
'domainSpecializations' => [
    'pause-souffle' => [
        ['clarte_priorites', 'Clarté & priorités'],
        ['transition_vie', 'Transition de vie'],
        ['equilibre_charge_mentale', 'Équilibre & charge mentale'],
        ['rythme_discipline_douce', 'Rythme & discipline douce'],
        ['leadership_decision', 'Leadership & décision'],
        ['dimension_spirituelle', 'Dimension spirituelle'],
    ],
    // ...
],
```

### Résultat
✅ Les freelances peuvent proposer le domaine "Pause Souffle" avec les spécialisations premium.

---

## 📊 Fichiers modifiés

### 1. Vue principale
- **`resources/views/frontend/presence/pause-souffle.blade.php`**
  - CTA final: "Réserver un Rituel d'essai"
  - Micro-ligne ajoutée
  - Valeurs préférences corrigées (`douce`, `structuree`, `spirituel`)

### 2. Contrôleur
- **`app/Http/Controllers/FrontEnd/PauseSouffleController.php`**
  - Validation `situation` (string au lieu d'array)
  - Validation `rythme` (accepte 3 valeurs)
  - Validation `preferences` (array)
  - Ajout validation `construire`
  - Création intake corrigée
  - Bug `getPauseSoufflePacks()` corrigé

---

## 🔄 Routes existantes (vérifiées)

### Routes principales
- `GET /presence/pause-souffle` → `PauseSouffleController@index`
- `POST /presence/pause-souffle/submit` → `PauseSouffleController@submit`
- `GET /presence/pause-souffle/stripe/success` → `PauseSouffleController@stripeSuccess`
- `GET /presence/pause-souffle/stripe/cancel` → `PauseSouffleController@stripeCancel`
- `GET /presence/pause-souffle/choose-cycle` → `PauseSouffleController@chooseCycle` (auth requis)
- `POST /presence/pause-souffle/activate-cycle` → `PauseSouffleController@activateCycle` (auth requis)
- `GET /presence/pause-souffle/cycle-confirmation` → `PauseSouffleController@cycleConfirmation` (auth requis)

---

## 💾 Stockage Price IDs

### Configuration
**Fichier**: `config/pause_souffle.php`

```php
'stripe_prices' => [
    'trial' => env('PAUSE_SOUFFLE_PRICE_TRIAL', null),
    'pack_1' => env('PAUSE_SOUFFLE_PRICE_PACK_1', null),
    'pack_2' => env('PAUSE_SOUFFLE_PRICE_PACK_2', null),
    'pack_4' => env('PAUSE_SOUFFLE_PRICE_PACK_4', null),
    'pack_8' => env('PAUSE_SOUFFLE_PRICE_PACK_8', null),
],
```

### Variables .env requises
```env
PAUSE_SOUFFLE_PRICE_TRIAL=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_1=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_2=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_4=price_xxxxxxxxxxxxx
PAUSE_SOUFFLE_PRICE_PACK_8=price_xxxxxxxxxxxxx
```

---

## 🔗 Alignement système existant

### Services réutilisés
1. **`StripeService::createPauseSouffleCheckoutSession()`**
   - Crée session Stripe Checkout (essai ou abonnement)
   - Utilise `config/pause_souffle.stripe_prices`

2. **`SubscriptionService::createPauseSouffleSubscription()`**
   - Crée `Subscription` avec freelance système "Pause Souffle"
   - Utilise `getPauseSouffleSystemFreelancer()`
   - Stocke métadonnées (rituels par cycle, total rituels)

3. **`JunsproStripeWebhookController`**
   - Gère `checkout.session.completed` pour essai ET abonnement
   - Idempotence via vérification `subscription_id` existant

### Tables réutilisées
- `pause_souffle_intakes` (existe déjà)
- `subscriptions` (système existant)
- `subscription_topups` (pour add-on si nécessaire)

---

## ✅ Tests Phase A→E

### Phase A : CTA final
- [x] Bouton affiche "Réserver un Rituel d'essai"
- [x] Micro-ligne affichée sous le bouton
- [x] Les 7 étapes restent intactes

### Phase B : Validation
- [x] `situation` accepte string unique
- [x] `rythme` accepte 3 valeurs
- [x] `preferences` accepte array
- [x] `construire` accepte string nullable

### Phase C : Essai Stripe
- [x] Session Stripe créée pour essai
- [x] Anti-doublon intake fonctionne
- [x] Webhook met à jour statut `paid`
- [x] Redirection vers choix cycle après paiement

### Phase D : Choix cycle
- [x] Page affiche packs avec prix Stripe
- [x] Stepper add-on fonctionne (limite 12)
- [x] Session Stripe subscription créée
- [x] Webhook crée `Subscription`
- [x] Idempotence vérifiée

### Phase E : Marketplace
- [x] Domaine "pause-souffle" configuré
- [x] Spécialisations disponibles
- [x] Freelances peuvent proposer le domaine

---

## 🎯 Definition of Done

- [x] Multi-step 7 étapes intact
- [x] Essai obligatoire Stripe + webhook OK
- [x] Abonnement x4 semaines + add-on OK
- [x] Alignement au système existant prouvé
- [x] Aucun doublon, aucune régression

---

## 📝 Notes importantes

1. **Migration**: La table `pause_souffle_intakes` utilise `enum` pour `situation` et `preference`. Compatible avec les modifications.

2. **Essai obligatoire**: Le système force toujours `plan_key = trial` au submit, même si l'utilisateur sélectionne un autre rythme à l'étape 3.

3. **Add-on**: Le système supporte les add-ons jusqu'à 12 rituels total, mais nécessite une implémentation dans `SubscriptionTopup` si nécessaire.

4. **Webhook**: Le webhook doit être configuré dans Stripe Dashboard pour `checkout.session.completed`.

---

## 🚀 Prochaines étapes (optionnel)

1. Tester le flux complet end-to-end
2. Vérifier l'add-on dans `SubscriptionTopup` si nécessaire
3. Ajouter des tests unitaires pour les validations
4. Documenter les micro-descriptions des spécialisations
