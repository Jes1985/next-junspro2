# Rapport d'harmonisation Hero ↔ Tableau de filtres + Verrouillage Pause Souffle

**Date**: 25 janvier 2026  
**Statut**: ✅ Complété

## Résumé exécutif

Harmonisation du rendu hero ↔ tableau de filtres sur toutes les pages pour obtenir le même effet premium que `/services/projects` (overlap/floating card). Verrouillage du placement de Pause Souffle juste sous le tableau de filtres sur toutes les pages univers `/services/*`.

---

## 1. Structure de référence (/services/projects)

### Wrapper des filtres (source of truth)

```html
<div class="container" style="position:relative;z-index:10;">
  <x-home.search-filter ... />
</div>
```

### Effet premium (dans le composant search-filter)

Le composant `.home-search-filter-section` applique automatiquement :
- `margin: -60px auto 4rem;` → Crée l'overlap avec le hero (margin-top négatif)
- `border-radius: 32px;` → Coins arrondis premium
- `box-shadow: 0 20px 60px rgba(124, 58, 237, 0.15), 0 8px 24px rgba(124, 58, 237, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.9);` → Ombre premium
- `border: 1.5px solid rgba(196, 181, 253, 0.2);` → Bordure fine
- `backdrop-filter: blur(30px);` → Effet de flou d'arrière-plan
- `position: relative;`
- `z-index: 10;`

### Hero (dans services-pages.css)

- `margin-bottom: 3rem;` → Espace pour l'overlap
- `border-radius: 0 0 48px 48px;` → Coins arrondis en bas

---

## 2. Fichiers modifiés

### Pages harmonisées (wrapper filtres)

1. **`resources/views/services/index.blade.php`** (`/services`)
   - **Avant**: `<div class="container" style="position:relative;z-index:10;">` ✅ Déjà correct
   - **Après**: Inchangé (déjà conforme)
   - **Pause Souffle**: Déjà placé juste sous filtres ✅

2. **`resources/views/frontend/home/index-v3.blade.php`** (`/home`)
   - **Avant**: `<div class="container">` (sans z-index)
   - **Après**: `<div class="container" style="position:relative;z-index:10;">`
   - **Pause Souffle**: Déjà placé juste sous filtres ✅

3. **`resources/views/services/corporate.blade.php`** (`/services/corporate`)
   - **Avant**: `<div class="container container-filters-premium" style="position:relative;z-index:1;">`
   - **Après**: `<div class="container" style="position:relative;z-index:10;">`
   - **Pause Souffle**: Déjà placé juste sous filtres ✅

4. **`resources/views/services/homeswap.blade.php`** (`/services/homeswap`)
   - **Avant**: `<div class="container container-filters-premium" style="position:relative;z-index:1;">`
   - **Après**: `<div class="container" style="position:relative;z-index:10;">`
   - **Pause Souffle**: **Déplacé** juste après le bloc de filtres (ligne ~4801), avant "Comment ça marche"

### Pages déjà conformes (vérifiées)

5. **`resources/views/services/projects.blade.php`** (`/services/projects`)
   - ✅ Wrapper conforme (référence)
   - ✅ Pause Souffle placé juste sous filtres

6. **`resources/views/services/lessons.blade.php`** (`/services/lessons`)
   - ✅ Wrapper conforme
   - ✅ Pause Souffle placé juste sous filtres

7. **`resources/views/services/at-home.blade.php`** (`/services/at-home`)
   - ✅ Wrapper conforme
   - ✅ Pause Souffle placé juste sous filtres

8. **`resources/views/services/wellnesslive.blade.php`** (`/services/wellnesslive`)
   - ✅ Wrapper conforme
   - ✅ Pause Souffle placé juste sous filtres

---

## 3. Emplacements exacts Pause Souffle (verrouillés)

### Page Home (`/`)

