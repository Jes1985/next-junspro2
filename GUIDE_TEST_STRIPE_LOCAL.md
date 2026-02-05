# Guide Test Stripe en Local - Junspro

**Date**: 3 février 2026  
**Stripe CLI**: ✅ Installé (version 1.33.0)

---

## ✅ Stripe CLI est déjà installé

Votre système a Stripe CLI version **1.33.0** installé et accessible.

---

## 🚀 Démarrage rapide

### Étape 1 : Se connecter à Stripe

```powershell
stripe login
```

Cela ouvrira votre navigateur pour vous authentifier avec votre compte Stripe.

### Étape 2 : Démarrer le serveur Laravel

Dans un **premier terminal** :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan serve
```

Votre serveur doit être accessible sur `http://localhost:8000`

### Étape 3 : Rediriger les webhooks vers localhost

Dans un **deuxième terminal** (gardez-le ouvert) :

```powershell
stripe listen --forward-to http://localhost:8000/junspro/stripe/webhook
```

**Important** : Cette commande va afficher un secret webhook qui commence par `whsec_...`

**Exemple de sortie** :
```
> Ready! Your webhook signing secret is whsec_xxxxxxxxxxxxx (^C to quit)
```

### Étape 4 : Configurer le secret webhook

Copiez le secret affiché (`whsec_...`) et mettez-le dans votre `.env` :

```env
STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxxx
```

**OU** via l'interface admin :
- Allez dans **Passerelles de paiement** → **Stripe**
- Modifiez la clé `webhook_secret` avec le secret de Stripe CLI
- Sauvegardez

**Important** : Le secret change à chaque fois que vous relancez `stripe listen`, donc mettez à jour votre config à chaque fois.

---

## 🧪 Tester les webhooks

### Tester un événement de test

Dans un **troisième terminal** :

```powershell
# Tester un paiement réussi (abonnement)
stripe trigger invoice.payment_succeeded

# Tester un paiement échoué
stripe trigger invoice.payment_failed

# Tester une annulation d'abonnement
stripe trigger customer.subscription.deleted

# Tester checkout.session.completed (essai Pause Souffle)
stripe trigger checkout.session.completed
```

### Tester un checkout complet (Pause Souffle)

1. **Remplir le formulaire** sur `http://localhost:8000/presence/pause-souffle`
2. **Utiliser une carte de test Stripe** :
   - Numéro : `4242 4242 4242 4242`
   - Date : n'importe quelle date future (ex: `12/25`)
   - CVC : n'importe quel 3 chiffres (ex: `123`)
   - Code postal : n'importe quel code postal (ex: `75001`)
3. **Vérifier les logs** :
   ```powershell
   Get-Content storage\logs\laravel.log -Tail 50 -Wait
   ```

---

## 🔍 Vérifier que ça fonctionne

### Vérifier les logs Laravel

```powershell
# Voir les dernières lignes des logs
Get-Content storage\logs\laravel.log -Tail 50

# Suivre les logs en temps réel
Get-Content storage\logs\laravel.log -Tail 50 -Wait
```

### Vérifier dans Stripe CLI

Le terminal où `stripe listen` tourne affichera tous les événements reçus :

```
2026-02-03 15:30:45  --> checkout.session.completed [evt_xxxxx]
2026-02-03 15:30:45  <-- [200] POST http://localhost:8000/junspro/stripe/webhook
```

---

## 🎯 Événements spécifiques à tester

### Pour Pause Souffle

#### Essai (one-time payment)
```powershell
# Déclencher checkout.session.completed pour essai
stripe trigger checkout.session.completed
```

#### Abonnement cycle 4 semaines
```powershell
# Déclencher checkout.session.completed pour abonnement
stripe trigger checkout.session.completed

# OU déclencher invoice.payment_succeeded (après création subscription)
stripe trigger invoice.payment_succeeded
```

### Pour autres univers

```powershell
# Abonnement standard
stripe trigger invoice.payment_succeeded

# Paiement échoué
stripe trigger invoice.payment_failed

# Annulation
stripe trigger customer.subscription.deleted
```

---

## 🔄 Alternatives à Stripe CLI

### Option 1 : ngrok (tunnel HTTPS)

Si vous préférez utiliser ngrok pour exposer votre localhost :

1. **Installer ngrok** : https://ngrok.com/download
2. **Démarrer le tunnel** :
   ```powershell
   ngrok http 8000
   ```
3. **Configurer le webhook dans Stripe Dashboard** :
   - URL : `https://xxxxx.ngrok.io/junspro/stripe/webhook`
   - Récupérer le secret depuis Stripe Dashboard

**Avantages** :
- Secret webhook permanent (ne change pas)
- Peut être utilisé pour tester depuis un vrai appareil mobile

**Inconvénients** :
- Nécessite un compte ngrok (gratuit avec limitations)
- URL change à chaque redémarrage (version gratuite)

### Option 2 : Stripe Dashboard (mode test)

Vous pouvez aussi tester directement depuis Stripe Dashboard :

1. **Créer un webhook de test** dans Stripe Dashboard
2. **Utiliser l'URL ngrok** ou un service similaire
3. **Tester les événements** depuis Stripe Dashboard → Webhooks → Votre webhook → "Send test webhook"

