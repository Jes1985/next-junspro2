# 🗄️ Créer la Base de Données Junspro

## ⚠️ Erreur Actuelle

L'application essaie de se connecter à la base de données `junspro` qui n'existe pas encore.

## ✅ Solution : Créer la Base de Données

### Méthode 1 : Via phpMyAdmin (Laragon) - RECOMMANDÉ

1. **Ouvrez Laragon**
2. Cliquez sur **Menu** → **Database** → **phpMyAdmin**
3. Dans phpMyAdmin, cliquez sur l'onglet **SQL**
4. Collez cette commande :

```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

5. Cliquez sur **Exécuter**

### Méthode 2 : Via MySQL en Ligne de Commande

Ouvrez un terminal PowerShell et exécutez :

```powershell
# Se connecter à MySQL (mot de passe vide par défaut dans Laragon)
mysql -u root

# Dans MySQL, exécutez :
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Méthode 3 : Via Laragon Terminal

1. Dans Laragon, cliquez sur **Menu** → **Database** → **MySQL**
2. Cela ouvre un terminal MySQL
3. Exécutez :

```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

## 🔄 Après la Création

Une fois la base créée, **rechargez votre navigateur** sur http://localhost:8000

L'application devrait maintenant fonctionner !

## 📝 Si Vous Voulez Exécuter les Migrations

Une fois la base créée, vous pouvez créer les tables :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan migrate
```

**Note** : Les migrations sont optionnelles pour tester rapidement. L'application peut fonctionner sans toutes les tables si vous testez juste le frontend.

