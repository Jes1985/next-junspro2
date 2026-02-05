# Audit Anti-Désintermédiation — Junspro

**Date :** 26 janvier 2026  
**Objectif :** Lister précisément ce qui existe pour les garde-fous anti-désintermédiation (6 univers, En ligne / En présentiel).

---

## ÉTAPE 0 — AUDIT OBLIGATOIRE (EXISTANT)

### 1) Chat interne
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Chat interne** | ✅ **OUI** | `ChatMessage` (Model), `ClientMessagesController`, `resources/views/frontend/client/messages/index.blade.php` |
| **Contrainte** | ⚠️ Chat lié à **Subscription** | Le chat n'est accessible QUE si le client a une **subscription active** avec le freelance. Pas de chat "avant réservation". |
| **Envoi message** | ✅ `ClientMessagesController@sendMessage` | POST, validation `subscription_id` + `message` (max 5000 car.) |
| **Filtrage coordonnées** | ❌ **NON** | Aucun filtrage automatique des emails, téléphones, liens dans les messages. Le contenu est stocké brut dans `chat_messages.message`. |

---

### 2) Paiement Stripe
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Stripe intégré** | ✅ **OUI** | `StripeService`, `PaymentIntentController`, `JunsproStripeWebhookController` |
| **Pour quelles offres** | Abonnements Junspro V2 (Subscription) | PaymentIntent créé via `SubscriptionService::createConnectPaymentIntent` pour abonnements heures/semaine |
| **Webhooks** | ✅ `invoice.payment_succeeded`, `invoice.payment_failed`, `customer.subscription.deleted` | `JunsproStripeWebhookController` |
| **Ancien système** | Missions / Service Orders (Iyzico, PayPal, etc.) | `app/Http/Controllers/Payment/`, `app/Http/Controllers/FrontEnd/PaymentGateway/` — coexiste avec Junspro V2 |

---

### 3) Réservation / Calendrier / Créneaux
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Réservation** | ✅ **OUI** (partiel) | `SchedulerController` (projects, homeswap), `CalendarSlot`, `WorkSession` |
| **Calendrier** | ✅ `ProjectScheduler.js`, `HomeSwapScheduler.js` | Créneaux pour Projects et HomeSwap |
| **WorkSession** | ✅ Sessions 50/10 | `WorkSession` model, `WorkSessionController` (store, complete, rebook) |
| **En présentiel** | ⚠️ `delivery_mode` sur Subscription | Pas de contrainte explicite "réservation + paiement obligatoire" pour présentiel vs en ligne |

---

### 4) Acompte
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Acompte** | ❌ **NON** (Junspro V2) | Paiement full via Stripe Connect. Pas d’acompte % (ex. 20%) ou montant fixe configuré. |
| **Ancien système** | À vérifier | Missions / Service Orders — logique possible dans `OrderProcessController` |

---

### 5) Facture / Reçu
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Facture** | ✅ **OUI** | `Invoice` model, `resources/views/frontend/service/invoice.blade.php` (Service Order) |
| **Invoice Junspro** | ⚠️ Model existe | `app/Models/Invoice.php` (subscription_id, payment_intent_id, montants) — génération PDF à confirmer |
| **Reçu** | ✅ `seller/order/show-receipt.blade.php` | Ancien flux seller |

---

### 6) Annulation / Remboursement
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Annulation** | ✅ **OUI** (Subscription) | `SubscriptionController@cancel`, `SubscriptionService`, vues `cancel`, `cancel-confirm` |
| **Webhook** | ✅ `customer.subscription.deleted` | Arrêt Stripe + mise à jour statut |
| **Remboursement** | ⚠️ `StripeService::refund()` | Méthode présente, usage à confirmer (annulation partielle, litiges) |
| **Politique annulation** | ❌ **NON** | Pas de règles "annulation gratuite jusqu’à Xh" ou "acompte non remboursable" affichées au booking |

---

### 7) Historique
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Commandes / Orders** | ✅ `service-orders.blade.php` | Ancien flux Service Order |
| **Réservations / Séances** | ✅ Dashboard client | `ClientDashboardController`, abonnements, WorkSessions |
| **Messages** | ✅ `client/messages/index.blade.php` | Liste des conversations (liées aux subscriptions) |
| **Paiements** | ✅ `billing-history.blade.php` | Historique facturation client |

---