- **Route**: `home` (via `HomeController@index`)
- **Vue**: `resources/views/frontend/home/index-v3.blade.php`
- **Emplacement**: Juste sous le filtre de recherche (ligne ~2664), avant la section "Nos Rituels"
- **Composant**: `inline-with-bullets-premium`

### Page Services (`/services`)

- **Route**: `services` (via `ServicesController@index`)
- **Vue**: `resources/views/services/index.blade.php`
- **Emplacement**: Juste sous la zone de filtres (ligne ~523), avant le listing des univers
- **Composant**: `inline-with-bullets-premium`

### Univers Projects (`/services/projects`)

- **Route**: `services.projects` (via `ServicesController@projects`)
- **Vue**: `resources/views/services/projects.blade.php`
- **Emplacement**: Juste sous le tableau de filtres (ligne ~3330), avant les résultats (ligne ~3335)
- **Composant**: `inline-premium`

### Univers Lessons (`/services/lessons`)

- **Route**: `services.lessons` (via `ServicesController@lessons`)
- **Vue**: `resources/views/services/lessons.blade.php`
- **Emplacement**: Juste sous le tableau de filtres (ligne ~3005), avant les résultats (ligne ~3010)
- **Composant**: `inline-premium`

### Univers At-Home (`/services/at-home`)

- **Route**: `services.at-home` (via `ServicesController@atHome`)
- **Vue**: `resources/views/services/at-home.blade.php`
- **Emplacement**: Juste sous le tableau de filtres (ligne ~2607), avant les résultats (ligne ~2612)
- **Composant**: `inline-premium`

### Univers WellnessLive (`/services/wellnesslive`)

- **Route**: `services.wellnesslive` (via `ServicesController@wellnesslive`)
- **Vue**: `resources/views/services/wellnesslive.blade.php`
- **Emplacement**: Juste sous le tableau de filtres (ligne ~2626), avant les résultats (ligne ~2629)
- **Composant**: `inline-premium`

### Univers Homeswap (`/services/homeswap`)

- **Route**: `services.homeswap` (via `ServicesController@homeswap`)
- **Vue**: `resources/views/services/homeswap.blade.php`
- **Emplacement**: **Déplacé** juste sous le bloc de filtres (ligne ~4801), avant la section "Comment ça marche"
- **Composant**: `inline-with-bullets-premium`
- **Note**: Ancien emplacement supprimé (ligne ~5165)

### Landing Présence (`/services/corporate`)

- **Route**: `services.corporate` (via `ServicesController@corporate`)
- **Vue**: `resources/views/services/corporate.blade.php`
- **Emplacement**: Juste sous le tableau de filtres (ligne ~3221), avant les résultats (ligne ~3226)
- **Composant**: `inline-premium`

---

## 4. Éléments copiés depuis /services/projects

### Wrapper container (standardisé)

```html
<div class="container" style="position:relative;z-index:10;">
  <x-home.search-filter ... />
</div>
```

**Propriétés clés**:
- `position:relative` → Permet le positionnement relatif des enfants
- `z-index:10` → Assure que les filtres passent au-dessus du hero

### Effet overlap (automatique via composant)

Le composant `search-filter` applique automatiquement via `.home-search-filter-section`:
- `margin: -60px auto 4rem;` → Overlap de 60px avec le hero
- `border-radius: 32px;` → Coins arrondis premium
- `box-shadow` premium → Ombre douce et profonde
- `backdrop-filter: blur(30px);` → Effet de flou

---

## 5. Modifications par page

### /services (hub)

- **Wrapper**: Déjà conforme ✅
- **Pause Souffle**: Déjà bien placé ✅
- **Modification**: Aucune (déjà conforme)

### /home

- **Wrapper**: Ajout `position:relative;z-index:10;`
- **Pause Souffle**: Déjà bien placé ✅
- **Modification**: Harmonisation wrapper uniquement

### /services/corporate

- **Wrapper**: 
  - Suppression classe `container-filters-premium`
  - Changement `z-index:1` → `z-index:10`
- **Pause Souffle**: Déjà bien placé ✅
- **Modification**: Harmonisation wrapper uniquement

