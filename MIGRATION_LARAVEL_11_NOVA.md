# Migration vers Laravel 12 et Nova 5.2

## Notes importantes

Le projet actuel utilise Laravel 9. Pour migrer vers Laravel 12 + Nova 5.2, suivez ces étapes :

## 1. Mise à jour de composer.json

### Laravel 12
```json
"require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    ...
}
```

### Laravel Nova 5.2
```json
"require": {
    "laravel/nova": "^5.2",
    ...
}
```

## 2. Commandes de migration

```bash
# Mettre à jour les dépendances
composer update

# Publier les assets Nova
php artisan nova:publish

# Nettoyer le cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 3. Changements majeurs Laravel 12

- PHP 8.2+ requis
- Structure des providers modifiée
- Nouvelle structure de routes
- Middleware simplifié
- Améliorations de performance

## 4. Changements Nova 5.2

- Compatible Laravel 12
- Nouvelles fonctionnalités de filtrage
- Améliorations performances

## 5. Vérifications post-migration

- [ ] Toutes les migrations fonctionnent
- [ ] Nova Resources accessibles
- [ ] API routes fonctionnelles
- [ ] Services métier testés
- [ ] Relations Eloquent vérifiées

## 6. Tests recommandés

```bash
php artisan test
php artisan migrate:fresh --seed
```

## Note

Les fichiers créés pour Junspro V2 sont compatibles avec Laravel 12. 
Il faudra adapter les parties existantes du projet (Laravel 9) lors de la migration.

