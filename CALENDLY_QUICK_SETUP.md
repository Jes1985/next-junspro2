# Configuration Rapide Calendly Webhook

## 📝 Étape 1 : Obtenir le Personal Access Token

1. Allez sur : **https://calendly.com/integrations/api_webhooks**
   - Si le lien ne fonctionne pas, essayez :
     - **Centre d'administration** → **Intégrations** → Cherchez "API & Webhooks"
     - Ou directement : **https://calendly.com/integrations**

2. Cliquez sur **"Create Token"** ou **"Créer un token"**

3. Donnez un nom (ex: "Junspro Webhook")

4. **⚠️ IMPORTANT** : Copiez le token immédiatement (vous ne pourrez le voir qu'une seule fois !)

5. Ajoutez-le dans votre `.env` :
   ```env
   CALENDLY_API_KEY=votre_token_ici
   ```

## 🚀 Étape 2 : Exécuter le script de configuration

1. Ouvrez le fichier `setup_calendly_webhook.php`

2. Modifiez les deux variables en haut :
   ```php
   $calendlyToken = 'VOTRE_TOKEN_CALENDLY_ICI';  // Collez votre token ici
   $webhookUrl = 'https://votre-domaine.com/mission/calendly/callback';  // Votre URL
   ```

3. Exécutez le script :
   ```bash
   php setup_calendly_webhook.php
   ```

Le script va :
- ✅ Récupérer vos informations Calendly
- ✅ Vérifier les webhooks existants
- ✅ Créer le webhook automatiquement
- ✅ Vous donner les détails du webhook créé

## ✅ C'est tout !

Une fois le script exécuté, votre webhook est configuré et Calendly enverra automatiquement les notifications quand un invité crée une réservation.

---

## 🔍 Vérification

Pour vérifier que le webhook fonctionne :

1. Créez une mission de test via le formulaire
2. Réservez un créneau via le lien Calendly
3. Vérifiez les logs Laravel pour voir si le webhook est reçu

---

## 🐛 Problèmes ?

Si le script ne fonctionne pas :
- Vérifiez que le token est correct
- Vérifiez que l'URL est accessible publiquement (HTTPS)
- Vérifiez les logs d'erreur PHP


