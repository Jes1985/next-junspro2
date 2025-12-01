# Guide de Configuration des Webhooks

Ce guide explique comment configurer les webhooks Stripe et Calendly pour le système de missions Junspro.

---

## 🔴 Configuration Webhook Stripe

### Étape 1 : Accéder au Dashboard Stripe

1. Connectez-vous à votre compte Stripe : https://dashboard.stripe.com/
2. Allez dans **Developers** → **Webhooks** (dans le menu de gauche)

### Étape 2 : Créer un nouveau webhook

1. Cliquez sur **"Add endpoint"** ou **"Ajouter un point de terminaison"**

2. **URL du webhook** :
   ```
   https://votre-domaine.com/mission/stripe/webhook
   ```
   
   Pour le développement local avec ngrok :
   ```
   https://votre-id-ngrok.ngrok.io/mission/stripe/webhook
   ```

3. **Description** (optionnel) :
   ```
   Webhook Junspro - Missions client
   ```

### Étape 3 : Sélectionner les événements

Sélectionnez l'événement suivant :
- ✅ **`checkout.session.completed`** - Quand un paiement est complété

Vous pouvez aussi ajouter (optionnel) :
- `payment_intent.succeeded` - Pour plus de sécurité
- `payment_intent.payment_failed` - Pour gérer les échecs

### Étape 4 : Récupérer le secret du webhook

1. Après avoir créé le webhook, cliquez dessus
2. Dans la section **"Signing secret"**, cliquez sur **"Reveal"** ou **"Révéler"**
3. Copiez le secret (commence par `whsec_...`)

### Étape 5 : Ajouter le secret dans `.env`

Ajoutez le secret dans votre fichier `.env` :

```env
STRIPE_WEBHOOK_SECRET=whsec_votre_secret_ici
```

### Étape 6 : Tester le webhook

1. Dans Stripe Dashboard, allez sur votre webhook
2. Cliquez sur **"Send test webhook"** ou **"Envoyer un webhook de test"**
3. Sélectionnez l'événement `checkout.session.completed`
4. Vérifiez que votre application reçoit bien le webhook

### ⚠️ Important pour le développement local

Pour tester en local, utilisez **ngrok** :

1. **Installer ngrok** :
   ```bash
   # Via Chocolatey
   choco install ngrok -y
   
   # Ou télécharger depuis https://ngrok.com/download
   ```

2. **Lancer ngrok** :
   ```bash
   ngrok http 8000
   # (Remplacez 8000 par le port de votre serveur Laravel)
   ```

3. **Utiliser l'URL ngrok** dans Stripe :
   ```
   https://abc123.ngrok.io/mission/stripe/webhook
   ```

4. **Mettre à jour l'URL** dans Stripe quand vous redémarrez ngrok (l'URL change)

---

## 📅 Configuration Webhook Calendly

### Étape 1 : Accéder à Calendly

1. Connectez-vous à Calendly : https://calendly.com/
2. Allez dans **Settings** → **Integrations** → **Webhooks**

### Étape 2 : Créer un webhook

1. Cliquez sur **"Add webhook"** ou **"Ajouter un webhook"**

2. **URL du webhook** :
   ```
   https://votre-domaine.com/mission/calendly/callback
   ```
   
   Pour le développement local avec ngrok :
   ```
   https://votre-id-ngrok.ngrok.io/mission/calendly/callback
   ```

3. **Événements à écouter** :
   - ✅ **`invitee.created`** - Quand un invité crée une réservation
   - ✅ **`invitee.canceled`** - Quand une réservation est annulée (optionnel)
   - ✅ **`scheduled_event.created`** - Quand un événement est créé

### Étape 3 : Configurer l'authentification

Calendly peut utiliser une clé API pour l'authentification :

1. Allez dans **Settings** → **Integrations** → **API & Webhooks**
2. Créez une **Personal Access Token** si nécessaire
3. Ajoutez-le dans votre `.env` :
   ```env
   CALENDLY_API_KEY=votre_token_ici
   ```

### Étape 4 : Tester le webhook

1. Créez une réservation de test dans Calendly
2. Vérifiez que votre application reçoit le webhook
3. Vérifiez les logs dans Laravel pour voir les données reçues

---

## 🔧 Configuration dans Laravel

### Vérifier que les routes sont accessibles

Les routes webhooks ne doivent **PAS** avoir de middleware CSRF :

