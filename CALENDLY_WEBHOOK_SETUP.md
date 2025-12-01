# Comment Configurer les Webhooks Calendly

## ⚠️ Important : Calendly n'a pas de webhook dans l'interface standard

Calendly utilise l'**API REST** pour les webhooks. Il faut les configurer via l'API ou les Workflows.

---

## Méthode 1 : Via l'API Calendly (Recommandé)

### Étape 1 : Créer un Personal Access Token

1. Allez sur : https://calendly.com/integrations/api_webhooks
   - Ou : **Centre d'administration** → **Integrations & apps** → Cherchez "API & Webhooks"

2. Si vous ne voyez pas cette section, allez directement sur :
   ```
   https://calendly.com/integrations/api_webhooks
   ```

3. Cliquez sur **"Create Token"** ou **"Créer un token"**

4. Donnez un nom au token (ex: "Junspro Webhook")

5. Copiez le token (commence par `...`) - **⚠️ Vous ne pourrez le voir qu'une seule fois !**

6. Ajoutez-le dans votre `.env` :
   ```env
   CALENDLY_API_KEY=votre_token_ici
   ```

### Étape 2 : Créer le webhook via l'API

Une fois que vous avez le token, vous devez créer le webhook via une requête API.

**Option A : Utiliser un outil comme Postman ou cURL**

```bash
curl --request POST \
  --url https://api.calendly.com/webhook_subscriptions \
  --header 'Authorization: Bearer VOTRE_TOKEN' \
  --header 'Content-Type: application/json' \
  --data '{
    "url": "https://votre-domaine.com/mission/calendly/callback",
    "events": ["invitee.created"],
    "organization": "https://api.calendly.com/organizations/VOTRE_ORG_ID",
    "user": "https://api.calendly.com/users/VOTRE_USER_ID"
  }'
```

**Option B : Utiliser un script PHP (plus simple)**

Créez un fichier temporaire `setup_calendly_webhook.php` :

```php
<?php
$token = 'VOTRE_TOKEN_CALENDLY';
$webhookUrl = 'https://votre-domaine.com/mission/calendly/callback';

// Récupérer l'organisation
$ch = curl_init('https://api.calendly.com/users/me');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$user = json_decode($response, true);
curl_close($ch);

$orgUri = $user['resource']['current_organization'];

// Créer le webhook
$ch = curl_init('https://api.calendly.com/webhook_subscriptions');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'url' => $webhookUrl,
    'events' => ['invitee.created'],
    'organization' => $orgUri,
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
```

---

## Méthode 2 : Via Workflows Calendly (Plus simple pour commencer)

### Étape 1 : Créer un Workflow

1. Dans Calendly, allez dans **Flux de travail** (Workflows)
2. Cliquez sur **"Créer un flux de travail"** ou **"+ Créer"**
3. Sélectionnez **"Invitee created"** (Quand un invité crée une réservation)

### Étape 2 : Ajouter une action "Webhook"

1. Dans le workflow, ajoutez une action
2. Cherchez **"Webhook"** ou **"HTTP Request"**
3. Configurez :
   - **URL** : `https://votre-domaine.com/mission/calendly/callback`
   - **Method** : POST
   - **Headers** : `Content-Type: application/json`
   - **Body** : Sélectionnez les données à envoyer (invitee, event, etc.)

---

## Méthode 3 : Utiliser Zapier ou Make.com (Sans code)

Si vous utilisez Zapier ou Make.com :

1. Créez un "Zap" ou "Scenario"
2. Déclencheur : **Calendly** → **New Invitee Created**
3. Action : **Webhook** → **POST** vers votre URL

---

## 🎯 Solution Rapide pour Junspro

Pour votre cas, je recommande la **Méthode 1** avec l'API.

### Étapes simples :

1. **Obtenir le token** :
   - Allez sur : https://calendly.com/integrations/api_webhooks
   - Créez un Personal Access Token
   - Copiez-le et ajoutez-le dans `.env`

2. **Créer le webhook** :
   - Je peux créer un script PHP pour vous qui fait ça automatiquement
   - Ou vous pouvez utiliser Postman/cURL

3. **URL du webhook** :
   ```
   https://votre-domaine.com/mission/calendly/callback
   ```

---

## 📝 Notes Importantes

- Calendly envoie les webhooks en **POST** avec un payload JSON
- Le webhook doit être accessible publiquement (HTTPS en production)
- Pour tester en local, utilisez **ngrok**
- Calendly vérifie l'URL du webhook avant de l'activer

---

## 🔗 Liens Utiles

- **Calendly API Docs** : https://developer.calendly.com/api-docs
- **Webhooks Calendly** : https://developer.calendly.com/api-docs/ZG9jOjM2MzE2MDM4-webhooks
- **API & Webhooks Page** : https://calendly.com/integrations/api_webhooks


