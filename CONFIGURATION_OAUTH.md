# Configuration OAuth (Google & Facebook)

## 🔧 Configuration requise

Pour que les boutons de connexion sociale fonctionnent, vous devez configurer les clés OAuth dans l'interface d'administration.

---

## 📋 Configuration Google OAuth

### 1. Créer un projet Google Cloud

1. Allez sur : https://console.cloud.google.com/
2. Créez un nouveau projet ou sélectionnez un projet existant
3. Activez l'API "Google+ API" (ou "Google Identity")

### 2. Créer les identifiants OAuth

1. Allez dans **APIs & Services** → **Credentials**
2. Cliquez sur **Create Credentials** → **OAuth client ID**
3. Type d'application : **Web application**
4. **Authorized redirect URIs** : 
   ```
   http://localhost:8000/login/google/callback
   ```
   **⚠️ IMPORTANT :** L'URL doit être **exactement identique** (même protocole, même port, même chemin, pas de trailing slash)
   
   **Pour la production**, ajoutez aussi :
   ```
   https://votre-domaine.com/login/google/callback
   ```
   
   **⚠️ Ne pas oublier :** Chaque URL doit être sur une ligne séparée dans Google Cloud Console

### 3. Récupérer les clés

- **Client ID** : `xxxxx.apps.googleusercontent.com`
- **Client Secret** : `xxxxx`

### 4. Configurer dans l'admin Junspro

1. Allez dans **Admin** → **Paramètres de base** → **Plugins**
2. Section **Google Login**
3. Activez le statut : **Activé**
4. Entrez :
   - **Google Client ID** : Votre Client ID
   - **Google Client Secret** : Votre Client Secret
5. Sauvegardez

---

## 📋 Configuration Facebook OAuth

### 1. Créer une application Facebook

1. Allez sur : https://developers.facebook.com/
2. **My Apps** → **Create App**
3. Type : **Consumer** ou **Business**
4. Remplissez les informations

### 2. Configurer Facebook Login

1. Dans votre app, allez dans **Products** → **Facebook Login** → **Set Up**
2. **Settings** → **Valid OAuth Redirect URIs** :
   ```
   http://localhost:8000/login/facebook/callback
   ```
   **⚠️ IMPORTANT :** L'URL doit être **exactement identique** (même protocole, même port, même chemin)
   
   **Pour la production**, ajoutez aussi :
   ```
   https://votre-domaine.com/login/facebook/callback
   ```
   
   **⚠️ Ne pas oublier :** Chaque URL doit être sur une ligne séparée

### 3. Récupérer les clés

1. **Settings** → **Basic**
2. **App ID** : Votre App ID
3. **App Secret** : Votre App Secret (cliquez sur "Show")

### 4. Configurer dans l'admin Junspro

1. Allez dans **Admin** → **Paramètres de base** → **Plugins**
2. Section **Facebook Login**
3. Activez le statut : **Activé**
4. Entrez :
   - **Facebook App ID** : Votre App ID
   - **Facebook App Secret** : Votre App Secret
5. Sauvegardez

---

## ✅ Vérification

Après configuration :

1. Les boutons Google/Facebook apparaîtront automatiquement sur les pages de connexion/inscription
2. Si les clés ne sont pas configurées, les boutons seront masqués et seul le formulaire email sera disponible

## ⚠️ Erreur redirect_uri_mismatch

Si vous voyez l'erreur **"redirect_uri_mismatch"** :

1. Vérifiez que l'URL dans Google Cloud Console correspond **exactement** à celle utilisée par l'app
2. L'URL doit être : `http://localhost:8000/login/google/callback` (pour le local)
3. Vérifiez qu'il n'y a pas de trailing slash (`/` à la fin)
4. Vérifiez le protocole (`http://` vs `https://`)
5. Attendez 1-2 minutes après modification dans Google Cloud Console

**Voir le guide détaillé :** `FIX_REDIRECT_URI_MISMATCH.md`

---

## 🔒 Sécurité

- **Ne partagez jamais** vos clés secrètes
- Utilisez des clés différentes pour développement et production
- Vérifiez que les URLs de callback correspondent exactement

---

## 📝 Note

Si les clés OAuth ne sont pas configurées, **l'inscription par email fonctionne toujours**. Les boutons sociaux sont optionnels.