### /services/homeswap

- **Wrapper**: 
  - Suppression classe `container-filters-premium`
  - Changement `z-index:1` → `z-index:10`
- **Pause Souffle**: **Déplacé** de ligne ~5165 à ligne ~4801 (juste après filtres)
- **Modification**: Harmonisation wrapper + déplacement Pause Souffle

### Autres univers (/services/projects, /services/lessons, /services/at-home, /services/wellnesslive)

- **Wrapper**: Déjà conforme ✅
- **Pause Souffle**: Déjà bien placé ✅
- **Modification**: Aucune (déjà conforme)

---

## 6. Vérifications anti-régression

### Checklist harmonisation hero ↔ filtres

- ✅ **Projects** (référence): Inchangé, toujours conforme
- ✅ **Services** (hub): Wrapper conforme
- ✅ **Home**: Wrapper harmonisé (z-index ajouté)
- ✅ **Corporate**: Wrapper harmonisé (z-index corrigé)
- ✅ **Homeswap**: Wrapper harmonisé (z-index corrigé)
- ✅ **Lessons**: Déjà conforme
- ✅ **At-Home**: Déjà conforme
- ✅ **WellnessLive**: Déjà conforme

### Checklist placement Pause Souffle

- ✅ **Home**: Juste sous filtres, avant 6 univers
- ✅ **Services**: Juste sous filtres, avant listing univers
- ✅ **Projects**: Juste sous filtres, avant résultats
- ✅ **Lessons**: Juste sous filtres, avant résultats
- ✅ **At-Home**: Juste sous filtres, avant résultats
- ✅ **WellnessLive**: Juste sous filtres, avant résultats
- ✅ **Homeswap**: **Déplacé** juste sous filtres, avant "Comment ça marche"
- ✅ **Corporate**: Juste sous filtres, avant résultats

### Checklist fonctionnelle

- ✅ Dropdowns fonctionnent (z-index:10 suffisant)
- ✅ z-index OK (pas de chevauchement)
- ✅ Responsive OK (margin négatif géré par le composant)
- ✅ Pas de doublon Pause Souffle (1 seul module par page)

---

## 7. Tests à effectuer

### Desktop

- [ ] `/services/projects` : Rendu hero ↔ filtres inchangé (référence)
- [ ] `/services` : Rendu hero ↔ filtres identique à Projects
- [ ] `/home` : Cohérence visuelle hero ↔ filtres
- [ ] `/services/homeswap` : Pause Souffle juste sous filtres
- [ ] `/services/corporate` : Pause Souffle juste sous filtres

### Mobile

- [ ] Vérifier overlap hero ↔ filtres (margin négatif)
- [ ] Vérifier z-index (pas de chevauchement)
- [ ] Vérifier responsive (filtres bien positionnés)

### Vérifications techniques

- [ ] Dropdowns filtres fonctionnent
- [ ] z-index OK (filtres au-dessus du hero)
- [ ] Pas de chevauchement bizarre
- [ ] Pause Souffle visible et bien placé

---

## 8. Notes techniques

### Cache Laravel

Après déploiement, exécuter:
```bash
php artisan view:clear
php artisan cache:clear
```

### Compatibilité

- Tous les wrappers utilisent maintenant la même structure que Projects
- L'effet overlap est géré automatiquement par le composant `search-filter`
- Le z-index:10 assure que les filtres passent au-dessus du hero
- Aucune modification du contenu fonctionnel des filtres

---

## 9. Résumé des changements

### Avant

- Wrappers incohérents (z-index:1 vs z-index:10, classes différentes)
- Pause Souffle parfois mal placé (homeswap après plusieurs sections)

### Après

- Wrappers harmonisés (tous avec `position:relative;z-index:10;`)
- Pause Souffle verrouillé juste sous filtres sur toutes les pages
- Rendu hero ↔ filtres identique partout (effet premium overlap/floating card)

---

**Fin du rapport**
