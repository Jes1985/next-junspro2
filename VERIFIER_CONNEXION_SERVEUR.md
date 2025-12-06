# 🔍 Vérifier la Connexion sur le Serveur Linux

## ⚠️ Important

Vous êtes maintenant sur le **serveur Linux** (Ubuntu), pas sur votre machine Windows locale.

Les chemins Windows (`C:\Users\...`) ne fonctionnent **pas** sur Linux.

## ✅ Commandes Correctes pour le Serveur

### 1️⃣ Aller dans le répertoire du projet

```bash
cd /var/www/junspro
```

### 2️⃣ Vérifier la connexion à la base de données

```bash
php verifier-connexion.php
```

**OU** si le fichier n'existe pas encore sur le serveur :

```bash
# Vérifier directement avec artisan
php artisan tinker --execute="echo 'Base: ' . DB::connection()->getDatabaseName(); echo PHP_EOL; echo 'Tables: ' . count(DB::select('SHOW TABLES'));"
```

### 3️⃣ Vérifier la configuration .env

```bash
cd /var/www/junspro
grep "DB_DATABASE" .env
```

## 📋 Commandes Complètes

```bash
# 1. Aller dans le projet
cd /var/www/junspro

# 2. Vérifier la configuration
cat .env | grep DB_

# 3. Tester la connexion
php artisan tinker --execute="try { DB::connection()->getPdo(); echo '✅ Connecté à: ' . DB::connection()->getDatabaseName() . PHP_EOL; } catch (Exception \$e) { echo '❌ Erreur: ' . \$e->getMessage() . PHP_EOL; }"
```

## 🔍 Différence Windows vs Linux

| Windows (Local) | Linux (Serveur) |
|----------------|-----------------|
| `C:\Users\younes\...` | `/var/www/junspro` |
| PowerShell | Bash |
| `php verifier-connexion.php` | `php verifier-connexion.php` (même commande) |

## 💡 Note

Si vous voulez vérifier la connexion sur votre **machine Windows locale**, utilisez PowerShell :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php verifier-connexion.php
```

Mais sur le **serveur Linux**, utilisez :

```bash
cd /var/www/junspro
php verifier-connexion.php
```

