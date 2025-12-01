# Guide de Déploiement - test.junspro.com

Ce guide vous accompagne pour déployer le projet Junspro sur le sous-domaine **test.junspro.com** sur votre VPS IONOS.

## 📋 Prérequis

- Accès SSH au VPS IONOS (IP: 85.215.146.171)
- Sous-domaine `test.junspro.com` configuré avec DNS pointant vers l'IP du VPS
- Certificat SSL déjà attribué (visible dans votre interface IONOS)
- PHP 8.2+ installé sur le serveur
- Composer installé
- MySQL/MariaDB configuré
- Nginx ou Apache configuré

## 🚀 Étapes de Déploiement

### 1. Connexion au Serveur

```bash
ssh root@85.215.146.171
# ou
ssh votre-utilisateur@85.215.146.171
```

### 2. Préparation de l'Environnement Serveur

#### Créer la structure de répertoires

```bash
# Créer le répertoire principal
sudo mkdir -p /var/www/test.junspro.com
sudo mkdir -p /var/backups/test.junspro.com
sudo mkdir -p /var/www/test.junspro.com/shared/{storage,storage/app,storage/framework,storage/logs,bootstrap/cache}

# Définir les permissions
sudo chown -R www-data:www-data /var/www/test.junspro.com
sudo chmod -R 755 /var/www/test.junspro.com
```

#### Installer les dépendances système (si nécessaire)

```bash
# PHP et extensions
sudo apt update
sudo apt install -y php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath

# Composer (si non installé)
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js et NPM (si nécessaire pour les assets)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

### 3. Transfert des Fichiers du Projet

#### Option A : Via Git (Recommandé)

```bash
cd /var/www/test.junspro.com
sudo git clone https://votre-repo.git .
# ou si vous avez déjà un repo
sudo git pull origin main
```

#### Option B : Via SCP depuis votre machine locale

Depuis votre machine Windows (PowerShell) :

```powershell
# Compresser le projet (exclure node_modules, .git, etc.)
cd C:\Users\younes\junspro
# Utiliser WinRAR, 7-Zip ou tar pour créer une archive

# Transférer via SCP
scp -r junspro.tar.gz root@85.215.146.171:/tmp/

# Sur le serveur, extraire
ssh root@85.215.146.171
cd /var/www/test.junspro.com
tar -xzf /tmp/junspro.tar.gz
```

#### Option C : Via rsync (si disponible)

```bash
# Depuis votre machine locale (avec rsync installé)
rsync -avz --exclude='node_modules' --exclude='.git' --exclude='storage' \
  C:\Users\younes\junspro\ root@85.215.146.171:/var/www/test.junspro.com/
```

### 4. Configuration de l'Environnement

#### Créer le fichier .env

```bash
cd /var/www/test.junspro.com
sudo cp .env.example .env
sudo nano .env
```

#### Configuration minimale du .env pour test.junspro.com

```env
APP_NAME=Junspro
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_GENEREE
APP_DEBUG=false
APP_URL=https://test.junspro.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=junspro_test
DB_USERNAME=votre_utilisateur_db
DB_PASSWORD=votre_mot_de_passe_db

# ... autres configurations (Stripe, Calendly, Zoom, etc.)
```

#### Générer la clé d'application

```bash
cd /var/www/test.junspro.com
php artisan key:generate
```

#### Déplacer .env vers le répertoire shared

```bash
sudo mv .env /var/www/test.junspro.com/shared/.env
sudo ln -s /var/www/test.junspro.com/shared/.env /var/www/test.junspro.com/.env
```

### 5. Configuration de la Base de Données

#### Créer la base de données

```bash
mysql -u root -p
```

```sql
CREATE DATABASE junspro_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'junspro_user'@'localhost' IDENTIFIED BY 'mot_de_passe_securise';
GRANT ALL PRIVILEGES ON junspro_test.* TO 'junspro_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Exécuter les migrations

```bash
cd /var/www/test.junspro.com
php artisan migrate --force
```

### 6. Installation des Dépendances

```bash
cd /var/www/test.junspro.com

# Installer les dépendances Composer
composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances NPM et compiler les assets
npm install --production
npm run production
```

### 7. Configuration des Permissions

```bash
cd /var/www/test.junspro.com

# Permissions pour storage et cache
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Créer le lien symbolique pour storage
php artisan storage:link
```

### 8. Configuration du Serveur Web

#### Configuration Nginx

