# Guide de Déploiement avec Termius - test.junspro.com

Ce guide vous accompagne pour déployer/mettre à jour le projet Junspro sur **test.junspro.com** en utilisant **Termius** comme client SSH/SFTP.

## 📱 Configuration de Termius

### 1. Installation de Termius

- **Windows** : Téléchargez depuis [termius.com](https://www.termius.com/)
- **Mobile** : Disponible sur App Store et Google Play

### 2. Créer une Nouvelle Connexion SSH

1. Ouvrez Termius
2. Cliquez sur le bouton **"+"** ou **"Add Host"**
3. Remplissez les informations suivantes :

```
Label: test.junspro.com (ou Junspro VPS)
Address: 85.215.146.171
Port: 22
Username: root (ou votre utilisateur)
Authentication: Password ou Key
```

4. **Si vous utilisez un mot de passe** :
   - Sélectionnez "Password"
   - Entrez votre mot de passe
   - Cochez "Save password" si vous le souhaitez

5. **Si vous utilisez une clé SSH** :
   - Sélectionnez "Key"
   - Importez votre clé privée (.pem ou .ppk)

6. Cliquez sur **"Save"**

### 3. Se Connecter au Serveur

1. Dans la liste des hosts, cliquez sur votre connexion **test.junspro.com**
2. Termius va établir la connexion SSH
3. Vous verrez le terminal du serveur

## 🔍 Vérification de l'Installation Existante

Une fois connecté, vérifions ce qui existe déjà :

```bash
# Vérifier où se trouve le projet actuel
ls -la /var/www/

# Vérifier si test.junspro.com existe déjà
ls -la /var/www/test.junspro.com/

# Vérifier la configuration Nginx/Apache
ls -la /etc/nginx/sites-available/ | grep test
# ou
ls -la /etc/apache2/sites-available/ | grep test

# Vérifier la base de données actuelle
mysql -u root -p -e "SHOW DATABASES;" | grep junspro
```

## 📊 Utiliser la Même Base de Données

**OUI, vous pouvez utiliser la même base de données !** C'est même recommandé pour conserver les données existantes.

### Vérifier la Base de Données Actuelle

```bash
# Se connecter à MySQL
mysql -u root -p

# Lister les bases de données
SHOW DATABASES;

# Vérifier quelle base est utilisée (probablement junspro ou junspro_test)
# Sortir de MySQL
EXIT;
```

### Récupérer les Informations de la Base de Données

```bash
# Vérifier le fichier .env actuel (s'il existe)
cat /var/www/test.junspro.com/.env | grep DB_

# Ou si le projet est ailleurs
find /var/www -name ".env" -type f 2>/dev/null
```

## 🚀 Étapes de Mise à Jour/Déploiement

### Option A : Mise à Jour du Déploiement Existant

Si le site est déjà déployé, suivez ces étapes :

#### 1. Se Connecter via Termius

- Ouvrez Termius
- Connectez-vous à **test.junspro.com**

#### 2. Naviguer vers le Répertoire du Projet

```bash
cd /var/www/test.junspro.com
# ou
cd /var/www/junspro
# (selon où se trouve votre projet actuel)
```

#### 3. Activer le Mode Maintenance

```bash
php artisan down
```

#### 4. Sauvegarder la Base de Données (Important !)

```bash
# Créer un backup
mysqldump -u root -p NOM_DE_LA_BASE > /tmp/backup_$(date +%Y%m%d_%H%M%S).sql

# Remplacer NOM_DE_LA_BASE par le nom réel (ex: junspro, junspro_test)
```

#### 5. Mettre à Jour le Code

**Via Git (si configuré)** :
```bash
git pull origin main
# ou
git pull origin master
```

**Via SFTP dans Termius** :
1. Dans Termius, cliquez sur l'onglet **"SFTP"** (en bas)
2. Naviguez vers `/var/www/test.junspro.com`
3. Transférez vos fichiers modifiés
4. Ou utilisez la fonction de synchronisation

#### 6. Installer les Nouvelles Dépendances

```bash
# Mettre à jour Composer
composer install --no-dev --optimize-autoloader --no-interaction

# Mettre à jour NPM et compiler les assets
npm install --production
npm run production
```

#### 7. Exécuter les Migrations (si nouvelles)

```bash
# Vérifier les migrations en attente
php artisan migrate:status

# Exécuter les nouvelles migrations
php artisan migrate --force
```

#### 8. Optimiser l'Application

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

#### 9. Vérifier les Permissions

```bash
sudo chown -R www-data:www-data /var/www/test.junspro.com
sudo chmod -R 755 /var/www/test.junspro.com
sudo chmod -R 775 storage bootstrap/cache
```

#### 10. Redémarrer les Services

```bash
# Redémarrer PHP-FPM
sudo systemctl reload php8.2-fpm
# ou
sudo systemctl reload php-fpm

# Redémarrer Nginx
sudo systemctl reload nginx
# ou Apache
sudo systemctl reload apache2
```

#### 11. Désactiver le Mode Maintenance

```bash
php artisan up
```

### Option B : Nouveau Déploiement sur la Même Base

Si vous voulez redéployer complètement mais garder la base de données :

#### 1. Sauvegarder le .env Actuel

```bash
# Trouver le .env actuel
find /var/www -name ".env" -type f

# Le sauvegarder
cp /var/www/test.junspro.com/.env /tmp/.env.backup
```

#### 2. Noter les Informations de la Base de Données

```bash
cat /var/www/test.junspro.com/.env | grep DB_
```

Notez :
- `DB_DATABASE=nom_de_la_base`
- `DB_USERNAME=utilisateur`
- `DB_PASSWORD=mot_de_passe`

#### 3. Suivre les Étapes du Guide Initial

Suivez le guide `DEPLOY_TEST_JUNSPRO.md` mais :

- **Utilisez les mêmes informations de base de données** dans le nouveau `.env`
- **Ne créez pas une nouvelle base de données**
- **Ne faites PAS** `php artisan migrate:fresh` (cela effacerait les données !)
- Utilisez seulement `php artisan migrate` pour appliquer les nouvelles migrations

## 📁 Transfert de Fichiers avec Termius SFTP

### Méthode 1 : Interface SFTP de Termius

1. Dans Termius, cliquez sur l'onglet **"SFTP"** en bas
2. Connectez-vous à votre host
3. Naviguez vers le répertoire local (votre machine) et le répertoire distant (serveur)
4. Glissez-déposez les fichiers ou utilisez les boutons de transfert

### Méthode 2 : Synchronisation

1. Dans Termius SFTP, sélectionnez un dossier
2. Utilisez l'option "Sync" pour synchroniser les fichiers

### Méthode 3 : Via Terminal (rsync)

Depuis votre machine Windows (avec WSL ou Git Bash) :

```bash
# Synchroniser les fichiers (exclure node_modules, .git, etc.)
rsync -avz --exclude='node_modules' --exclude='.git' --exclude='storage' \
  --exclude='.env' \
  C:/Users/younes/junspro/ root@85.215.146.171:/var/www/test.junspro.com/
```

## 🔄 Script de Mise à Jour Rapide

Créez ce script sur le serveur pour faciliter les mises à jour futures :

```bash
nano /var/www/test.junspro.com/update.sh
```

Contenu :

```bash
#!/bin/bash
set -e

cd /var/www/test.junspro.com

echo "🔄 Mise à jour en cours..."

# Backup de la base de données
DB_NAME=$(grep DB_DATABASE .env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
DB_USER=$(grep DB_USERNAME .env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
DB_PASS=$(grep DB_PASSWORD .env | cut -d '=' -f2 | tr -d '"' | tr -d "'")

if [ ! -z "$DB_NAME" ]; then
    mysqldump -u${DB_USER} -p${DB_PASS} ${DB_NAME} > /tmp/backup_$(date +%Y%m%d_%H%M%S).sql
    echo "✅ Backup créé"
fi

# Mode maintenance
php artisan down

# Mise à jour (si Git)
# git pull origin main

# Dépendances
composer install --no-dev --optimize-autoloader --no-interaction
npm install --production
npm run production

# Migrations
php artisan migrate --force

# Optimisation
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permissions
sudo chown -R www-data:www-data .
sudo chmod -R 775 storage bootstrap/cache

# Redémarrage
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx

# Fin maintenance
php artisan up

echo "✅ Mise à jour terminée !"
```

Rendre exécutable :

```bash
chmod +x /var/www/test.junspro.com/update.sh
```

## ⚠️ Points Importants pour la Même Base de Données

1. **Ne PAS utiliser** `php artisan migrate:fresh` - cela efface toutes les données
2. **Utiliser** `php artisan migrate` - applique seulement les nouvelles migrations
3. **Sauvegarder toujours** avant de faire des migrations importantes
4. **Vérifier** que le `.env` pointe vers la bonne base de données
5. **Tester** les migrations en local d'abord si possible

## 🐛 Dépannage

### Erreur de connexion dans Termius
- Vérifiez l'adresse IP : `85.215.146.171`
- Vérifiez le port : `22`
- Vérifiez vos identifiants

### Erreur de permissions SFTP
```bash
sudo chown -R votre_utilisateur:www-data /var/www/test.junspro.com
```

### Erreur de base de données
- Vérifiez que la base de données existe toujours
- Vérifiez les credentials dans `.env`
- Testez la connexion : `mysql -u utilisateur -p nom_base`

## 📝 Checklist de Déploiement

- [ ] Connecté via Termius
- [ ] Backup de la base de données créé
- [ ] `.env` sauvegardé
- [ ] Fichiers transférés
- [ ] Dépendances installées
- [ ] Migrations exécutées (si nouvelles)
- [ ] Application optimisée
- [ ] Permissions vérifiées
- [ ] Services redémarrés
- [ ] Site testé sur https://test.junspro.com

## 🔗 Ressources

- [Documentation Termius](https://docs.termius.com/)
- Guide de déploiement complet : `DEPLOY_TEST_JUNSPRO.md`
- Script de déploiement : `deploy-test.sh`

