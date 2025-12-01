# Notes de Déploiement - Formulaire Client Missions

## ✅ Fichiers créés/modifiés

### Nouveaux fichiers créés :

#### Backend
- `app/Models/Mission.php` - Modèle pour les missions
- `app/Http/Controllers/FrontEnd/ClientMissionController.php` - Controller client
- `app/Http/Controllers/BackEnd/MissionAdminController.php` - Controller admin
- `app/Services/StripeService.php` - Service Stripe
- `app/Services/CalendlyService.php` - Service Calendly
- `app/Services/ZoomService.php` - Service Zoom
- `app/Mail/AccompagnementConfirmation.php` - Email accompagnement
- `app/Mail/MiseEnRelationConfirmation.php` - Email mise en relation
- `app/Mail/BonusBienEtre.php` - Email bonus bien-être
- `app/Mail/RdvConfirme.php` - Email confirmation RDV

#### Database
- `database/migrations/2025_11_04_164523_create_missions_table.php` - Migration pour la table missions

#### Views Frontend
- `resources/views/frontend/client/mission-form.blade.php` - Formulaire client
- `resources/views/frontend/client/mission-success.blade.php` - Page succès
- `resources/views/frontend/client/mission-cancel.blade.php` - Page annulation

#### Views Admin
- `resources/views/backend/missions/index.blade.php` - Liste missions
- `resources/views/backend/missions/show.blade.php` - Détails mission

#### Views Emails
- `resources/views/emails/accompagnement-confirmation.blade.php`
- `resources/views/emails/mise-en-relation-confirmation.blade.php`
- `resources/views/emails/bonus-bien-etre.blade.php`
- `resources/views/emails/rdv-confirme.blade.php`

#### Documentation
- `MISSIONS_README.md` - Documentation complète du système
- `INSTALLATION_GUIDE.md` - Guide d'installation PHP/Composer

### Fichiers modifiés :

- `routes/web.php` - Routes frontend ajoutées
- `routes/admin.php` - Routes admin ajoutées
- `config/services.php` - Configuration Stripe, Calendly, Zoom ajoutée
- `.env.example` - Variables d'environnement ajoutées

---

## 📋 Étapes de déploiement

### 1. Exécuter la migration

```bash
php artisan migrate
```

Cela créera la table `missions` dans la base de données.

### 2. Configurer les variables d'environnement

Dans le fichier `.env`, ajoutez :

```env
# Stripe Configuration
STRIPE_KEY=votre_clé_stripe_publique
STRIPE_SECRET=votre_clé_stripe_secrète
STRIPE_WEBHOOK_SECRET=votre_secret_webhook_stripe

# Calendly Configuration
CALENDLY_API_KEY=votre_clé_api_calendly
CALENDLY_EVENT_TYPE_URI=uri_de_votre_type_d_événement
CALENDLY_SCHEDULING_LINK=https://calendly.com/votre-lien
CALENDLY_DEFAULT_LINK=https://calendly.com/votre-lien-par-défaut

# Zoom Configuration
ZOOM_ACCOUNT_ID=votre_account_id_zoom
ZOOM_CLIENT_ID=votre_client_id_zoom
ZOOM_CLIENT_SECRET=votre_client_secret_zoom
ZOOM_USER_ID=votre_user_id_zoom
```

### 3. Configurer les webhooks

#### Stripe Webhook
1. Allez dans Stripe Dashboard → Webhooks
2. Créez un webhook pointant vers : `https://votre-domaine.com/mission/stripe/webhook`
3. Sélectionnez l'événement : `checkout.session.completed`
4. Copiez le secret dans `STRIPE_WEBHOOK_SECRET`

#### Calendly Webhook
1. Allez dans Calendly Settings → Webhooks
2. Créez un webhook pointant vers : `https://votre-domaine.com/mission/calendly/callback`
3. Sélectionnez les événements : `invitee.created` ou `scheduled_event.created`

### 4. Générer la clé d'application (si nécessaire)

```bash
php artisan key:generate
```

### 5. Vérifier les permissions

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

### 6. Installer les dépendances (si nécessaire)

```bash
composer install
npm install
npm run dev
```

---

## 🔗 Routes disponibles

### Frontend
- `GET /mission/soumettre` - Formulaire de soumission
- `POST /mission/soumettre` - Traitement du formulaire
- `GET /mission/succes/{id}` - Page de succès
- `GET /mission/stripe/success` - Succès paiement Stripe
- `GET /mission/stripe/cancel` - Annulation paiement

### Admin
- `GET /admin/missions` - Liste des missions
- `GET /admin/missions/{id}` - Détails d'une mission
- `PUT /admin/missions/{id}/update-status` - Mettre à jour le statut

### Webhooks
- `POST /mission/stripe/webhook` - Webhook Stripe
- `POST /mission/calendly/callback` - Callback Calendly

---

## ⚠️ Points importants

1. **Frais de protection** : 20% de frais Junspro sont automatiquement ajoutés sur chaque paiement Stripe
2. **Bonus automatiques** : Les bonus se déclenchent automatiquement selon le budget :
   - ≥ 500€ → Bonus Vitalité
   - ≥ 2 500€ → Bonus Sérénité
   - ≥ 5 000€ → Bonus Équilibre
3. **Zoom** : Les réunions gratuites sont limitées à 40 minutes automatiquement
4. **Emails** : Les emails sont envoyés automatiquement selon les différents cas d'usage

---

## 📚 Documentation complète

Voir `MISSIONS_README.md` pour la documentation détaillée du système.

---

## 🐛 Problèmes courants

### Migration échoue
- Vérifiez la connexion à la base de données dans `.env`
- Vérifiez que la base de données existe

### Erreur Stripe
- Vérifiez les clés API dans `.env`
- Vérifiez que le webhook est configuré correctement

### Erreur Calendly/Zoom
- Vérifiez les credentials dans `.env`
- Vérifiez que les APIs sont bien configurées