Créer le fichier de configuration :

```bash
sudo nano /etc/nginx/sites-available/test.junspro.com
```

Contenu de la configuration :

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name test.junspro.com;
    
    # Redirection HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name test.junspro.com;
    
    root /var/www/test.junspro.com/public;
    index index.php index.html;

    # Configuration SSL (IONOS gère généralement cela)
    # ssl_certificate /etc/ssl/certs/test.junspro.com.crt;
    # ssl_certificate_key /etc/ssl/private/test.junspro.com.key;
    
    # Si IONOS utilise Let's Encrypt automatiquement, ces lignes peuvent être omises

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Optimisations
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss application/json;
}
```

Activer le site :

```bash
sudo ln -s /etc/nginx/sites-available/test.junspro.com /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### Configuration Apache (Alternative)

Si vous utilisez Apache :

```bash
sudo nano /etc/apache2/sites-available/test.junspro.com.conf
```

```apache
<VirtualHost *:80>
    ServerName test.junspro.com
    Redirect permanent / https://test.junspro.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName test.junspro.com
    DocumentRoot /var/www/test.junspro.com/public

    <Directory /var/www/test.junspro.com/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/test.junspro.com_error.log
    CustomLog ${APACHE_LOG_DIR}/test.junspro.com_access.log combined

    # Configuration SSL (gérée par IONOS)
</VirtualHost>
```

Activer :

```bash
sudo a2ensite test.junspro.com
sudo a2enmod rewrite ssl
sudo systemctl reload apache2
```

### 9. Optimisation de l'Application

```bash
cd /var/www/test.junspro.com

# Mettre en cache la configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 10. Vérification du Déploiement

```bash
# Vérifier les permissions
ls -la /var/www/test.junspro.com

# Vérifier les logs en cas d'erreur
tail -f /var/www/test.junspro.com/storage/logs/laravel.log
tail -f /var/log/nginx/error.log  # ou /var/log/apache2/error.log

# Tester l'application
curl -I https://test.junspro.com
```

### 11. Configuration du Firewall (si nécessaire)

```bash
# Autoriser HTTP et HTTPS
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw reload
```

## 🔄 Déploiements Futurs

Pour les déploiements futurs, vous pouvez utiliser le script `deploy.sh` existant :

```bash
# Sur le serveur
cd /var/www/test.junspro.com
bash deploy.sh
```

Ou créer un script de déploiement simplifié pour test.junspro.com :

```bash
# Créer deploy-test.sh
nano deploy-test.sh
```

## ⚠️ Points Importants

1. **Sécurité** :
   - `APP_DEBUG=false` en production
   - `APP_ENV=production`
   - Mots de passe forts pour la base de données
   - Permissions correctes sur les fichiers

2. **SSL** :
   - IONOS gère généralement les certificats SSL automatiquement
   - Vérifiez que HTTPS fonctionne correctement

3. **Backups** :
   - Configurez des backups réguliers de la base de données
   - Sauvegardez le répertoire `/var/www/test.junspro.com/shared/.env`

4. **Monitoring** :
   - Surveillez les logs régulièrement
   - Configurez un monitoring pour la disponibilité du site

## 🐛 Dépannage

### Erreur 502 Bad Gateway
- Vérifiez que PHP-FPM est démarré : `sudo systemctl status php8.2-fpm`
- Vérifiez les permissions : `sudo chown -R www-data:www-data /var/www/test.junspro.com`

### Erreur de permissions
```bash
sudo chown -R www-data:www-data /var/www/test.junspro.com
sudo chmod -R 755 /var/www/test.junspro.com
sudo chmod -R 775 /var/www/test.junspro.com/storage
sudo chmod -R 775 /var/www/test.junspro.com/bootstrap/cache
```

### Erreur de base de données
- Vérifiez les credentials dans `.env`
- Vérifiez que MySQL est démarré : `sudo systemctl status mysql`
- Testez la connexion : `mysql -u junspro_user -p junspro_test`

### Erreur SSL
- Vérifiez la configuration DNS
- Vérifiez que le certificat SSL est valide dans l'interface IONOS

## 📞 Support

En cas de problème, consultez :
- Les logs Laravel : `/var/www/test.junspro.com/storage/logs/laravel.log`
- Les logs Nginx/Apache : `/var/log/nginx/error.log` ou `/var/log/apache2/error.log`
- La documentation Laravel : https://laravel.com/docs

