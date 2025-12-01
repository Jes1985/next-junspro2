# Ressources Laravel Nova - Junspro V2

## 📋 Résumé des Ressources Nova

Ce document liste toutes les ressources Nova disponibles pour gérer complètement le site Junspro via l'interface d'administration.

## ✅ Ressources Nova Existantes (9 ressources)

### Ressources Principales Junspro V2

1. **User** (`app/Nova/User.php`)
   - Gestion des utilisateurs du système

2. **ClientProfile** (`app/Nova/ClientProfile.php`)
   - Profils des clients
   - Gestion des informations clients

3. **FreelancerProfile** (`app/Nova/FreelancerProfile.php`)
   - Profils des freelancers
   - Gestion des freelancers et leurs compétences

4. **Subscription** (`app/Nova/Subscription.php`)
   - Abonnements clients-freelancers
   - Gestion des heures, prix, statuts

5. **WorkSession** (`app/Nova/WorkSession.php`)
   - Sessions de travail
   - Gestion des sessions planifiées

6. **PremiumService** (`app/Nova/PremiumService.php`)
   - Services premium
   - Services additionnels proposés

7. **Reward** (`app/Nova/Reward.php`)
   - Récompenses et bonus
   - Système de récompenses

8. **TransferRequest** (`app/Nova/TransferRequest.php`)
   - Demandes de transfert
   - Gestion des transferts de fonds

9. **WellnessPlan** (`app/Nova/WellnessPlan.php`)
   - Plans de bien-être
   - Plans santé et bien-être

## 💰 Ressources Paiement Créées (5 ressources)

### Ressources Gestion des Paiements

14. **Transaction** (`app/Nova/Transaction.php`) ⭐ NOUVEAU
    - **Description** : Gestion complète de toutes les transactions financières
    - **Champs principaux** :
      - ID Transaction et Commande
      - Type (dépôt, retrait, remboursement, achat, commission)
      - Utilisateur et vendeur
      - Statut de paiement
      - Méthode de paiement
      - Montants (total, taxe, soldes avant/après)
      - Type de passerelle
      - Devise
    - **Utilisation** :
      - Suivre toutes les transactions financières
      - Gérer les paiements et remboursements
      - Consulter l'historique des transactions
      - Surveiller les soldes utilisateurs

15. **PaymentInvoice** (`app/Nova/PaymentInvoice.php`) ⭐ NOUVEAU
    - **Description** : Gestion des factures de paiement
    - **Champs principaux** :
      - ID Facture et Commande
      - Client associé
      - Statut facture et transaction
      - Montant et devise
      - Passerelle de paiement utilisée
      - Détails transaction (ID, statut, paiement)
    - **Utilisation** :
      - Gérer les factures clients
      - Suivre les paiements par passerelle
      - Consulter les détails de facturation

16. **Withdraw** (`app/Nova/Withdraw.php`) ⭐ NOUVEAU
    - **Description** : Gestion des retraits d'argent des freelancers
    - **Champs principaux** :
      - ID Retrait et Vendeur
      - Méthode de retrait
      - Montant et montant payable
      - Frais de retrait
      - Référence additionnelle
      - Statut (en attente, approuvé, rejeté, complété)
    - **Utilisation** :
      - Gérer les demandes de retrait
      - Approuver ou rejeter les retraits
      - Suivre les paiements aux freelancers
      - Calculer les frais de retrait

17. **OnlineGateway** (`app/Nova/OnlineGateway.php`) ⭐ NOUVEAU
    - **Description** : Configuration des passerelles de paiement en ligne
    - **Champs principaux** :
      - Nom et mot-clé unique
      - Informations de configuration (clés API, paramètres)
      - Statut (actif/inactif)
    - **Utilisation** :
      - Configurer Stripe, PayPal, Mollie, etc.
      - Gérer les clés API
      - Activer/désactiver les passerelles
      - Paramétrer les options de paiement