```php
// routes/web.php
Route::post('/mission/stripe/webhook', 'FrontEnd\ClientMissionController@stripeWebhook')
    ->name('mission.stripe.webhook')
    ->withoutMiddleware(['web']); // Important pour Stripe

Route::post('/mission/calendly/callback', 'FrontEnd\ClientMissionController@calendlyCallback')
    ->name('mission.calendly.callback')
    ->withoutMiddleware(['web']); // Important pour Calendly
```

### Vérifier les logs

Pour déboguer les webhooks, vérifiez les logs Laravel :

```bash
tail -f storage/logs/laravel.log
```

Ou dans Windows PowerShell :
```powershell
Get-Content storage\logs\laravel.log -Tail 50 -Wait
```

---

## 🧪 Test des Webhooks

### Test Stripe

1. **Créer une mission de test** via le formulaire client
2. **Compléter le paiement** avec une carte de test Stripe :
   - Numéro : `4242 4242 4242 4242`
   - Date : n'importe quelle date future
   - CVC : n'importe quel 3 chiffres
3. **Vérifier** que :
   - La mission est créée dans la base de données
   - Le statut passe à "Paiement_valide"
   - L'email de confirmation est envoyé

### Test Calendly

1. **Accéder au lien Calendly** reçu par email
2. **Réserver un créneau**
3. **Vérifier** que :
   - Le webhook Calendly est reçu
   - La réunion Zoom est créée
   - Le lien Zoom est enregistré dans la mission
   - L'email avec le lien Zoom est envoyé

---

## 🐛 Dépannage

### Webhook Stripe non reçu

1. **Vérifier l'URL** dans Stripe Dashboard
2. **Vérifier que le serveur est accessible** (pas de firewall)
3. **Vérifier les logs** Stripe Dashboard → Webhooks → Votre webhook → Logs
4. **Vérifier le secret** dans `.env`
5. **Tester avec Stripe CLI** (outil de test local) :
   ```bash
   stripe listen --forward-to localhost:8000/mission/stripe/webhook
   ```

### Webhook Calendly non reçu

1. **Vérifier l'URL** dans Calendly Settings
2. **Vérifier que le webhook est actif**
3. **Vérifier les logs** Calendly
4. **Vérifier la clé API** dans `.env`

### Erreur "Signature verification failed"

- **Stripe** : Vérifiez que `STRIPE_WEBHOOK_SECRET` correspond au secret du webhook
- **Calendly** : Vérifiez que la clé API est correcte

---

## 📝 Checklist de Configuration

### Stripe
- [ ] Webhook créé dans Stripe Dashboard
- [ ] URL correcte configurée
- [ ] Événement `checkout.session.completed` sélectionné
- [ ] Secret copié dans `.env` (STRIPE_WEBHOOK_SECRET)
- [ ] Webhook testé et fonctionnel

### Calendly
- [ ] Webhook créé dans Calendly Settings
- [ ] URL correcte configurée
- [ ] Événements sélectionnés (invitee.created, etc.)
- [ ] Clé API créée et ajoutée dans `.env` (CALENDLY_API_KEY)
- [ ] Webhook testé avec une réservation

### Laravel
- [ ] Routes webhooks accessibles sans CSRF
- [ ] Variables d'environnement configurées
- [ ] Logs activés pour le débogage
- [ ] Base de données accessible

---

## 🔗 Ressources Utiles

- **Stripe Webhooks** : https://stripe.com/docs/webhooks
- **Calendly Webhooks** : https://developer.calendly.com/api-docs/ZG9jOjM2MzE2MDM4-webhooks
- **ngrok** : https://ngrok.com/ (pour développement local)
- **Stripe CLI** : https://stripe.com/docs/stripe-cli (pour tester localement)

---

## ⚠️ Sécurité

1. **Ne jamais commiter** les secrets dans Git
2. **Utiliser HTTPS** en production
3. **Valider les signatures** des webhooks (fait automatiquement par le code)
4. **Limiter les IPs** autorisées si possible (Stripe fournit une liste d'IPs)
5. **Utiliser des variables d'environnement** pour tous les secrets

---

## 💡 Astuce Pro

Pour le développement, utilisez **Stripe CLI** qui permet de tester localement sans ngrok :

```bash
# Installer Stripe CLI
# Windows: choco install stripe-cli -y

# Tester localement
stripe listen --forward-to localhost:8000/mission/stripe/webhook
stripe trigger checkout.session.completed
```

Cela envoie des événements de test directement à votre application locale !


