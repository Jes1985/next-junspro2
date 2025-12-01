# Formulaire Client - Gestion des Missions Junspro

## 📋 Vue d'ensemble

Ce système permet aux clients de soumettre des missions avec différentes options :
- **Accompagnement complet (99€)** : Gestion complète par l'équipe Junspro
- **Mise en relation simple (9,99€)** : Mise en relation sans suivi
- **Aucune option** : Mission gratuite

## 🎁 Bonus Bien-être Automatiques

Les bonus se déclenchent automatiquement selon le budget :
- ≥ 500 € → Bonus Vitalité
- ≥ 2 500 € → Bonus Sérénité  
- ≥ 5 000 € → Bonus Équilibre

## 🚀 Installation

### 1. Migration de la base de données

```bash
php artisan migrate
```

### 2. Configuration des services

Ajoutez dans votre fichier `.env` :

```env
# Stripe
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
STRIPE_WEBHOOK_SECRET=your_webhook_secret

# Calendly
CALENDLY_API_KEY=your_calendly_api_key
CALENDLY_EVENT_TYPE_URI=your_event_type_uri
CALENDLY_SCHEDULING_LINK=https://calendly.com/your-link
CALENDLY_DEFAULT_LINK=https://calendly.com/your-default-link

# Zoom
ZOOM_ACCOUNT_ID=your_zoom_account_id
ZOOM_CLIENT_ID=your_zoom_client_id
ZOOM_CLIENT_SECRET=your_zoom_client_secret
ZOOM_USER_ID=your_zoom_user_id
```

### 3. Configuration du Webhook Stripe

1. Allez dans votre dashboard Stripe
2. Créez un webhook pointant vers : `https://votre-domaine.com/mission/stripe/webhook`
3. Sélectionnez l'événement : `checkout.session.completed`
4. Copiez le secret du webhook dans `STRIPE_WEBHOOK_SECRET`

### 4. Configuration Calendly

1. Créez un compte Calendly
2. Générez une API key dans les paramètres
3. Configurez un webhook pour notifier votre application lors des réservations
4. Configurez l'URI de votre type d'événement

### 5. Configuration Zoom

1. Créez une application OAuth dans Zoom Marketplace
2. Configurez les permissions : `meeting:write`, `meeting:read`, `user:read`
3. Récupérez les credentials (Client ID, Client Secret, Account ID)

## 📍 Routes

### Frontend (Client)
- `GET /mission/soumettre` - Formulaire de soumission
- `POST /mission/soumettre` - Soumission du formulaire
- `GET /mission/succes/{id}` - Page de succès
- `GET /mission/stripe/success` - Succès paiement Stripe
- `GET /mission/stripe/cancel` - Annulation paiement

### Backend (Admin)
- `GET /admin/missions` - Liste des missions
- `GET /admin/missions/{id}` - Détails d'une mission
- `PUT /admin/missions/{id}/update-status` - Mettre à jour le statut

### Webhooks
- `POST /mission/stripe/webhook` - Webhook Stripe
- `POST /mission/calendly/callback` - Callback Calendly

## 🔄 Processus

### Cas 1 : Accompagnement complet (99€)
1. Client soumet le formulaire avec option "Accompagnement"
2. Redirection vers Stripe (paiement avec 20% de frais de protection)
3. Après paiement :
   - Enregistrement dans la BDD
   - Génération lien Calendly
   - Email avec lien Calendly
4. Quand RDV confirmé :
   - Création réunion Zoom
   - Email avec lien Zoom

### Cas 2 : Mise en relation simple (9,99€)
1. Client coche l'option + soumet
2. Redirection vers Stripe
3. Après paiement :
   - Enregistrement dans la BDD
   - Email de confirmation
   - Pas de Calendly/Zoom

### Cas 3 : Aucun accompagnement mais bonus
1. Client choisit "Aucune option" mais budget ≥ 500€
2. Pas de paiement
3. Génération automatique :
   - Lien Calendly pour bonus
   - Zoom après réservation
   - Email avec lien

## 💰 Frais de Protection

**20% de frais de protection Junspro** sont automatiquement ajoutés sur chaque paiement. Ces frais couvrent :
- L'assistance client
- La sécurité des transactions
- Les outils techniques
- La modération

## 📧 Emails Automatiques

Les emails suivants sont envoyés automatiquement :
- **AccompagnementConfirmation** : Après paiement accompagnement
- **MiseEnRelationConfirmation** : Après paiement mise en relation
- **BonusBienEtre** : Quand bonus déclenché
- **RdvConfirme** : Après confirmation RDV Calendly avec lien Zoom

## 🎨 Interface Admin

L'interface admin permet de :
- Voir toutes les missions avec filtres
- Voir les détails complets d'une mission
- Mettre à jour le statut
- Voir les liens Calendly et Zoom
- Consulter les informations de paiement

Un encart rappelle les **20% de frais de protection** sur chaque facture.

## ⚠️ Notes Importantes

1. **Zoom** : Les réunions gratuites sont limitées à 40 minutes automatiquement
2. **Stripe** : Configurez bien le webhook pour que les paiements soient traités automatiquement
3. **Calendly** : Configurez le webhook pour être notifié des réservations
4. **Sécurité** : Ne partagez jamais vos clés API en clair

## 🔧 Personnalisation

Pour personnaliser les messages ou les montants, modifiez :
- Les vues dans `resources/views/emails/`
- Les services dans `app/Services/`
- Les montants dans `ClientMissionController.php`

## 📞 Support

Pour toute question, consultez la documentation Laravel ou contactez l'équipe de développement.