18. **OfflineGateway** (`app/Nova/OfflineGateway.php`) ⭐ NOUVEAU
    - **Description** : Configuration des méthodes de paiement hors ligne
    - **Champs principaux** :
      - Nom et description
      - Instructions pour le client
      - Autorisation de pièce jointe
      - Numéro de série (ordre d'affichage)
      - Statut (actif/inactif)
    - **Utilisation** :
      - Configurer virement bancaire, chèque, etc.
      - Définir les instructions de paiement
      - Gérer les méthodes hors ligne

19. **WithdrawPaymentMethod** (`app/Nova/WithdrawPaymentMethod.php`) ⭐ NOUVEAU
    - **Description** : Configuration des méthodes de retrait disponibles
    - **Champs principaux** :
      - Nom de la méthode
      - Limites min/max
      - Frais fixes et en pourcentage
      - Statut (actif/inactif)
    - **Utilisation** :
      - Définir les méthodes de retrait (virement, PayPal, etc.)
      - Configurer les limites et frais
      - Gérer les options de retrait pour freelancers

## ✨ Ressources Fonctionnelles Créées (4 ressources)

### Ressources Fonctionnelles Ajoutées

10. **Mission** (`app/Nova/Mission.php`) ⭐ NOUVEAU
    - **Description** : Gestion complète des missions client-freelance
    - **Champs principaux** :
      - Informations client (nom, email, téléphone)
      - Description de la mission
      - Type d'offre (Mise en relation / Accompagnement)
      - Budget et bonus bien-être
      - Statut de la mission
      - Liens Calendly et Zoom
      - Fichiers joints
      - Dates de soumission et RDV
    - **Utilisation** : 
      - Créer et gérer les missions
      - Suivre le statut des missions
      - Gérer les rendez-vous et réunions
      - Suivre les paiements Stripe

11. **Meeting** (`app/Nova/Meeting.php`) ⭐ NOUVEAU
    - **Description** : Gestion des réunions vidéo (Zoom, Jitsi, Google Meet)
    - **Champs principaux** :
      - Session de travail associée
      - Fournisseur (Zoom, Jitsi, Google Meet)
      - URL de la réunion
      - Durée en minutes
    - **Utilisation** :
      - Gérer les liens de réunions vidéo
      - Suivre les sessions de travail avec réunions
      - Organiser les appels clients-freelancers

12. **CalendarSlot** (`app/Nova/CalendarSlot.php`) ⭐ NOUVEAU
    - **Description** : Gestion des créneaux horaires des freelancers
    - **Champs principaux** :
      - Freelancer associé
      - Jour de la semaine (0-6)
      - Heure (0-23)
      - Disponibilité (disponible/non disponible)
    - **Utilisation** :
      - Définir les disponibilités des freelancers
      - Gérer les créneaux horaires
      - Planifier les sessions de travail

13. **Rebooking** (`app/Nova/Rebooking.php`) ⭐ NOUVEAU
    - **Description** : Gestion des reprogrammations de sessions
    - **Champs principaux** :
      - Session de travail à reprogrammer
      - Ancienne date/heure
      - Nouvelle date/heure
      - Raison de la reprogrammation
      - Statut d'approbation (En attente/Approuvé/Refusé)
    - **Utilisation** :
      - Gérer les demandes de reprogrammation
      - Approuver ou refuser les changements
      - Suivre les modifications de planning

## 📊 Total des Ressources Nova

**18 ressources Nova** sont maintenant disponibles pour gérer complètement le site Junspro :

- ✅ 9 ressources existantes
- ✨ 4 ressources fonctionnelles créées
- 💰 5 ressources paiement créées

## 🎯 Fonctionnalités Complètes Gérées via Nova

Avec ces 18 ressources, vous pouvez maintenant gérer :

### Gestion Utilisateurs & Profils
1. ✅ **Utilisateurs** : Clients et administrateurs
2. ✅ **Profils** : Clients et Freelancers

### Gestion Missions & Sessions
3. ✅ **Missions** : Cycle de vie complet des missions
4. ✅ **Abonnements** : Abonnements clients-freelancers
5. ✅ **Sessions de travail** : Planning et exécution
6. ✅ **Réunions** : Gestion des appels vidéo
7. ✅ **Créneaux** : Disponibilités des freelancers
8. ✅ **Reprogrammations** : Gestion des changements

### Gestion Services & Récompenses
9. ✅ **Services** : Services premium
10. ✅ **Récompenses** : Système de bonus
11. ✅ **Transferts** : Demandes de transfert de fonds
12. ✅ **Plans bien-être** : Plans santé

### 💰 Gestion Paiements (NOUVEAU)
13. ✅ **Transactions** : Suivi de toutes les transactions financières
14. ✅ **Factures** : Gestion des factures de paiement
15. ✅ **Retraits** : Gestion des retraits freelancers
16. ✅ **Passerelles en ligne** : Configuration Stripe, PayPal, etc.
17. ✅ **Passerelles hors ligne** : Configuration virement, chèque, etc.
18. ✅ **Méthodes de retrait** : Configuration des options de retrait

## 🚀 Accès aux Ressources

Toutes les ressources sont accessibles via l'interface Laravel Nova :
- **URL** : `http://127.0.0.1:8000/nova` (local)
- **URL Production** : `https://votre-domaine.com/nova`

## 📝 Notes Importantes

1. **Permissions** : Assurez-vous que les utilisateurs ont les bonnes permissions pour accéder aux ressources
2. **Relations** : Les ressources sont liées entre elles (ex: Mission → Meeting → WorkSession)
3. **Validation** : Les champs requis sont validés automatiquement dans Nova
4. **Recherche** : Chaque ressource a des champs de recherche configurés

## 🔄 Prochaines Étapes

1. ✅ Toutes les ressources essentielles sont créées
2. 🔄 Optionnel : Créer des Actions Nova personnalisées (ex: Approuver reprogrammation)
3. 🔄 Optionnel : Créer des Filtres Nova pour faciliter la recherche
4. 🔄 Optionnel : Créer des Lenses Nova pour des vues spécialisées

---

**Date de création** : 24 novembre 2025
**Version** : Junspro V2 - Laravel 12 + Nova 5.2

