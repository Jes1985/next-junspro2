# 🚀 Guide pour Lancer le Serveur Local avec Laragon

## Prérequis ✅

- ✅ Laragon installé et démarré
- ✅ PHP 8.2+ installé
- ✅ Composer installé
- ✅ MySQL démarré dans Laragon

## 📋 Étapes Rapides

### 1. Vérifier que Laragon est démarré

Ouvrez **Laragon** et vérifiez que :
- ✅ Apache/Nginx est démarré (vert)
- ✅ MySQL est démarré (vert)

### 2. Installer les dépendances (si pas déjà fait)

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
composer install
```

### 3. Créer le fichier .env

Si le fichier `.env` n'existe pas, créez-le avec cette configuration minimale :

```env
APP_NAME=Junspro
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=junspro
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Laravel Nova (optionnel pour le développement local)
NOVA_LICENSE_KEY=
NOVA_APP_NAME="Junspro Admin"
```

### 4. Générer la clé d'application

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan key:generate
```

### 5. Créer la base de données

Ouvrez **phpMyAdmin** depuis Laragon ou utilisez la ligne de commande :

```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Exécuter les migrations (optionnel pour tester)

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan migrate
```

### 7. Créer le lien symbolique pour le stockage

```powershell
php artisan storage:link
```

### 8. Lancer le serveur de développement

**Option A : Avec `php artisan serve` (Recommandé pour le développement)**

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php artisan serve
```

Le serveur sera accessible sur : **http://localhost:8000**

**Option B : Avec Laragon directement**

1. Dans Laragon, cliquez sur **"Menu"** → **"Apache"** → **"Sites"**
2. Ajoutez votre projet ou utilisez le dossier existant
3. Accédez via : **http://junspro.test** (si configuré dans Laragon)

## 🎯 Accès aux Pages

- **Frontend** : http://localhost:8000
- **Admin** : http://localhost:8000/admin (si configuré)
- **Laravel Nova** : http://localhost:8000/nova (si configuré)

## ⚙️ Configuration Laragon

### Si vous voulez utiliser Laragon avec un nom de domaine local :

1. Ouvrez Laragon
2. Menu → **Apache** → **Sites**
3. Ajoutez un nouveau site :
   - **Site name** : `junspro`
   - **Path** : `C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\public`
4. Redémarrez Apache
5. Accédez via : **http://junspro.test**

## 🔧 Dépannage

### Erreur "No application encryption key"

```powershell
php artisan key:generate
```

### Erreur "Database connection"

Vérifiez dans `.env` :
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=junspro`
- `DB_USERNAME=root`
- `DB_PASSWORD=` (vide par défaut dans Laragon)

### Erreur "Class not found"

```powershell
composer dump-autoload
```

### Permissions (si nécessaire)

```powershell
php artisan storage:link
```

## 📝 Notes

- Le serveur `php artisan serve` se lance sur le port **8000** par défaut
- Vous pouvez changer le port : `php artisan serve --port=8080`
- Pour arrêter le serveur, appuyez sur **Ctrl+C** dans le terminal

## ✅ Vérification

Une fois le serveur lancé, ouvrez votre navigateur et allez sur :
- http://localhost:8000

Vous devriez voir la page d'accueil de Junspro !

