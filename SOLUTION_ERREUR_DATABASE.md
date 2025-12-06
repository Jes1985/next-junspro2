# ✅ Solution : Erreur "Unknown database 'junspro'"

## 🔍 Problème

L'application essaie de se connecter à la base de données `junspro` qui n'existe pas encore.

## ✅ Solution Rapide

### Méthode 1 : Via phpMyAdmin (Laragon) - LE PLUS SIMPLE

1. **Ouvrez Laragon**
2. Cliquez sur **Menu** (en haut à droite)
3. Cliquez sur **Database** → **phpMyAdmin**
4. Dans phpMyAdmin, cliquez sur l'onglet **SQL** (en haut)
5. Collez cette commande dans la zone de texte :

```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

6. Cliquez sur le bouton **Exécuter** (ou appuyez sur Ctrl+Entrée)

### Méthode 2 : Via le Terminal MySQL de Laragon

1. Dans Laragon, cliquez sur **Menu** → **Database** → **MySQL**
2. Cela ouvre un terminal MySQL
3. Tapez cette commande :

```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

4. Appuyez sur Entrée
5. Tapez `EXIT;` pour quitter

## 🔄 Après la Création

1. **Rechargez votre navigateur** sur http://localhost:8000
2. L'erreur devrait disparaître !

## 📝 Note

Le middleware a été amélioré pour gérer l'absence de la base de données, mais il est préférable de créer la base pour que l'application fonctionne correctement.

## 🚀 Si Vous Voulez Créer les Tables

Une fois la base créée, vous pouvez exécuter les migrations :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan migrate
```

**Note** : Les migrations sont optionnelles pour tester rapidement le frontend.

