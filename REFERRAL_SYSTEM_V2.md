# Système de Parrainage Junspro V2 - Documentation

## Vue d'ensemble

Système de parrainage premium inspiré de Preply, adapté à l'écosystème Junspro (anti-procrastination, 50/10, rapports, transfert d'heures/abonnement, sécurité).

## Configuration V1

- `min_eligible_amount`: 100€ (montant minimum pour être éligible)
- `reward_amount`: 10€ (crédit Junspro pour le parrain)
- `benefit_label`: "10€ offerts sur les frais de site" (avantage filleul)
- `cooldown_hours`: 48h (délai avant attribution de la récompense)
- `monthly_cap`: 150€ (plafond mensuel par parrain)

## Structure des fichiers

### Backend

- **Migrations**:
  - `2025_12_31_000001_add_referral_code_to_users_table.php` - Ajoute `referral_code` et `referred_by_user_id` à `users`
  - `2025_12_31_000002_create_referrals_table.php` - Crée la table `referrals`

- **Modèles**:
  - `app/Models/Referral.php` - Modèle pour les parrainages
  - Relations ajoutées dans `User` et `ClientProfile`

- **Services**:
  - `app/Services/Junspro/ReferralService.php` - Logique métier du parrainage

- **Controllers**:
  - `app/Http/Controllers/FrontEnd/ReferralController.php` - Contrôleur pour les pages et API

### Frontend

- **Routes**:
  - `GET /parrainage` - Page principale (auth required)
  - `GET /conditions-parrainage` - Page conditions (publique)
  - `GET /r/{code}` - Tracking et redirection (publique)
  - `POST /api/referral/copy-link` - API copier lien
  - `POST /api/referral/send-invitations` - API envoyer invitations
  - `POST /api/referral/recommend-company` - API recommander entreprise

- **Vues**:
  - `resources/views/frontend/referral/index.blade.php` - Page principale
  - `resources/views/frontend/referral/conditions.blade.php` - Page conditions
  - `resources/views/components/referral/*` - Composants Blade

- **Styles**:
  - `public/assets/front/css/referral-premium.css` - CSS scoped premium

- **Scripts**:
  - `public/assets/js/referral/inviteModal.js` - Modal d'invitation Alpine.js
  - `public/assets/js/referral/companyRecommendModal.js` - Modal recommandation entreprise
  - `public/assets/js/referral/stickyBar.js` - Barre sticky

## Composants

### ReferralCTA (Réutilisable)

Composant avec 4 variantes:
- `card`: Dashboard, confirmation réservation
- `inline`: Checkout (discret)
- `compact`: Footer, petites zones
- `confirmation`: Page de confirmation réservation

### Sections de la page /parrainage

1. **Hero Split**: Bannière principale avec gradient Junspro
2. **Vos parrainages**: Card avec stats, tabs (En cours/Complété), liste
3. **Comment ça marche**: 3 cards explicatives
4. **Pourquoi Junspro est premium**: Section signature avec features
5. **FAQ**: Accordéon avec 6 questions
6. **Bandeau Entreprise**: Recommandation entreprise
7. **Sticky CTA**: Barre sticky en bas de page

## Intégrations

### Menu utilisateur
- Entrée "Parrainage" ajoutée dans `header-nav-v3.blade.php`

### Footer
- Liens "Parrainage" et "Conditions du parrainage" ajoutés dans `footer-v3.blade.php`

### Dashboard client
- CTA Parrainage intégré dans `client/dashboard/index.blade.php`

### Inscription
- Intégration dans `UserController@signupSubmit` et `signupVerify`
- Cookie `referral_code` lu et parrainage créé après vérification email
- Support inscription sociale (Google/Facebook)

## Fonctionnalités

### Pour le parrain
- Génération automatique d'un code unique (`referral_code`)
- Partage du lien `/r/{code}`
- Suivi des parrainages (pending/completed)
- Statistiques (en attente, obtenu)
- Crédit automatique après confirmation première prestation filleul

### Pour le filleul
- Avantage automatique sur première réservation éligible (>= 100€)
- Cookie de tracking lors du clic sur le lien
- Parrainage enregistré lors de l'inscription

### Anti-abus
- Un filleul = un seul parrain
- Pas d'auto-parrainage
- Plafond mensuel (150€/mois/parrain)
- Vérification première prestation (payée + non annulée)

## TODO / Améliorations futures

- [ ] Intégration avec système de wallet/credits pour créditer automatiquement
- [ ] Emails d'invitation automatiques
- [ ] Emails de notification (parrainage créé, récompense obtenue)
- [ ] Dashboard admin pour gérer les parrainages
- [ ] Analytics et reporting
- [ ] Intégration dans le checkout pour appliquer l'avantage filleul
- [ ] Hook après confirmation de prestation pour créditer le parrain

## Notes techniques

- Tous les styles sont préfixés avec `.referral-` pour éviter les conflits
- Alpine.js utilisé pour les modales (focus trap, ESC close, scroll lock)
- Responsive design (mobile/tablette/desktop)
- Accessibilité: aria-labels, focus trap, contrastes OK
- Performance: lazy loading si nécessaire, CSS/JS optimisés

## Tests recommandés

1. Créer un utilisateur avec un code de parrainage valide
2. Vérifier que le parrainage est créé après vérification email
3. Tester l'application de l'avantage filleul au checkout
4. Tester le crédit du parrain après confirmation prestation
5. Vérifier le plafond mensuel
6. Tester l'anti-abus (auto-parrainage, multi-parrain)