### 8) Profil — Téléphone / Email visibles quand ?
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Profil freelance (show-premium)** | ❌ **Aucun phone/email affiché** | Pas de champ phone/email sur la page publique freelance |
| **Profil client settings** | ✅ Email, phone_number | `client/settings/index.blade.php`, `email.blade.php` — visibles par l’utilisateur connecté (ses propres infos) |
| **Masquage avant booking** | ❌ **NON** | Aucune logique "débloqué après réservation" sur les profils |
| **User model** | `email_address`, `phone_number` | Colonnes DB (scope `email_address` pour compatibilité) |

---

### 9) Partage coordonnées dans le chat — Filtrage automatique
| Élément | Statut | Où / Comment |
|---------|--------|--------------|
| **Filtrage coordonnées** | ❌ **NON** | `ClientMessagesController@sendMessage` enregistre le message brut. Pas de regex/remplacement pour emails, numéros, URLs de contact. |

---

## CHECK-LIST "EXISTANT / À RENFORCER / À CRÉER"

| Fonctionnalité | Existant | À renforcer | À créer |
|----------------|----------|-------------|---------|
| Chat interne | ✅ (lié subscription) | Chat AVANT réservation + blocage coordonnées | |
| Paiement Stripe | ✅ (abonnements) | Acompte 20% / montant fixe pour présentiel | |
| Réservation | ✅ (Projects, HomeSwap) | Imposer paiement pour présentiel | |
| Acompte | ❌ | | ✅ Créer |
| Facture / Reçu | ✅ (partiel) | Génération PDF systématique post-paiement | |
| Annulation | ✅ | Politique claire au booking + Support litige | |
| Historique | ✅ | Centraliser (réservations, paiements, reçus, VOD) | |
| Profil phone/email | ❌ masquage | | ✅ Masquer + label "Débloqué après réservation" |
| Filtrage chat | ❌ | | ✅ Bloquer/masquer coordonnées avant booking |
| Rebook 1 clic | ⚠️ Rebooking existe | | Renforcer si besoin |
| Packs 5/10 séances | ❌ | | À créer si demandé |
| Abonnement mensuel | ✅ (Subscription) | Avantage -10% présentiel si applicable | |

---

## 6 UNIVERS + 2 MODES

**Univers :** projects, lessons, at-home, wellnesslive, corporate, homeswap  
**Modes :** En ligne / En présentiel (via `delivery_mode` ou `mode` selon univers)

- **Projects** : mode (online/onsite) dans filtres
- **Lessons** : mode (online/offline/onsite)
- **Corporate** : mode
- **At-home** : présentiel
- **WellnessLive** : VOD/LIVE
- **HomeSwap** : présentiel (logement)

---

## LIVRABLES RECOMMANDÉS (À IMPLÉMENTER)

1. **Masquage coordonnées avant booking** — Profil freelance/client : phone + email masqués, label "Débloqué après réservation confirmée".
2. **Chat avant réservation** — Ouvrir un canal "contact" ou "demande" sans subscription, mais avec blocage des coordonnées dans les messages.
3. **Filtrage coordonnées dans le chat** — Regex sur `message` avant sauvegarde : détecter emails, numéros (FR/international), URLs → remplacer par "Pour votre sécurité, les coordonnées sont disponibles après réservation confirmée."
4. **Déblocage après paiement** — Quand `Subscription` status = active ET paiement reçu → afficher phone/email sur profils et dans chat.
5. **Acompte présentiel** — Pour `delivery_mode` présentiel : imposer acompte (20% ou fixe) via Stripe avant confirmation réservation.
6. **Politique annulation** — Afficher au booking : "Annulation gratuite jusqu’à Xh avant / Sinon acompte non remboursable".
7. **Support litige** — Bouton "Signaler un problème" sur réservation, stockage statut + message admin.
8. **Facture/Reçu PDF** — Génération automatique post-paiement, lien téléchargeable dans Historique.
9. **Historique unifié** — Page "Historique" : réservations, paiements, reçus, (replays/VOD si applicable).
10. **Rebook 1 clic** — Depuis séance passée : même coach, même format.
11. **Bénéfices "sur Junspro"** — Ligne discrète : "Paiement sécurisé • Annulation simplifiée • Facture • Support".

---

**Fichiers clés identifiés :**
- `app/Models/ChatMessage.php`
- `app/Http/Controllers/FrontEnd/ClientMessagesController.php`
- `resources/views/frontend/client/messages/index.blade.php`
- `app/Services/StripeService.php`
- `app/Http/Controllers/Junspro/PaymentIntentController.php`
- `app/Http/Controllers/FrontEnd/JunsproStripeWebhookController.php`
- `app/Models/Subscription.php`, `WorkSession.php`, `Invoice.php`
- `resources/views/frontend/freelance/show-premium.blade.php`
- `app/Models/User.php` (email_address, phone_number)
