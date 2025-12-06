# 🚀 Comment Accéder à Votre Projet Junspro

## ✅ Serveur Local Lancé !

Votre serveur Laravel est maintenant en cours d'exécution.

## 🌐 Accès au Projet

### **Sur votre ordinateur local :**
Ouvrez votre navigateur web et allez sur :

```
http://localhost:8000
```

## 📍 URLs Importantes

### Frontend (Site Public)
- **Accueil** : http://localhost:8000
- **Explorer les freelances** : http://localhost:8000/explore
- **Page freelance** : http://localhost:8000/freelance/{id}

### Administration
- **Admin classique** : http://localhost:8000/admin (si configuré)
- **Laravel Nova** : http://localhost:8000/nova (si configuré avec clé de licence)

## 🛑 Arrêter le Serveur

Pour arrêter le serveur, ouvrez le terminal où il tourne et appuyez sur :
- **Ctrl + C**

## 🔄 Relancer le Serveur

Si vous arrêtez le serveur, pour le relancer :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan serve
```

## 📝 Notes Importantes

1. **Base de données** : Assurez-vous que MySQL est démarré dans Laragon
2. **Migrations** : Si besoin, exécutez `php artisan migrate` pour créer les tables
3. **Port** : Le serveur utilise le port **8000** par défaut
4. **Changer le port** : `php artisan serve --port=8080` (si 8000 est occupé)

## 🔧 Si vous avez des erreurs

### Erreur de connexion à la base de données
- Vérifiez que MySQL est démarré dans Laragon
- Vérifiez les identifiants dans `.env` (DB_USERNAME, DB_PASSWORD, DB_DATABASE)

### Page blanche
- Vérifiez les logs : `storage/logs/laravel.log`
- Videz le cache : `php artisan cache:clear`

## 🎯 Prochaines Étapes

1. Créer la base de données `junspro` dans MySQL (via phpMyAdmin ou Laragon)
2. Exécuter les migrations si nécessaire
3. Commencer à tester votre application !

