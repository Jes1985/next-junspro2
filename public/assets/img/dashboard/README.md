# Images du Dashboard Freelance

## Image de la carte de citation

Pour remplacer l'image de la carte de citation par votre propre image :

1. Placez votre image dans ce dossier (`public/assets/img/dashboard/`)
2. Nommez-la `inspiration-quote.jpg` (ou modifiez le nom dans `overview.blade.php`)
3. Formats recommandés : JPG, PNG, WebP
4. Dimensions recommandées : 800x400px minimum (ratio 2:1)
5. Poids recommandé : < 200KB pour de meilleures performances

### Image actuelle

L'image actuelle utilise une photo Unsplash de haute qualité représentant la productivité et la créativité.

Pour utiliser votre propre image, modifiez dans `resources/views/frontend/freelance/dashboard/tabs/overview.blade.php` :

```blade
<img src="{{ asset('assets/img/dashboard/inspiration-quote.jpg') }}" alt="Inspiration" class="quote-image" loading="lazy">
```
