# Livrables — Top-up par palier + Upgrade doux (Rituel, cycles 4 semaines)

## Fichiers modifiés / créés (chemins exacts)

### Créés
- `app/Services/Junspro/CycleUsageService.php` — Service central (topupCap, cycleMaxTotal, shouldShowUpgradeNudge, nudgeLevel, hoursToRituals, ritualSignatureText, wouldExceedCycleMax).
- `database/migrations/2026_01_31_120000_add_universe_to_subscriptions_table.php` — Colonne `universe` sur `subscriptions`.
- `resources/views/components/ritual-signature.blade.php` — Composant Blade pour la micro-phrase signature.
- `LIVRABLES_RITUEL_TOPUP_UPGRADE.md` — Ce fichier.

### Modifiés
- `app/Http/Controllers/FrontEnd/UserController.php` — getTopupQuota / calculateTopupQuota / topupSubscription branchés sur CycleUsageService ; quota par palier (cycle 4 semaines) ; validation plafond cycle ; ritual_signature dans la réponse JSON ; nudges calculés et passés à la vue subscription.
- `app/Models/Subscription.php` — Ajout de `universe` dans `$fillable`.
- `resources/views/frontend/client/settings/subscription.blade.php` — Affichage en "Rituels" (= X h), micro-phrase signature, nudges discrets ; suppression du bouton doublon "Ajouter des rituels" (conservation de "Ajouter des Rituels supplémentaires") ; FAQ en Rituels.
- `resources/views/components/subscription/topup-modal.blade.php` — Quota et stepper en "Rituels", micro-phrase signature, message quota atteint = message premium cycle.
- `public/assets/js/subscriptions/topupModal.js` — ritualSignature dans le payload et depuis l’API ; affichage cohérent.
- `resources/views/services/lessons.blade.php` — Composant `<x-ritual-signature />` dans la section résultats ; libellé tarif "par Rituel (= 1h)".
- `resources/views/services/wellnesslive.blade.php` — `<x-ritual-signature />` ; "par Rituel (= 1h)".
- `resources/views/services/corporate.blade.php` — `<x-ritual-signature />` (prix "sur devis" conservé).
- `resources/views/services/projects.blade.php` — `<x-ritual-signature />` ; "par Rituel (= 1h)".
- `resources/views/services/at-home.blade.php` — `<x-ritual-signature />` ; "par Rituel (= 1h)".

---

## Règles produit implémentées

### A (Lessons / WellnessLive / Corporate)
- Paliers (heures par cycle 4 semaines) : 4, 8, 16, 24, 32.
- Top-up max par cycle = palier (100 %).
- Max total cycle = palier + topup_max (ex. 32 + 32 = 64 Rituels/cycle).

### B (Projects / At-home)
- Paliers : 4, 8, 16, 24, 32, 48, 56, 64, 72, 80, 88.
- Top-up max : palier si ≤ 32, sinon 32.
- Max total cycle = palier + topup_max (ex. 88 + 32 = 120 Rituels/cycle).

### Signature Junspro
- Micro-phrase partout où un volume est visible :  
  **« 1 Rituel = 50 min focus + 10 min restitution & rapport. »**
- UI : "Rituels" (et éventuellement "(= X heures)" en petit), jamais "heures" seul.

### Validation / blocage
- Toute tentative de top-up qui dépasserait le max total du cycle est refusée.
- Message renvoyé (422) : *« Ce cycle atteint la limite de votre formule. Pour continuer, sélectionnez la formule supérieure. »*

### Nudges (upgrade doux)
- 70 % : *« Pour rester fluide jusqu'à la fin du cycle, une formule supérieure peut mieux correspondre à votre rythme. »*
- 85 % : *« Vous approchez du plafond de votre cycle. Pour éviter toute limite, passez au palier supérieur. »*
- Après top-up : *« Vous avez activé une extension sur ce cycle. Si ce besoin se répète, une formule supérieure sera plus confortable. »*
- 2 cycles avec top-up ou > 85 % : même message 85 %, niveau "repeat".

---

## Scénarios de test

### A) Paliers A — top-up
- Formule 8 Rituels/semaine (32/cycle) : topup_max = 32. Top-up ≤ 32 accepté, > 32 refusé.
- Vérifier que `getTopupQuota` retourne `max` = 32 et `remaining` = min(32 - used, cycleMaxTotal - 32 - used).

### B) Paliers B — top-up
- Formule 88/cycle : topup_max = 32. Top-up ≤ 32 accepté, > 32 refusé.
- Formule 24/cycle : topup_max = 24. Top-up ≤ 24 accepté.

### C) Dépassement max total
- Utiliser un abonnement + top-ups déjà utilisés pour que (base + used + qty) > cycleMaxTotal.  
- POST topup avec qty qui ferait dépasser : réponse 422 avec le message exact *« Ce cycle atteint la limite de votre formule… »*.

### D) Nudges (70 % / 85 % / afterTopup / repeat)
- Données de test : `usageRatio` et `topupUsedThisCycle` (et éventuellement `consecutiveCyclesWithTopup`) pour déclencher chaque niveau.  
- Vérifier sur la page `/account/settings/subscription` que le helper texte correspondant s’affiche sous la carte abonnement quand `nudge_show` est true.

### E) Micro-phrase signature visible
- Pages à vérifier :  
  - http://127.0.0.1:8000/services/lessons  
  - http://127.0.0.1:8000/services/wellnesslive  
  - http://127.0.0.1:8000/services/corporate  
  - http://127.0.0.1:8000/services/projects  
  - http://127.0.0.1:8000/services/at-home  
- + page abonnement (paramètres) et modal top-up : la phrase *« 1 Rituel = 50 min focus + 10 min restitution & rapport. »* doit apparaître à proximité des volumes.

---

## Anti-doublon

- Ancienne logique top-up (quota fixe 12h / 28 jours) supprimée et remplacée par le service central (paliers, cycle 4 semaines).
- Bouton doublon *« Ajouter des rituels »* (sans action d’ouverture de modal) supprimé ; seul *« Ajouter des Rituels supplémentaires »* (ouvre le modal top-up) est conservé.
- Message quota atteint dans le modal remplacé par le message premium cycle (pas d’ancien texte conservé).

---

## Note optionnelle (universe sur abonnement)

- La colonne `subscriptions.universe` est en place. Pour alimenter automatiquement l’univers (lessons, wellnesslive, corporate, projects, at-home) à la création d’un abonnement, il suffit de passer `universe` depuis le flux de réservation (ex. référent de la page) dans `SubscriptionService::create`. En l’absence de `universe`, le service utilise `lessons` (type A) par défaut.
