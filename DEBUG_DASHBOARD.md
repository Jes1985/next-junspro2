# Debug : Le dashboard ne s'affiche pas

## Vérifications à faire

### 1. ⚠️ URL CORRECTE (CRUCIAL)

Assurez-vous d'utiliser la **BONNE URL** :
- ✅ `http://localhost:8000/user/dashboard` (avec les deux-points `:`)
- ❌ PAS `http://localhost8000.com/user/dashboard`

**Le `:` (deux-points) entre `localhost` et `8000` est ESSENTIEL !**

### 2. Vider les caches

```bash
cd junspro-main3
php artisan optimize:clear
php artisan view:clear
php artisan route:clear
```

### 3. Vérifier les logs Laravel

Ouvrez le fichier :
```
junspro-main3/storage/logs/laravel.log
```

Cherchez les dernières erreurs qui commencent par "Erreur dans ClientDashboardController@index".

### 4. Vérifier la console du navigateur

1. Appuyez sur **F12**
2. Onglet **"Console"**
3. Copiez les **premières erreurs** affichées

### 5. Vérifier que vous avez un ClientProfile

Dans votre base de données, vérifiez :
```sql
SELECT * FROM client_profiles WHERE user_id = VOTRE_USER_ID;
```

Si vous n'avez pas de `client_profiles`, créez-en un :
```sql
INSERT INTO client_profiles (user_id, created_at, updated_at) 
VALUES (VOTRE_USER_ID, NOW(), NOW());
```

### 6. Tester directement l'URL du dashboard client

Essayez d'accéder directement à :
```
http://localhost:8000/user/account/dashboard
```

Cela devrait charger le dashboard client directement sans passer par la redirection.

### 7. Vérifier que vous êtes bien connecté

Assurez-vous d'être connecté avec un compte utilisateur valide.

## Messages d'erreur courants

### "Vous devez avoir un profil client"
→ Solution : Créez un `ClientProfile` dans la base de données (voir point 5)

### Page blanche / Erreur 500
→ Vérifiez les logs Laravel (point 3)

### 404 Not Found
→ Vérifiez que vous utilisez la bonne URL avec `localhost:8000` (pas `localhost8000.com`)

### Erreurs JavaScript dans la console
→ Vérifiez la console du navigateur (point 4)
