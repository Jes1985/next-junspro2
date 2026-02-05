# V2 — Valeurs format et wording

## 1. Valeurs autorisées (strictes)

| Valeur DB | Contrainte |
|-----------|------------|
| `visio` | ENUM + validation |
| `presentiel` | ENUM + validation |
| `mixte` | ENUM + validation |

- **Migration** : `2026_01_26_150000_change_subscriptions_format_to_enum.php` — colonne `format` en `ENUM('visio', 'presentiel', 'mixte')`
- **Validation** : `SubscriptionService::createSubscription`, `FreelancerController::subscribe`

Aucune autre valeur n’est acceptée en base.

## 2. Wording UI / orthographe produit

| Valeur DB | Libellé affiché |
|-----------|-----------------|
| `visio` | En visio |
| `presentiel` | **En presentile** |
| `mixte` | En mixte (visio + présentiel) |

- **Modèle** : `Subscription::FORMAT_LABELS` et `$subscription->format_label`
- Orthographe produit voulue : « En presentile » (et non « En présentiel »)
