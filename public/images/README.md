# Image Hero Parrainage

## Fichier requis

Placez votre image hero de parrainage sous le nom :

```
parrainage-hero.png
```

## Spécifications recommandées

- **Format** : PNG (ou JPG/WebP)
- **Dimensions** : Minimum 2000px de largeur recommandé
- **Ratio** : Environ 16:9 ou 2:1 (largeur > hauteur)
- **Sujet** : Collaboration / coaching / deux personnes en séance professionnelle
- **Style** : Ambiance chaleureuse, premium, pas trop corporate, pas trop sombre, nette
- **Taille fichier** : Optimisée pour le web (< 500KB recommandé)

## Emplacement

Le fichier doit être placé ici :
```
public/images/parrainage-hero.png
```

## Utilisation

L'image est automatiquement utilisée dans le composant Hero de la page `/parrainage`.

Si l'image n'existe pas, un placeholder SVG sera affiché temporairement.

## Styles appliqués

L'image sera affichée avec :
- `object-fit: cover` (remplit le panneau droit)
- `object-position: center` (centrée)
- Hauteur : 560px sur desktop, 280px sur mobile
- Split 50/50 avec le contenu texte à gauche

