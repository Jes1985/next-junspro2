# Configuration Rapide des Webhooks

## 🚀 Configuration en 5 minutes

### Stripe Webhook

1. **Stripe Dashboard** → **Developers** → **Webhooks** → **Add endpoint**

2. **URL** :
   ```
   https://votre-domaine.com/mission/stripe/webhook
   ```

3. **Événement** : Sélectionner `checkout.session.completed`

4. **Secret** : Copier le secret et l'ajouter dans `.env` :
   ```env
   STRIPE_WEBHOOK_SECRET=whsec_...
   ```

### Calendly Webhook

1. **Calendly Settings** → **Integrations** → **Webhooks** → **Add webhook**

2. **URL** :
   ```
   https://votre-domaine.com/mission/calendly/callback
   ```

3. **Événements** : Sélectionner `invitee.created`

4. **API Key** : Créer dans **Settings** → **API & Webhooks** et ajouter dans `.env` :
   ```env
   CALENDLY_API_KEY=votre_token
   ```

## 📋 URLs des Webhooks

- **Stripe** : `POST /mission/stripe/webhook`
- **Calendly** : `POST /mission/calendly/callback`

## ✅ Test

1. Créer une mission de test
2. Payer avec carte test Stripe : `4242 4242 4242 4242`
3. Vérifier que la mission est créée et l'email envoyé

---

**Guide complet** : Voir `WEBHOOKS_SETUP_GUIDE.md`


