# 🔍 Comment Vérifier la Connexion à la Base de Données

## ✅ Méthode 1 : Vérifier le fichier .env

Ouvrez le fichier `.env` et vérifiez ces lignes :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=junspro_db    ← C'est ici que vous voyez quelle base est utilisée
DB_USERNAME=root
DB_PASSWORD=
```

## ✅ Méthode 2 : Tester la Connexion avec Tinker

Exécutez cette commande dans PowerShell :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan tinker --execute="echo 'Base connectée: ' . DB::connection()->getDatabaseName();"
```

Cela affichera le nom de la base de données actuellement connectée.

## ✅ Méthode 3 : Compter les Tables

Pour confirmer que c'est bien `junspro_db` (qui a 74 tables) :

```powershell
php artisan tinker --execute="echo 'Tables: ' . count(DB::select('SHOW TABLES'));"
```

Si vous voyez **74 tables**, c'est bien `junspro_db` ! ✅

## ✅ Méthode 4 : Lister les Tables

Pour voir les premières tables :

```powershell
php artisan tinker --execute="print_r(array_slice(DB::select('SHOW TABLES'), 0, 10));"
```

## ✅ Méthode 5 : Via le Navigateur

1. Allez sur http://localhost:8000
2. Si la page se charge sans erreur de base de données, c'est que la connexion fonctionne ✅
3. Si vous voyez une erreur "Unknown database", vérifiez le `.env`

## 🔍 Comment Savoir si c'est la Bonne Base ?

**Indices que c'est `junspro_db` :**
- ✅ 74 tables dans la base
- ✅ Tables comme `languages`, `users`, `subscriptions`, `work_sessions`, etc.
- ✅ Taille d'environ 1,7 MiB (visible dans HeidiSQL)

**Si vous voyez une autre base :**
- Vérifiez le fichier `.env` : `DB_DATABASE` doit être `junspro_db`
- Videz le cache : `php artisan config:clear`

## 🚨 Si la Connexion Échoue

1. **Vérifiez que MySQL est démarré** dans Laragon (icône verte)
2. **Vérifiez les identifiants** dans `.env` :
   - `DB_USERNAME=root` (par défaut Laragon)
   - `DB_PASSWORD=` (vide par défaut Laragon)
3. **Testez la connexion** :
   ```powershell
   php artisan db:show
   ```

