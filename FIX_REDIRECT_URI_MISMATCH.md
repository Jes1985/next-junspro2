# 🔧 Fix : Erreur redirect_uri_mismatch (Google OAuth)

## ❌ Problème

L'erreur **"redirect_uri_mismatch"** apparaît lorsque l'URL de redirection configurée dans Google Cloud Console ne correspond **pas exactement** à celle utilisée par l'application.

---

## ✅ Solution

### 1. Vérifier l'URL utilisée par l'application

L'application utilise cette URL de redirection :
```
http://localhost:8000/login/google/callback
```

**⚠️ IMPORTANT :** Cette URL doit être **exactement identique** dans Google Cloud Console (même avec/sans trailing slash, même protocole http/https).

---

### 2. Configurer dans Google Cloud Console

1. Allez sur : https://console.cloud.google.com/
2. Sélectionnez votre projet
3. **APIs & Services** → **Credentials**
4. Cliquez sur votre **OAuth 2.0 Client ID**
5. Dans **Authorized redirect URIs**, ajoutez **exactement** :

   **Pour le développement local :**
   ```
   http://localhost:8000/login/google/callback
   ```

   **Pour la production :**
   ```
   https://votre-domaine.com/login/google/callback
   ```

6. **Sauvegardez**

---

### 3. Points importants

✅ **L'URL doit être identique** (même protocole, même domaine, même chemin)
✅ **Pas de trailing slash** : `/login/google/callback` (pas `/login/google/callback/`)
✅ **Respecter http vs https** : en local utilisez `http://`, en production `https://`
✅ **Pas d'espaces** avant ou après l'URL

---

### 4. Vérification

Après avoir ajouté l'URL dans Google Cloud Console :

1. Attendez quelques secondes (la propagation peut prendre 1-2 minutes)
2. Testez à nouveau la connexion Google
3. L'erreur `redirect_uri_mismatch` devrait disparaître

---

### 5. Pour Facebook

Même principe pour Facebook :

**URL de redirection :**
```
http://localhost:8000/login/facebook/callback
```

**Dans Facebook Developers :**
1. Allez dans votre app Facebook
2. **Settings** → **Basic**
3. **Valid OAuth Redirect URIs**
4. Ajoutez : `http://localhost:8000/login/facebook/callback`
5. Sauvegardez

---

## 🔍 Debug

Si l'erreur persiste :

1. **Vérifiez l'URL exacte** utilisée par l'application :
   - Ouvrez les outils développeur (F12)
   - Onglet Network
   - Cliquez sur "Continuer avec Google"
   - Regardez l'URL de redirection dans la requête

2. **Comparez avec Google Cloud Console** :
   - L'URL doit être **exactement identique**

3. **Vérifiez le protocole** :
   - `http://` en local
   - `https://` en production

---

## 📝 Note

Le code a été mis à jour pour utiliser `url('/login/google/callback')` qui génère automatiquement l'URL complète basée sur votre configuration Laravel (`APP_URL` dans `.env`).

Assurez-vous que `APP_URL` dans votre `.env` correspond à votre domaine :
```env
APP_URL=http://localhost:8000
```

