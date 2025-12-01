#!/bin/bash

###############################################################################
# Script de Déploiement Automatique - Junspro
# Pour IONOS VPS
###############################################################################

set -e  # Arrêter en cas d'erreur

# Couleurs pour les messages
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
PROJECT_NAME="junspro"
DEPLOY_PATH="/var/www/${PROJECT_NAME}"
BACKUP_PATH="/var/backups/${PROJECT_NAME}"
RELEASES_PATH="${DEPLOY_PATH}/releases"
CURRENT_PATH="${DEPLOY_PATH}/current"
SHARED_PATH="${DEPLOY_PATH}/shared"

echo -e "${GREEN}🚀 Début du déploiement de ${PROJECT_NAME}${NC}"

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Erreur: Le fichier artisan n'a pas été trouvé.${NC}"
    echo "Assurez-vous d'exécuter ce script depuis la racine du projet Laravel."
    exit 1
fi

# Créer le timestamp pour cette release
TIMESTAMP=$(date +%Y%m%d%H%M%S)
RELEASE_PATH="${RELEASES_PATH}/${TIMESTAMP}"

echo -e "${YELLOW}📦 Préparation de la release ${TIMESTAMP}${NC}"

# Créer les répertoires nécessaires
mkdir -p ${RELEASES_PATH}
mkdir -p ${BACKUP_PATH}
mkdir -p ${SHARED_PATH}/{storage,storage/app,storage/framework,storage/logs,bootstrap/cache}

# Activer la maintenance
if [ -d "${CURRENT_PATH}" ]; then
    echo -e "${YELLOW}🔧 Activation du mode maintenance...${NC}"
    php ${CURRENT_PATH}/artisan down || true
fi

# Créer un backup de la base de données (si MySQL)
if [ -f "${CURRENT_PATH}/.env" ]; then
    echo -e "${YELLOW}💾 Création d'un backup de la base de données...${NC}"
    DB_DATABASE=$(grep DB_DATABASE ${CURRENT_PATH}/.env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
    DB_USERNAME=$(grep DB_USERNAME ${CURRENT_PATH}/.env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
    DB_PASSWORD=$(grep DB_PASSWORD ${CURRENT_PATH}/.env | cut -d '=' -f2 | tr -d '"' | tr -d "'")
    
    if [ ! -z "$DB_DATABASE" ] && [ ! -z "$DB_USERNAME" ]; then
        mysqldump -u${DB_USERNAME} -p${DB_PASSWORD} ${DB_DATABASE} > ${BACKUP_PATH}/backup_${TIMESTAMP}.sql 2>/dev/null || true
        echo -e "${GREEN}✓ Backup créé: ${BACKUP_PATH}/backup_${TIMESTAMP}.sql${NC}"
    fi
fi

# Copier les fichiers vers la nouvelle release
echo -e "${YELLOW}📂 Copie des fichiers...${NC}"
mkdir -p ${RELEASE_PATH}
rsync -av --exclude='.git' --exclude='node_modules' --exclude='storage' --exclude='.env' \
    ./ ${RELEASE_PATH}/

# Lier les fichiers partagés
echo -e "${YELLOW}🔗 Liaison des fichiers partagés...${NC}"
ln -sfn ${SHARED_PATH}/.env ${RELEASE_PATH}/.env
ln -sfn ${SHARED_PATH}/storage ${RELEASE_PATH}/storage
rm -rf ${RELEASE_PATH}/bootstrap/cache/*
mkdir -p ${RELEASE_PATH}/bootstrap/cache

# Installer les dépendances Composer
echo -e "${YELLOW}📥 Installation des dépendances Composer...${NC}"
cd ${RELEASE_PATH}
composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances NPM et compiler les assets
echo -e "${YELLOW}📦 Compilation des assets...${NC}"
if [ -f "package.json" ]; then
    npm install --production
    npm run production || npm run build || true
fi

# Exécuter les migrations
echo -e "${YELLOW}🗄️  Exécution des migrations...${NC}"
php artisan migrate --force

# Optimiser l'application
echo -e "${YELLOW}⚡ Optimisation de l'application...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache || true

# Créer le lien symbolique de storage si nécessaire
php artisan storage:link || true

# Définir les permissions
echo -e "${YELLOW}🔐 Configuration des permissions...${NC}"
chown -R www-data:www-data ${RELEASE_PATH}
chmod -R 755 ${RELEASE_PATH}
chmod -R 775 ${RELEASE_PATH}/storage
chmod -R 775 ${RELEASE_PATH}/bootstrap/cache

# Activer la nouvelle release
echo -e "${YELLOW}🔄 Activation de la nouvelle release...${NC}"
ln -sfn ${RELEASE_PATH} ${CURRENT_PATH}

# Redémarrer les services si nécessaire
echo -e "${YELLOW}🔄 Redémarrage des services...${NC}"
systemctl reload php8.3-fpm || systemctl reload php-fpm || true
systemctl reload nginx || systemctl reload apache2 || true

# Désactiver la maintenance
echo -e "${YELLOW}✅ Désactivation du mode maintenance...${NC}"
php artisan up

# Nettoyer les anciennes releases (garder les 5 dernières)
echo -e "${YELLOW}🧹 Nettoyage des anciennes releases...${NC}"
cd ${RELEASES_PATH}
ls -t | tail -n +6 | xargs rm -rf || true

# Nettoyer les anciens backups (garder les 10 derniers)
echo -e "${YELLOW}🧹 Nettoyage des anciens backups...${NC}"
cd ${BACKUP_PATH}
ls -t | tail -n +11 | xargs rm -f || true

echo -e "${GREEN}✅ Déploiement terminé avec succès!${NC}"
echo -e "${GREEN}📌 Release active: ${TIMESTAMP}${NC}"


