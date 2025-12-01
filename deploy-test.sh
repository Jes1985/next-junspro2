#!/bin/bash

###############################################################################
# Script de Déploiement Simplifié - test.junspro.com
# Pour IONOS VPS
###############################################################################

set -e  # Arrêter en cas d'erreur

# Couleurs pour les messages
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration spécifique pour test.junspro.com
PROJECT_NAME="test.junspro.com"
DEPLOY_PATH="/var/www/${PROJECT_NAME}"
SHARED_PATH="${DEPLOY_PATH}/shared"

echo -e "${GREEN}🚀 Début du déploiement de ${PROJECT_NAME}${NC}"

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Erreur: Le fichier artisan n'a pas été trouvé.${NC}"
    echo "Assurez-vous d'exécuter ce script depuis la racine du projet Laravel."
    exit 1
fi

# Activer la maintenance
if [ -d "${DEPLOY_PATH}/public" ]; then
    echo -e "${YELLOW}🔧 Activation du mode maintenance...${NC}"
    php ${DEPLOY_PATH}/artisan down || true
fi

# Copier les fichiers vers le serveur (si exécuté localement, utiliser rsync)
# Si exécuté sur le serveur, les fichiers sont déjà là
if [ ! -d "${DEPLOY_PATH}" ]; then
    echo -e "${YELLOW}📂 Création du répertoire de déploiement...${NC}"
    sudo mkdir -p ${DEPLOY_PATH}
    sudo mkdir -p ${SHARED_PATH}/{storage,storage/app,storage/framework,storage/logs,bootstrap/cache}
fi

# Lier les fichiers partagés
echo -e "${YELLOW}🔗 Liaison des fichiers partagés...${NC}"
if [ -f "${SHARED_PATH}/.env" ]; then
    ln -sfn ${SHARED_PATH}/.env ${DEPLOY_PATH}/.env
fi
ln -sfn ${SHARED_PATH}/storage ${DEPLOY_PATH}/storage

# Installer les dépendances Composer
echo -e "${YELLOW}📥 Installation des dépendances Composer...${NC}"
cd ${DEPLOY_PATH}
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
sudo chown -R www-data:www-data ${DEPLOY_PATH}
sudo chmod -R 755 ${DEPLOY_PATH}
sudo chmod -R 775 ${DEPLOY_PATH}/storage
sudo chmod -R 775 ${DEPLOY_PATH}/bootstrap/cache

# Redémarrer les services si nécessaire
echo -e "${YELLOW}🔄 Redémarrage des services...${NC}"
sudo systemctl reload php8.2-fpm || sudo systemctl reload php-fpm || true
sudo systemctl reload nginx || sudo systemctl reload apache2 || true

# Désactiver la maintenance
echo -e "${YELLOW}✅ Désactivation du mode maintenance...${NC}"
php artisan up

echo -e "${GREEN}✅ Déploiement terminé avec succès!${NC}"
echo -e "${GREEN}🌐 Site disponible sur: https://test.junspro.com${NC}"

