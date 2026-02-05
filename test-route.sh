#!/bin/bash
# Script pour tester la route - Termux

echo "=== Test de la route /freelance/services/create ==="
echo ""

# Aller dans le dossier du projet
cd junspro-main3

# Vérifier que la route existe
echo "1. Vérification de la route..."
php artisan route:list --name=freelance.services.create
echo ""

# Tester avec curl (si disponible)
if command -v curl &> /dev/null; then
    echo "2. Test de la route avec curl..."
    echo "URL: http://localhost:8000/freelance/services/create"
    echo ""
    curl -v http://localhost:8000/freelance/services/create 2>&1 | head -n 30
else
    echo "2. curl n'est pas installé. Installez-le avec: pkg install curl"
    echo "   Ou testez directement dans votre navigateur: http://localhost:8000/freelance/services/create"
fi

echo ""
echo "=== Test terminé ==="

