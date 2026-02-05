# Plan ÉTAPE 4 — Chat pré-booking (sans subscription)

**Objectif :** Permettre au client d’échanger avec un freelance **avant** toute réservation/abonnement, tout en gardant les garde-fous anti-désintermédiation (coordonnées masquées jusqu’à réservation confirmée).

**Contraintes :** V1 minimal, pas de redesign, livraison step-by-step.

---

## 1) Structure de données à créer

### Option retenue : table `lead_conversations` + clé sur `chat_messages`

| Entité | Rôle |
|--------|------|
| **LeadConversation** (table `lead_conversations`) | Représente un fil de discussion “pré-booking” entre un client et un freelance, sans subscription. |

**Table `lead_conversations` :**

| Colonne | Type | Contraintes |
|---------|------|-------------|
| `id` | bigint PK | |
| `client_id` | FK → client_profiles.id | |
| `freelancer_id` | FK → freelancer_profiles.id | |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

- **Contrainte unique :** `(client_id, freelancer_id)` — une seule conversation lead par paire client/freelance.
- Pas de `subscription_id` : par définition, la lead conversation n’est pas liée à un abonnement.

**Table `chat_messages` (évolution) :**

- Conserver `subscription_id` (nullable) comme aujourd’hui.
- **Ajouter :** `lead_conversation_id` (nullable, FK → lead_conversations.id, index).
- Règle métier : un message a **soit** `subscription_id` **soit** `lead_conversation_id` (jamais les deux en création ; les anciens messages lead gardent `lead_conversation_id` après création d’une subscription).

**Modèle Eloquent :** `App\Models\LeadConversation` avec relations `client`, `freelancer`, `messages` (hasMany ChatMessage).

---

## 2) Règles d’accès (client ↔ freelance)

| Rôle | Accès |
|------|--------|
| **Client** | Peut voir et envoyer des messages uniquement pour les `LeadConversation` où `client_id` = son ClientProfile, et pour les Subscription où il est le client (comportement actuel). |
| **Freelance** | Peut voir et envoyer des messages uniquement pour les `LeadConversation` où `freelancer_id` = son FreelancerProfile, et pour les Subscription où il est le freelance. |

**Création d’une lead conversation :**

- Créée à la **première action** “envoyer un message” (côté client ou freelance) pour une paire (client, freelance) qui n’a pas encore de subscription (ou pas encore de lead conversation).
- Pas de création automatique au simple clic “Contacter” si on ne veut pas de fils vides ; on peut décider de créer au premier message uniquement.

**Liste des conversations (côté client / côté freelance) :**

- **Client :** afficher (1) toutes les Subscription du client (comme aujourd’hui) + (2) toutes les LeadConversation du client, en excluant les paires pour lesquelles une Subscription existe déjà (pour ne pas dupliquer un même freelance).
- **Freelance :** afficher (1) toutes les Subscription du freelance + (2) toutes les LeadConversation du freelance, en excluant les paires qui ont déjà une Subscription.

Affichage : une seule liste unifiée “conversations” (lead + subscription), triée par date du dernier message, avec un indicateur discret “Pré-booking” vs “Projet actif” si besoin.

---

## 3) Moment où la conversation devient “Subscription chat”

| Événement | Action |
|-----------|--------|
| **Création d’une Subscription** pour la paire (client, freelance) | À partir de ce moment, **les nouveaux messages** utilisent `subscription_id` (et plus `lead_conversation_id`). Les **anciens messages** gardent `lead_conversation_id` ; ils restent affichés dans le même fil chronologique. |
| **Passage “réservation confirmée”** (ex. paiement reçu, `subscription.status = active`) | Pas de migration de données : les messages déjà stockés ne changent pas. En **affichage**, on considère le fil comme “sous subscription” dès qu’une Subscription existe pour cette paire ; le déblocage des coordonnées et la disparition de la bannière dépendent de `subscription.status === 'active'` comme aujourd’hui. |

**Règle de routage des nouveaux messages :**

- Lors de l’envoi d’un message, si une **Subscription** existe pour (client, freelance) → enregistrer avec `subscription_id`, `lead_conversation_id` = null.
- Sinon, si une **LeadConversation** existe → enregistrer avec `lead_conversation_id`, `subscription_id` = null.
- Sinon, créer la **LeadConversation** puis enregistrer le message avec `lead_conversation_id`.

Ainsi, la “transformation” en subscription chat est **implicite** : dès qu’une subscription existe, tous les nouveaux messages vont dans le canal subscription ; l’UI peut afficher un seul fil fusionné (messages lead + messages subscription) pour cette paire.

---

## 4) Maintien des garde-fous (coordonnées masquées)

| Contexte | Comportement |
|----------|--------------|
| **Message avec `lead_conversation_id` uniquement** (pas de subscription) | Toujours considérer comme “avant réservation” : **filtrer à l’envoi** (ContactGuardService) et **à l’affichage** (remplacement par “[coordonnées masquées]”), et afficher la **bannière + ligne bénéfices** (style info neutre). |
| **Message avec `subscription_id` et subscription.status ≠ active** | Comportement actuel : filtrage à l’envoi et à l’affichage, bannière + ligne bénéfices. |
| **Message avec `subscription_id` et subscription.status = active** | Pas de filtrage, pas de bannière (réservation confirmée). |

**Règle unique à appliquer partout :**  
“Coordonnées visibles” **uniquement** si le message appartient à une Subscription dont le statut est **active**. Sinon (message lead uniquement, ou subscription non active), appliquer le même masquage et la même bannière que pour l’ÉTAPE 1/3.

Aucun changement de logique dans `ContactGuardService` ; uniquement le contexte d’évaluation qui s’étend : en plus de “subscription non active”, on gère “pas de subscription (message lead)”.

---

## Récapitulatif livraison V1 minimale

1. **Migration :** création de `lead_conversations` + ajout de `lead_conversation_id` (nullable) sur `chat_messages`.
2. **Modèle :** `LeadConversation` + mise à jour de `ChatMessage` (relation optionnelle vers LeadConversation).
3. **Contrôleurs / services :**  
   - Création ou récupération d’une LeadConversation à l’envoi du premier message pré-booking.  
   - Liste des conversations client/freelance : fusion Subscription + LeadConversation (sans doublon paire).  
   - Envoi de message : routage subscription_id vs lead_conversation_id selon les règles ci-dessus.
4. **Vues / UI :** réutiliser l’écran de chat existant ; la liste des conversations inclut les leads ; à l’ouverture d’un fil “lead”, appliquer masquage + bannière (comme pour subscription non active).
5. **Points d’entrée :** depuis le profil freelance, un bouton “Envoyer un message” ouvre (ou crée) la lead conversation et redirige vers la messagerie sur ce fil.

Pas de redesign : mêmes écrans, même style de bannière et de ligne bénéfices ; seuls les données et les règles d’accès/affichage changent.

---

*Document à valider avant toute implémentation de l’ÉTAPE 4.*
