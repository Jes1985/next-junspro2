# Images Hero pour les pages Services

## 📋 Fichiers requis

Pour chaque page de service, vous pouvez ajouter une image hero personnalisée.

### Pages disponibles :

1. **Services Corporate** (`/services/corporate`)
   - Nom du fichier : `services-corporate-hero.png` (ou `.jpg`, `.jpeg`, `.webp`)
   - Emplacement : `public/images/` ou `public/assets/img/`

2. **Services Projects** (`/services/projects`)
   - Nom du fichier : `services-projets-hero.png`
   - Emplacement : `public/images/` ou `public/assets/img/`

3. **Services Lessons** (`/services/lessons`)
   - Nom du fichier : `services-cours-hero.png`
   - Emplacement : `public/images/` ou `public/assets/img/`

4. **Services At Home** (`/services/at-home`)
   - Nom du fichier : `services-services-at-home-hero.png`
   - Emplacement : `public/images/` ou `public/assets/img/`

5. **Junspro Ritual Motion** (`/services/wellnesslive`)
   - Nom du fichier : `services-wellnesslive-hero.png`
   - Emplacement : `public/images/` ou `public/assets/img/`

6. **Services HomeSwap** (`/services/homeswap`)
   - Nom du fichier : `services-echanges-de-logement-hero.png`
   - Emplacement : `public/images/` ou `public/assets/img/`

## 🎨 Spécifications recommandées pour l'image Corporate

### Dimensions
- **Largeur** : Minimum 1920px (recommandé 2560px pour Retina)
- **Hauteur** : Environ 600-800px (ratio 16:9 ou 3:1)
- **Format** : PNG (transparence) ou JPG (plus léger)

### Style et contenu
- **Sujet** : Équipe en séance de bien-être, yoga en entreprise, méditation de groupe, massage assis, ou espace de détente professionnel
- **Ambiance** : Lumineuse, apaisante, professionnelle mais chaleureuse
- **Couleurs** : Harmonie avec la palette Junspro (bleu royal #1e40af → violet #7c3aed)
- **Style** : Moderne, premium, pas trop corporate, nette et professionnelle

### Taille du fichier
- **Optimisée pour le web** : < 500KB recommandé
- Utilisez des outils comme TinyPNG ou ImageOptim pour compresser

## 📍 Emplacements acceptés

L'image sera automatiquement détectée si elle est placée dans :

1. `public/images/services-corporate-hero.png` ✅ (recommandé)
2. `public/images/services-corporate-hero.jpg` ✅
3. `public/assets/img/services-corporate-hero.png` ✅
4. `public/assets/img/services-corporate-hero.jpg` ✅

## 🎯 Exemple pour Corporate

Pour la page "Bien-être en entreprise", placez votre image sous le nom :

```
public/images/services-corporate-hero.png
```

ou

```
public/assets/img/services-corporate-hero.png
```

## 🔄 Fallback

Si aucune image n'est trouvée, un **gradient premium** (bleu royal → violet) sera affiché automatiquement comme placeholder.

## ✅ Vérification

1. Placez votre image dans `public/images/services-corporate-hero.png`
2. Videz le cache : `php artisan cache:clear`
3. Rechargez la page `/services/corporate` (Ctrl+F5)
4. L'image devrait s'afficher dans la section hero

## 📝 Notes

- Les noms de fichiers sont **sensibles à la casse** sur certains systèmes
- Utilisez des **traits d'union** (`-`) plutôt que des espaces ou underscores
- Les formats supportés sont : PNG, JPG, JPEG, WebP

