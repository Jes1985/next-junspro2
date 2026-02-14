# Déployer la refonte /about sur junspro.com

## Diagnostic : pourquoi les changements ne sont pas visibles ?

Les modifications sont dans le fichier local suivant :
- `resources/views/frontend/aboutus.blade.php`

Le site https://junspro.com est servi par un serveur de production. Pour que les changements soient visibles, il faut **déployer ce fichier sur le serveur** puis **vider les caches**.

---

## Étapes à suivre

### 1. Vérifier localement
```bash
cd junspro-main3
php artisan optimize:clear
php artisan view:clear
php artisan serve
```
Ouvrir http://127.0.0.1:8000/about — vous devez voir « Moins de pression. Plus de progrès. »

### 2. Commiter et pousser
```bash
git add resources/views/frontend/aboutus.blade.php
git commit -m "Refonte /about Junspro 50/50"
git push origin main
```

### 3. Déployer sur le serveur
- Si vous utilisez `deploy.sh` : exécuter le script après le push
- Si déploiement manuel : copier le fichier sur le serveur dans le même chemin

### 4. Sur le serveur (après déploiement)
```bash
cd /var/www/junspro/current   # ou votre chemin de déploiement
php artisan optimize:clear
php artisan view:clear
```

### 5. Vérifier
Ouvrir https://junspro.com/about — le H1 « Moins de pression. Plus de progrès. » doit apparaître.

---

## Fichiers concernés
| Fichier | Action |
|---------|--------|
| `resources/views/frontend/aboutus.blade.php` | Modifié (+777 / -227 lignes) |
