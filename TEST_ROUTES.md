# Test des routes du dashboard

Pour vérifier que toutes les routes fonctionnent, testez ces URLs dans votre navigateur :

1. **Dashboard (Accueil)** : 
   - URL: `http://localhost:8000/user/account/dashboard`
   - Route: `client.dashboard.index`

2. **Messages** :
   - URL: `http://localhost:8000/user/account/messages`
   - Route: `client.messages.index`

3. **Abonnements (Projets & sessions)** :
   - URL: `http://localhost:8000/user/account/subscriptions`
   - Route: `client.subscriptions.index`

4. **Paramètres** :
   - URL: `http://localhost:8000/user/edit-profile`
   - Route: `user.edit_profile`

Si une route ne fonctionne pas, vérifiez :
- Les logs Laravel : `storage/logs/laravel.log`
- La console du navigateur (F12) pour des erreurs JavaScript
- Que vous êtes bien connecté avec un profil client
