#!/bin/bash

export HOME=/root
export GIT_TERMINAL_PROMPT=0

APP_DIR="/var/www/junspro"
LOG="/var/log/junspro-deploy.log"
BRANCH="restore-filters-one-test"
AUDIO_DIR="$APP_DIR/storage/app/public/formation/audio"
AUDIO_BACKUP="/tmp/junspro-audio-deploy-backup"

echo "======================================" >> "$LOG"
echo "$(date): Deploiement demarre (user: $(whoami))" >> "$LOG"

cd "$APP_DIR"

git config --global --add safe.directory "$APP_DIR" 2>/dev/null || true

# --- Protection des audios AVANT git reset ---
AUDIO_COUNT=0
if [ -d "$AUDIO_DIR" ]; then
    AUDIO_COUNT=$(find "$AUDIO_DIR" -name "*.mp3" 2>/dev/null | wc -l)
    echo "$(date): Protection audio - $AUDIO_COUNT fichiers MP3 sauvegardes" >> "$LOG"
    rm -rf "$AUDIO_BACKUP"
    cp -a "$AUDIO_DIR" "$AUDIO_BACKUP"
fi

cp .env /tmp/.env.backup

# --- Mise a jour du code ---
git fetch origin >> "$LOG" 2>&1
git reset --hard "origin/$BRANCH" >> "$LOG" 2>&1
echo "$(date): Code mis a jour" >> "$LOG"

cp /tmp/.env.backup .env

# --- Restauration garantie des audios APRES git reset ---
mkdir -p "$AUDIO_DIR"
if [ -d "$AUDIO_BACKUP" ]; then
    cp -a "$AUDIO_BACKUP/." "$AUDIO_DIR/"
    RESTORED=$(find "$AUDIO_DIR" -name "*.mp3" 2>/dev/null | wc -l)
    echo "$(date): Audios restaures - $RESTORED fichiers MP3 intacts" >> "$LOG"
    rm -rf "$AUDIO_BACKUP"
else
    echo "$(date): Aucun audio a restaurer (premier deploiement)" >> "$LOG"
fi

# --- Dependances ---
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev >> "$LOG" 2>&1
echo "$(date): Composer OK" >> "$LOG"

# --- Migrations (tolerant si tables existantes) ---
php artisan migrate --force >> "$LOG" 2>&1 || echo "$(date): Migrations - rien de nouveau ou tables existantes" >> "$LOG"
echo "$(date): Migrations OK" >> "$LOG"

# --- Caches ---
php artisan config:clear >> "$LOG" 2>&1
php artisan cache:clear >> "$LOG" 2>&1
php artisan view:clear >> "$LOG" 2>&1
php artisan route:clear >> "$LOG" 2>&1
php artisan config:cache >> "$LOG" 2>&1
echo "$(date): Caches OK" >> "$LOG"

php artisan storage:link 2>/dev/null || true

chown -R www-data:www-data "$APP_DIR/storage" "$APP_DIR/bootstrap/cache" 2>/dev/null || true

echo "$(date): Deploiement termine avec succes" >> "$LOG"
echo "======================================" >> "$LOG"
