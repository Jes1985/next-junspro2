# Événements Stripe Webhook - Junspro V2

## 📋 Événements à sélectionner dans Stripe Dashboard

Lors de la création du webhook dans Stripe Dashboard, sélectionnez **exactement ces 3 événements** :

### 1. ✅ `invoice.payment_succeeded`
**Quand :** Un paiement d'abonnement est réussi  
**Action :** 
- Met l'abonnement en statut `active`
- Met à jour `next_billing_at`
- Notifie le client et le freelance
- Crée un log d'audit

### 2. ✅ `invoice.payment_failed`
**Quand :** Un paiement d'abonnement échoue  
**Action :**
- Met l'abonnement en statut `past_due`
- Notifie le client
- Crée un log d'audit

### 3. ✅ `customer.subscription.deleted`
**Quand :** Un abonnement Stripe est supprimé/annulé  
**Action :**
- Met l'abonnement en statut `cancelled`
- Met à jour `ends_at`
- Notifie le client
- Crée un log d'audit

---

## 🎯 Comment sélectionner dans Stripe Dashboard

1. **Allez sur** : https://dashboard.stripe.com/webhooks
2. **Cliquez sur** : "Add endpoint" ou "Ajouter un point de terminaison"
3. **URL** : `https://votre-domaine.com/junspro/stripe/webhook`
4. **Dans "Select events to listen to"** :
   - Cliquez sur **"Select events"** ou **"Sélectionner des événements"**
   - Cherchez et cochez **uniquement ces 3 événements** :
     - ✅ `invoice.payment_succeeded`
     - ✅ `invoice.payment_failed`
     - ✅ `customer.subscription.deleted`
5. **Cliquez sur** : "Add endpoint" ou "Ajouter"

---

## 📝 Événements optionnels (non nécessaires pour l'instant)

Ces événements sont gérés par le code mais ne sont pas critiques :
- `customer.subscription.updated` - Si vous voulez détecter les modifications d'abonnement
- `customer.subscription.created` - Si vous voulez détecter les créations
- `payment_intent.succeeded` - Pour plus de sécurité (déjà géré par invoice.payment_succeeded)

**Note :** Pour Junspro V2, les 3 événements listés ci-dessus sont suffisants.

---

## ✅ Résumé

**Événements OBLIGATOIRES :**
1. `invoice.payment_succeeded`
2. `invoice.payment_failed`
3. `customer.subscription.deleted`

**Total : 3 événements**

---

## 🔗 URL du webhook

```
https://votre-domaine.com/junspro/stripe/webhook
```

**Pour le développement local avec ngrok :**
```
https://votre-id-ngrok.ngrok.io/junspro/stripe/webhook
```

---

## ⚠️ Important

- Ne sélectionnez **QUE ces 3 événements** pour éviter de surcharger votre serveur
- Les autres événements Stripe ne sont pas nécessaires pour Junspro V2
- Vous pourrez toujours ajouter d'autres événements plus tard si besoin

