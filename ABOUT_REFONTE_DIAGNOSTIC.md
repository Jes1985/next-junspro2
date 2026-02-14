# DIAGNOSTIC /about — JUNSPRO

## ÉTAPE A — CIBLAGE DE LA PAGE /about

### 1) Route exacte
- **Fichier** : `routes/web.php` ligne 280
- **Route** : `GET /about`
- **Controller** : `App\Http\Controllers\FrontEnd\AboutUsController@index`
- **Nom** : `aboutus`

### 2) Vue Blade rendue
- **Nom** : `frontend.aboutus`
- **Chemin** : `resources/views/frontend/aboutus.blade.php`

### 3) Partials inclus
- **Aucun** — tout le contenu est dans la vue principale
- Extends : `frontend.layout`

### 4) Chaînes template (origine)
| Chaîne | Emplacement | Statut |
|--------|-------------|--------|
| "À propos de nous" | `resources/lang/fr.json` (clé About Us) | Non affichée sur /about (meta) |
| "Amenez votre vie..." / "Fiverr" | `public/installer/database.sql` (about_sections) | Données DB — la vue /about ne les utilise plus |
| "Lorem Ipsum" | `public/installer/database.sql` (testimonials) | Données DB — section testimonials supprimée de la vue |
| "Harry Potter" / "Jane Doe" | Potentiellement dans testimonials DB | Section testimonials supprimée |

---

## ÉTAPE B — REFONTE APPLIQUÉE

La vue `resources/views/frontend/aboutus.blade.php` contient :

- ✅ **HERO** : "Moins de pression. Plus de progrès."
- ✅ Cartes Rituel (50 min / 10 min / Rapport)
- ✅ Bloc vidéo conservé + pastilles Alpine (Côté client, Freelance, Pourquoi ça marche)
- ✅ Tabs (Ajouter / Pause / Transférer)
- ✅ Bloc photo laptop conservé
- ✅ Mythes vs Réalité (accordéon)
- ✅ 6 univers (cartes premium)
- ✅ Slider partenaires conservé + upgrade CSS
- ✅ CTA final + "Paiement sécurisé par Stripe"
- ✅ Couleurs : gradient #A78BFA → #6D28D9 → #1D4ED8
- ✅ Aucun Lorem Ipsum / faux noms / Fiverr dans la vue

---

## ÉTAPE C — SLIDER PARTENAIRES (UPGRADE)

CSS scoped dans la vue :
- Logos gris (filter: grayscale(100%), opacity: 0.6)
- Hover : opacité 100%, scale(1.02), couleur complète
- Pagination chic (gradient bullets)

---

## ÉTAPE D — CACHE / DÉPLOIEMENT

### POURQUOI LES MODIFS NE SONT PAS VISIBLES SUR junspro.com ?
**Cause** : Les changements sont dans votre copie locale. Le site https://junspro.com est servi par un serveur de production qui n'a pas encore reçu ces fichiers.

### 1) Vérifier localement (après cache clear)
```bash
cd junspro-main3
php artisan optimize:clear
php artisan view:clear
php artisan serve
# Ouvrir http://127.0.0.1:8000/about — le H1 "Moins de pression. Plus de progrès." doit apparaître
```

### 2) Déployer sur PRODUCTION (junspro.com)
**Option A — Git push + déploiement automatique**
```bash
cd junspro-main3
git add resources/views/frontend/aboutus.blade.php
git commit -m "Refonte /about Junspro 50/50 — Moins de pression. Plus de progrès."
git push origin main
# Puis lancer votre script de déploiement (ex: ./deploy.sh)
```

**Option B — Transfert manuel du fichier**
1. Copier `resources/views/frontend/aboutus.blade.php` sur le serveur
2. Le placer dans le même chemin relatif du projet Laravel

### 3) SUR LE SERVEUR (après déploiement) — OBLIGATOIRE
```bash
cd /chemin/vers/votre/projet
php artisan optimize:clear
php artisan view:clear
# Si OPcache : sudo systemctl restart php8.2-fpm  (ou équivalent)
```

### 4) Preuve des changements (git diff)
```bash
git diff resources/views/frontend/aboutus.blade.php
# Résultat : +777 lignes, -227 lignes
```

### Fichier modifié (preuve)
- **Chemin** : `resources/views/frontend/aboutus.blade.php`
- **Ligne 648** : `<h1>Moins de pression. Plus de progrès.</h1>`
- **Stats** : 1 file changed, 777 insertions(+), 227 deletions(-)
