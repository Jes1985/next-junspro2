#!/bin/bash

###############################################################################
# Script de Mise à Jour Rapide - test.junspro.com
# Pour mettre à jour un déploiement existant
###############################################################################

set -e  # Arrêter en cas d'erreur

# Couleurs pour les messages
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
PROJECT_PATH="/var/www/test.junspro.com"
BACKUP_DIR="/var/backups/test.junspro.com"

echo -e "${GREEN}🔄 Mise à jour de test.junspro.com${NC}"

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "${PROJECT_PATH}/artisan" ]; then
    echo -e "${RED}❌ Erreur: Le fichier artisan n'a pas été trouvé dans ${PROJECT_PATH}${NC}"
    exit 1
fi

cd ${PROJECT_PATH}

# Créer le répertoire de backup si nécessaire
mkdir -p ${BACKUP_DIR}

# 1. Backup de la base de données
echo -e "${YELLOW}💾 Création d'un backup de la base de données...${NC}"
if [ -f ".env" ]; then
    DB_DATABASE=$(grep DB_DATABASE .env | cut -d '=' -f2 | tr -d '"' | tr -d "'" | xargs)
    DB_USERNAME=$(grep DB_USERNAME .env | cut -d '=' -f2 | tr -d '"' | tr -d "'" | xargs)
    DB_PASSWORD=$(grep DB_PASSWORD .env | cut -d '=' -f2 | tr -d '"' | tr -d "'" | xargs)
    
    if [ ! -z "$DB_DATABASE" ] && [ ! -z "$DB_USERNAME" ]; then
        TIMESTAMP=$(date +%Y%m%d_%H%M%S)
        BACKUP_FILE="${BACKUP_DIR}/backup_${TIMESTAMP}.sql"
        
        if [ ! -z "$DB_PASSWORD" ]; then
            mysqldump -u${DB_USERNAME} -p${DB_PASSWORD} ${DB_DATABASE} > ${BACKUP_FILE} 2>/dev/null || {
                echo -e "${YELLOW}⚠️  Backup échoué, mais on continue...${NC}"
            }
        else
            mysqldump -u${DB_USERNAME} ${DB_DATABASE} > ${BACKUP_FILE} 2>/dev/null || {
                echo -e "${YELLOW}⚠️  Backup échoué, mais on continue...${NC}"
            }
        fi
        
        if [ -f "${BACKUP_FILE}" ] && [ -s "${BACKUP_FILE}" ]; then
            echo -e "${GREEN}✓ Backup créé: ${BACKUP_FILE}${NC}"
        fi
    else
        echo -e "${YELLOW}⚠️  Informations de base de données non trouvées, pas de backup${NC}"
    fi
fi

# 2. Backup du .env
echo -e "${YELLOW}💾 Backup du fichier .env...${NC}"
if [ -f ".env" ]; then
    cp .env ${BACKUP_DIR}/.env.backup_$(date +%Y%m%d_%H%M%S)
    echo -e "${GREEN}✓ .env sauvegardé${NC}"
fi

# 3. Activer le mode maintenance
echo -e "${YELLOW}🔧 Activation du mode maintenance...${NC}"
php artisan down || true

# 4. Mettre à jour via Git (si configuré)
if [ -d ".git" ]; then
    echo -e "${YELLOW}📥 Mise à jour via Git...${NC}"
    git pull origin main || git pull origin master || {
        echo -e "${YELLOW}⚠️  Git pull échoué ou pas de repo Git${NC}"
    }
fi

# 5. Installer les dépendances Composer
echo -e "${YELLOW}📥 Installation des dépendances Composer...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

# 6. Installer les dépendances NPM et compiler les assets
echo -e "${YELLOW}📦 Compilation des assets...${NC}"
if [ -f "package.json" ]; then
    npm install --production
    npm run production || npm run build || {
        echo -e "${YELLOW}⚠️  Compilation des assets échouée${NC}"
    }
fi

# 7. Exécuter les migrations (SEULEMENT les nouvelles, pas fresh!)
echo -e "${YELLOW}🗄️  Exécution des migrations...${NC}"
php artisan migrate --force

# 8. Optimiser l'application
echo -e "${YELLOW}⚡ Optimisation de l'application...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache || true

# 9. Créer le lien symbolique de storage si nécessaire
php artisan storage:link || true

# 10. Définir les permissions
echo -e "${YELLOW}🔐 Configuration des permissions...${NC}"
sudo chown -R www-data:www-data ${PROJECT_PATH}
sudo chmod -R 755 ${PROJECT_PATH}
sudo chmod -R 775 ${PROJECT_PATH}/storage
sudo chmod -R 775 ${PROJECT_PATH}/bootstrap/cache

# 11. Redémarrer les services
echo -e "${YELLOW}🔄 Redémarrage des services...${NC}"
sudo systemctl reload php8.2-fpm || sudo systemctl reload php-fpm || true
sudo systemctl reload nginx || sudo systemctl reload apache2 || true

# 12. Désactiver le mode maintenance
echo -e "${YELLOW}✅ Désactivation du mode maintenance...${NC}"
php artisan up

# 13. Nettoyer les anciens backups (garder les 10 derniers)
echo -e "${YELLOW}🧹 Nettoyage des anciens backups...${NC}"
cd ${BACKUP_DIR}
ls -t *.sql 2>/dev/null | tail -n +11 | xargs rm -f || true
ls -t .env.backup_* 2>/dev/null | tail -n +11 | xargs rm -f || true

echo -e "${GREEN}✅ Mise à jour terminée avec succès!${NC}"
echo -e "${GREEN}🌐 Site disponible sur: https://test.junspro.com${NC}"