**Avantages** :
- Interface graphique
- Peut simuler des événements spécifiques

**Inconvénients** :
- Nécessite un tunnel (ngrok ou équivalent)
- Moins flexible que Stripe CLI

---

## ⚠️ Points importants

### 1. Garder Stripe CLI actif
La commande `stripe listen` doit rester active pendant tous vos tests. Si vous la fermez, les webhooks ne seront plus redirigés.

### 2. Secret webhook temporaire
Le secret généré par Stripe CLI change à chaque connexion. Vous devez le mettre à jour dans votre config à chaque fois.

### 3. Mode test vs production
- **Local** : Utilisez Stripe CLI avec vos clés de test (`sk_test_...`)
- **Production** : Configurez le webhook dans Stripe Dashboard avec vos clés live (`sk_live_...`)

### 4. Cartes de test Stripe

Pour tester les paiements, utilisez ces cartes :

| Scénario | Numéro de carte | CVC | Date |
|----------|----------------|-----|------|
| Paiement réussi | `4242 4242 4242 4242` | `123` | Future |
| Paiement refusé | `4000 0000 0000 0002` | `123` | Future |
| 3D Secure requis | `4000 0025 0000 3155` | `123` | Future |

---

## 🐛 Dépannage

### Erreur : "stripe: command not found"
- Stripe CLI est installé, mais peut-être pas dans le PATH
- Vérifiez avec : `stripe --version`
- Si erreur, ajoutez Stripe CLI au PATH Windows

### Webhooks non reçus
1. Vérifiez que `stripe listen` est actif
2. Vérifiez que Laravel tourne sur le port 8000
3. Vérifiez l'URL dans la commande : `http://localhost:8000/junspro/stripe/webhook`
4. Vérifiez les logs Laravel

### Erreur "Invalid signature"
- Vérifiez que le secret webhook dans `.env` correspond à celui affiché par `stripe listen`
- Le secret change à chaque connexion, mettez-le à jour

### Port 8000 déjà utilisé
Si le port 8000 est occupé, utilisez un autre port :

```powershell
# Démarrer Laravel sur un autre port
php artisan serve --port=8001

# Rediriger Stripe CLI vers ce port
stripe listen --forward-to http://localhost:8001/junspro/stripe/webhook
```

---

## 📝 Commandes utiles

```powershell
# Voir l'aide Stripe CLI
stripe --help

# Voir les événements en temps réel
stripe listen

# Rediriger vers une URL spécifique
stripe listen --forward-to http://localhost:8000/junspro/stripe/webhook

# Déclencher un événement de test
stripe trigger checkout.session.completed
stripe trigger invoice.payment_succeeded
stripe trigger invoice.payment_failed
stripe trigger customer.subscription.deleted

# Voir les logs Stripe
stripe logs tail

# Voir les événements récents
stripe events list
```

---

## ✅ Checklist de test

Avant de tester Pause Souffle :

- [ ] Stripe CLI installé et accessible (`stripe --version`)
- [ ] Connecté à Stripe (`stripe login`)
- [ ] Serveur Laravel démarré (`php artisan serve`)
- [ ] `stripe listen` actif dans un terminal séparé
- [ ] Secret webhook copié dans `.env` ou interface admin
- [ ] Variables Stripe configurées dans `.env` :
  - [ ] `STRIPE_KEY` (clé publique test)
  - [ ] `STRIPE_SECRET` (clé secrète test)
  - [ ] `STRIPE_WEBHOOK_SECRET` (secret de Stripe CLI)
- [ ] Price IDs Pause Souffle configurés dans `.env` :
  - [ ] `PAUSE_SOUFFLE_PRICE_TRIAL`
  - [ ] `PAUSE_SOUFFLE_PRICE_PACK_1`
  - [ ] `PAUSE_SOUFFLE_PRICE_PACK_2`
  - [ ] `PAUSE_SOUFFLE_PRICE_PACK_4`
  - [ ] `PAUSE_SOUFFLE_PRICE_PACK_8`

---

## 🎯 Prochaines étapes

Une fois Stripe CLI configuré, vous pouvez :

1. **Tester le flux complet Pause Souffle** :
   - Remplir les 7 étapes
   - Payer l'essai avec une carte de test
   - Vérifier que le webhook confirme le paiement
   - Choisir un cycle
   - Activer l'abonnement
   - Vérifier que la subscription est créée

2. **Tester les autres univers** :
   - Créer un abonnement sur `/freelancer/{id}/subscribe`
   - Vérifier que le webhook crée la subscription

3. **Vérifier les logs** :
   - Consulter `storage/logs/laravel.log`
   - Vérifier les tables `pause_souffle_intakes` et `subscriptions` dans la DB

---

## 📚 Ressources

- **Stripe CLI Docs** : https://stripe.com/docs/stripe-cli
- **Stripe Test Cards** : https://stripe.com/docs/testing
- **Stripe Webhooks** : https://stripe.com/docs/webhooks
- **Guide projet** : `GUIDE_STRIPE_CLI.md` (déjà dans le projet)
