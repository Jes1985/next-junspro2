# Guide d'Installation et Configuration Stripe CLI

## 📥 Installation Stripe CLI (Windows)

### Option 1 : Téléchargement manuel (Recommandé)

1. **Télécharger Stripe CLI** :
   - Allez sur : https://github.com/stripe/stripe-cli/releases/latest
   - Téléchargez `stripe_X.X.X_windows_x86_64.zip` (dernière version)

2. **Extraire l'archive** :
   - Extrayez le fichier `stripe.exe` dans un dossier accessible (ex: `C:\stripe-cli\`)

3. **Ajouter au PATH** :
   - Ouvrez "Variables d'environnement" (Windows + R → `sysdm.cpl` → Onglet "Avancé")
   - Cliquez sur "Variables d'environnement"
   - Dans "Variables système", trouvez `Path` et cliquez "Modifier"
   - Ajoutez le chemin : `C:\stripe-cli\` (ou votre chemin)
   - Cliquez "OK" partout

4. **Vérifier l'installation** :
   ```powershell
   stripe --version
   ```

### Option 2 : Via Chocolatey (nécessite admin)

Ouvrez PowerShell **en tant qu'administrateur** et exécutez :
```powershell
choco install stripe-cli --yes
```

---

## 🔐 Configuration Stripe CLI

### 1. Se connecter à Stripe

```powershell
stripe login
```

Cela ouvrira votre navigateur pour vous authentifier avec votre compte Stripe.

### 2. Rediriger les webhooks vers localhost

Dans un terminal séparé (gardez-le ouvert pendant vos tests) :

```powershell
stripe listen --forward-to http://localhost:8000/junspro/stripe/webhook
```

**Important** : Cette commande va afficher un **secret webhook** qui commence par `whsec_...`

**Exemple de sortie** :
```
> Ready! Your webhook signing secret is whsec_xxxxxxxxxxxxx (^C to quit)
```

### 3. Copier le secret webhook

Copiez le secret affiché (commence par `whsec_...`).

### 4. Mettre à jour la configuration

**Option A : Dans l'interface admin (recommandé pour tests locaux)**
- Allez dans **Passerelles de paiement** → **Stripe**
- Modifiez la clé `webhook_secret` avec le secret de Stripe CLI
- Sauvegardez

**Option B : Dans le fichier `.env` (si vous utilisez cette méthode)**
```env
STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxxx
```

---

## 🧪 Tester les webhooks

### 1. Démarrer votre serveur Laravel

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan serve
```

### 2. Garder Stripe CLI actif

Dans un autre terminal, gardez cette commande active :
```powershell
stripe listen --forward-to http://localhost:8000/junspro/stripe/webhook
```

### 3. Déclencher un événement de test

Dans un **troisième terminal** :

```powershell
# Tester un paiement réussi
stripe trigger invoice.payment_succeeded

# Tester un paiement échoué
stripe trigger invoice.payment_failed

# Tester une annulation d'abonnement
stripe trigger customer.subscription.deleted
```

### 4. Vérifier les logs Laravel

Vérifiez que les webhooks sont bien reçus dans `storage/logs/laravel.log` ou dans votre base de données (`audit_logs`, `notification_log`).

---

## 🔄 Configuration Production vs Développement

### Développement (localhost)
- Utilisez **Stripe CLI** avec `stripe listen`
- Secret webhook temporaire (commence par `whsec_...`)
- URL : `http://localhost:8000/junspro/stripe/webhook`

### Production
- Configurez le webhook dans **Stripe Dashboard**
- URL : `https://junspro.com/junspro/stripe/webhook`
- Secret webhook permanent depuis Stripe Dashboard
- Événements à sélectionner :
  - `invoice.payment_succeeded`
  - `invoice.payment_failed`
  - `customer.subscription.deleted`

---

## 📝 Commandes utiles

```powershell
# Voir l'aide
stripe --help

# Voir les événements en temps réel
stripe listen

# Rediriger vers une URL spécifique
stripe listen --forward-to http://localhost:8000/junspro/stripe/webhook

# Déclencher un événement de test
stripe trigger invoice.payment_succeeded

# Voir les logs
stripe logs tail
```

---

## ⚠️ Notes importantes

1. **Gardez Stripe CLI actif** : La commande `stripe listen` doit rester active pendant vos tests
2. **Secret temporaire** : Le secret généré par Stripe CLI change à chaque connexion
3. **Production** : N'utilisez pas Stripe CLI en production, configurez le webhook dans Stripe Dashboard
4. **Port 8000** : Assurez-vous que votre serveur Laravel tourne sur le port 8000 (ou modifiez l'URL dans la commande)

---

## 🆘 Dépannage

### Erreur : "stripe: command not found"
- Vérifiez que Stripe CLI est dans votre PATH
- Redémarrez votre terminal après l'ajout au PATH

### Erreur : "Unable to connect"
- Vérifiez que votre serveur Laravel est démarré (`php artisan serve`)
- Vérifiez que le port 8000 est libre

### Webhooks non reçus
- Vérifiez que `stripe listen` est actif
- Vérifiez que l'URL dans la commande correspond à votre route
- Vérifiez les logs Laravel (`storage/logs/laravel.log`)

