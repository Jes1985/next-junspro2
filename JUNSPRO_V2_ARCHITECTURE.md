# Junspro V2 - Architecture et Documentation

## Vue d'ensemble

Junspro V2 est une marketplace premium basée sur Laravel 12 + Nova 5.2, fonctionnant comme Preply mais orientée projets numériques.

## Structure des domaines

```
domains/
  Users/          - Gestion des utilisateurs
  Freelancers/    - Profils freelances
  Clients/        - Profils clients
  Subscriptions/  - Abonnements heures/semaine
  WorkSessions/   - Sessions 50/10
  Calendar/       - Créneaux de disponibilité
  Rebooking/      - Reprogrammations
  Meetings/       - Visios (Jitsi/Zoom)
  Messaging/      - Messagerie
  Payments/       - Paiements Stripe
  Express/        - Livraison Express
  Transfers/      - Transferts d'abonnement
  Rewards/        - Récompenses clients
  Wellness/       - Plans bien-être
  PremiumServices/ - Services premium
  Admin/          - Nova Resources
```

## Modèles créés

### 1. User (modifié)
- Ajout du champ `role` (enum: client, freelance, admin)
- Relations: `freelancerProfile()`, `clientProfile()`

### 2. FreelancerProfile
- `hourly_rate` (3€ - 200€)
- `reliability_score` (0-100)
- `wellness_plan` (none, essentiel, premium)
- `skills`, `languages` (JSON)
- Relations: subscriptions, calendarSlots, rebookings

### 3. ClientProfile
- `company_name`
- `total_spent` (montants dépensés)
- Relations: subscriptions, transferRequests, rewards

### 4. Subscription
- `hours_per_week` (1, 2, 3, 4, 5, 8)
- `hours_total_month` (calculé: hours_per_week * 4)
- `hours_remaining`
- `delivery_mode` (standard, express_24h, express_48h, express_72h)
- `status` (pending, active, paused, cancelled)
- Calcul automatique du prix final avec Express

### 5. WorkSession
- Sessions 50/10 (50min travail + 10min rapport)
- `is_meeting` (visio cadrage/clôture)
- `delivery_speed` (Express)
- `deadline_at` (si Express)
- `report_text`, `report_files`
- `rebook_count` (max 1)

### 6. CalendarSlot
- Calendrier en heures pleines (00h-23h)
- `weekday` (0-6), `hour` (0-23)
- `is_available`

### 7. Rebooking
- Reprogrammation avec règles strictes
- `approved` (auto si règles respectées)

### 8. Meeting
- Visios Jitsi/Zoom
- Déduction des heures

### 9. TransferRequest
- Transfert d'abonnement vers autre freelance
- `status` (pending, approved, rejected)

### 10. Reward
- Récompenses clients (séances Pilates)
- Seuils: 501€, 1001€, 5001€

### 11. WellnessPlan
- Plans bien-être (essentiel, premium)

### 12. PremiumService
- Services premium (MatchDirect, Conciergerie, etc.)
- Polymorphique (client ou freelance)

## Services métier

### PlatformFeeService
- Calcul des commissions plateforme
- Barème progressif: 20% → 12% → 8% → 6%

### SubscriptionService
- Création d'abonnements
- Calcul prix base et Express
- Gestion cycles (pause, resume, cancel)
- Consommation d'heures

### ExpressService
- Calcul prix Express (+30%, +20%, +10%)
- Gestion deadlines
- Pénalités fiabilité

### RebookingService
- Vérification règles reprogrammation
- Algorithme de validation (24h, même semaine, 72h max)

### WorkSessionService
- Création sessions
- Complétion 50/10
- Vérification livraison hebdomadaire

### MatchDirectService
- Matching automatique (3 freelances)
- Critères: disponibilité, prix, compétences, langue, timezone, fiabilité

### RewardsService
- Attribution récompenses selon seuils
- Gestion statuts (pending, claimed, completed)

### TransferService
- Création demandes transfert
- Approbation/rejet
- Transfert heures

## Nova Resources

Toutes les Nova Resources sont créées dans `app/Nova/`:
- FreelancerProfile
- ClientProfile
- Subscription
- WorkSession
- TransferRequest
- Reward
- PremiumService
- WellnessPlan

## API Routes

Routes disponibles sous `/api/junspro/v2/`:

### Abonnements
- `GET /subscriptions` - Liste
- `POST /subscriptions` - Créer
- `GET /subscriptions/{id}` - Détails
- `POST /subscriptions/{id}/pause` - Mettre en pause
- `POST /subscriptions/{id}/resume` - Reprendre
- `POST /subscriptions/{id}/cancel` - Annuler

### Sessions
- `GET /work-sessions` - Liste
- `POST /work-sessions` - Créer
- `POST /work-sessions/{id}/complete` - Compléter
- `POST /work-sessions/{id}/rebook` - Reprogrammer

### MatchDirect
- `POST /matchdirect/find` - Trouver freelances

## Règles métier principales

### Abonnements
- Heures/semaine: 1, 2, 3, 4, 5, 8
- Prix base = hourly_rate * hours_per_week * 4
- Express: +30% (24h), +20% (48h), +10% (72h)

### Sessions 50/10
- 50 minutes travail + 10 minutes rapport
- Rapport obligatoire pour complétion
- 1h consommée par session

### Reprogrammation
- Max 1 reprogrammation par session
- Délai 24h avant session
- Même semaine calendaire
- Max 72h de décalage

### Livraison Express
- Deadline automatique (24/48/72h)
- Retard → pénalité fiabilité
- Droit transfert pour client

### Transferts
- Client peut demander transfert
- Admin approuve/rejette
- Heures transférées au nouveau freelance

### Récompenses
- 501€ → 1 séance Pilates
- 1001€ → 2 séances
- 5001€ → 4 séances

## Prochaines étapes

1. Installer Laravel Nova 5.2
2. Configurer Stripe Billing
3. Intégrer Jitsi/Zoom
4. Créer les vues frontend
5. Tests unitaires
6. Documentation API complète

## Notes importantes

- Toutes les règles métier sont strictement respectées
- Les services sont injectables (DI)
- Transactions DB pour opérations critiques
- Logging des actions importantes
- Validation via FormRequests

