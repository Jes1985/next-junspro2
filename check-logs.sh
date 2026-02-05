#!/bin/bash
# Script pour vérifier les logs Laravel - Termux

echo "=== Vérification des logs Laravel ==="
echo ""

# Aller dans le dossier du projet
cd junspro-main3

# Vérifier si le fichier de log existe
if [ -f "storage/logs/laravel.log" ]; then
    echo "✓ Fichier de log trouvé"
    echo ""
    
    # Afficher les 50 dernières lignes
    echo "=== 50 dernières lignes du log ==="
    tail -n 50 storage/logs/laravel.log
    echo ""
    
    # Chercher les erreurs récentes liées à FreelanceServiceController
    echo "=== Erreurs récentes FreelanceServiceController ==="
    tail -n 200 storage/logs/laravel.log | grep -i "FreelanceServiceController\|freelance.services.create" -A 5 -B 5
    echo ""
    
    # Chercher les erreurs récentes (dernières 100 lignes)
    echo "=== Erreurs récentes (ERROR/Exception) ==="
    tail -n 100 storage/logs/laravel.log | grep -i "ERROR\|Exception\|404" | tail -n 10
    echo ""
    
    # Compter le nombre total de lignes
    echo "=== Statistiques ==="
    echo "Nombre total de lignes dans le log: $(wc -l < storage/logs/laravel.log)"
    echo "Taille du fichier: $(du -h storage/logs/laravel.log | cut -f1)"
else
    echo "✗ Fichier de log non trouvé: storage/logs/laravel.log"
    echo "Le fichier sera créé automatiquement lors de la première erreur."
fi

