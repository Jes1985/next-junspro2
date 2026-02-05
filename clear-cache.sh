#!/bin/bash
# Script pour vider les caches Laravel - Termux

echo "=== Vidage des caches Laravel ==="
echo ""

# Aller dans le dossier du projet
cd junspro-main3

# Vider le cache des routes
echo "1. Vidage du cache des routes..."
php artisan route:clear
echo "✓ Cache des routes vidé"
echo ""

# Vider le cache de configuration
echo "2. Vidage du cache de configuration..."
php artisan config:clear
echo "✓ Cache de configuration vidé"
echo ""

# Vider le cache général
echo "3. Vidage du cache général..."
php artisan cache:clear
echo "✓ Cache général vidé"
echo ""

# Vider le cache des vues
echo "4. Vidage du cache des vues..."
php artisan view:clear
echo "✓ Cache des vues vidé"
echo ""

# Optimiser (optionnel)
echo "5. Optimisation de l'application..."
php artisan optimize:clear
echo "✓ Optimisation terminée"
echo ""

echo "=== Tous les caches ont été vidés avec succès ==="
echo ""
echo "Vous pouvez maintenant tester: http://localhost:8000/freelance/services/create"

