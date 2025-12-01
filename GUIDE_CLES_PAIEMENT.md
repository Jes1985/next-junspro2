# Guide de Configuration des Clés API - Passerelles de Paiement

## ⚠️ Important

Les noms des clés dans le tableau **doivent correspondre exactement** à ce que l'application attend. Le système est sensible à la casse et aux noms.

## 📋 Configuration Stripe

### Champs requis dans le tableau Key-Value :

| **CLÉ (KEY)** | **VALEUR (VALUE)** | **Description** |
|--------------|-------------------|-----------------|
| `key` | `pk_test_...` ou `pk_live_...` | Clé publique Stripe |
| `secret` | `sk_test_...` ou `sk_live_...` | Clé secrète Stripe |
| `webhook_secret` | `whsec_...` | Secret webhook Stripe (optionnel) |

### ⚠️ Noms EXACTS requis :
- ✅ `key` (pas "clé publique", pas "public key")
- ✅ `secret` (pas "lé secrète", pas "secret key")
- ✅ `webhook_secret` (pas "lé secrète_whsec")

### Exemple de configuration :
```
KEY: key
VALUE: pk_test_51RQucq4J0Xssnw9ZioVU@roMdFGeqEqT8uef8UBviXsV4X7wBtj27YbemjtUrQRCT9ffHR0k03CXqzWicQrZ1dUC00k08rpBjT

KEY: secret
VALUE: sk_test_51RQucq4J0Xssnw9ZhD0u92dQkZQLncJSW0JxeFjTiYWgT2jCis5oUomRdJ0JKjsAtpbtFpz9WAsKypVwwLhrEmZe00SBrwv5kp

KEY: webhook_secret
VALUE: whsec_ZXz0XuoP2PvQTdyv7DhoH7zG0jqfpvm0
```

### Configuration du Mot-clé (keyword) :
- ✅ **Doit être** : `stripe` (en minuscules)
- ❌ **Ne doit PAS être** : "Clé publique", "lé secrète", ou autre

---

## 📋 Configuration PayPal

### Champs requis dans le tableau Key-Value :

| **CLÉ (KEY)** | **VALEUR (VALUE)** | **Description** |
|--------------|-------------------|-----------------|
| `client_id` | Client ID PayPal | ID client PayPal |
| `client_secret` | Secret PayPal | Secret client PayPal |
| `sandbox_status` | `0` ou `1` | 0 = Production, 1 = Sandbox (test) |

### ⚠️ Noms EXACTS requis :
- ✅ `client_id`
- ✅ `client_secret`
- ✅ `sandbox_status`

### Configuration du Mot-clé (keyword) :
- ✅ **Doit être** : `paypal` (en minuscules)

---

## 📋 Configuration Mollie

### Champs requis :

| **CLÉ (KEY)** | **VALEUR (VALUE)** |
|--------------|-------------------|
| `key` | Clé API Mollie |

### Configuration du Mot-clé (keyword) :
- ✅ **Doit être** : `mollie`

---

## 🔧 Comment corriger votre configuration actuelle

### Pour Stripe :

1. **Éditez** la passerelle Stripe dans Nova
2. **Corrigez le Mot-clé** : changez "lé secrète" en `stripe`
3. **Modifiez le tableau Informations** :

   **Supprimez** les lignes actuelles et **ajoutez** :

   ```
   KEY: key
   VALUE: [votre clé publique Stripe]
   
   KEY: secret
   VALUE: [votre clé secrète Stripe]
   
   KEY: webhook_secret
   VALUE: [votre secret webhook Stripe]
   ```

4. **Activez** la passerelle (cocher "Actif")
5. **Sauvegardez**

---

## ✅ Vérification

Après configuration, le système devrait :
- ✅ Charger les clés Stripe automatiquement
- ✅ Utiliser les bonnes clés pour les transactions
- ✅ Configurer les webhooks correctement

---

## 📝 Notes

- Les noms de clés sont **sensibles à la casse** (minuscules)
- Utilisez des **noms exacts** sans espaces ni caractères spéciaux
- Le **mot-clé (keyword)** doit correspondre au nom de la passerelle (stripe, paypal, etc.)
- Conservez vos clés API **secrètes** et ne les partagez jamais

---

**Date de création** : 24 novembre 2025


