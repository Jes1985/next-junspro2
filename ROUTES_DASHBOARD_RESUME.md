# Routes du tableau de bord client - Résumé

## Routes simplifiées (utilisées dans la navigation)

Les onglets du dashboard utilisent maintenant des routes simplifiées avec le préfixe `/user` :

- **Accueil** : `user.dashboard` → `/user/dashboard`
  - Redirige vers `client.dashboard.index` si profil client

- **Messages** : `user.messages.index` → `/user/messages`
  - Affiche la page Messages

- **Projets & sessions** : `user.projects_sessions.index` → `/user/projects-sessions`
  - Affiche la page Projets & heures

- **Abonnements** : `user.subscriptions.index` → `/user/subscriptions`
  - Même page que Projets & sessions (alias)

- **Paramètres** : `user.settings.index` → `/user/settings`
  - Affiche la page d'édition de profil

## Routes techniques (conservées pour compatibilité)

Les routes avec le préfixe `/user/account/*` sont toujours disponibles :

- `client.dashboard.index` → `/user/account/dashboard`
- `client.messages.index` → `/user/account/messages`
- `client.subscriptions.index` → `/user/account/subscriptions`

## Détection de l'onglet actif

La navigation détecte automatiquement l'onglet actif en vérifiant :
- Les routes `user.*` (nouvelles routes simplifiées)
- Les routes `client.*` (anciennes routes techniques)

Cela permet une transition en douceur et la compatibilité avec les anciens liens.
