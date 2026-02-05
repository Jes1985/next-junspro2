# V2 — Environnements base de données

## Conventions obligatoires

### 1. Bases de données

| Base | Usage | migrate:fresh | Usage V2 |
|------|-------|---------------|----------|
| **junspro_test** | Tests migrations, validation exit 0 | ✅ Acceptable | **Environnement de test** pour toutes les migrations V2 |
| **Base locale principale** | Données importantes (comptes, messages, réservations) | ❌ **JAMAIS** | Ne pas perdre les données |
| **Production** | Base prod réelle | ❌ **JAMAIS** | Déploiement code + migrations (avec backup) |

### 2. Tester les migrations V2

**Commande pour exécuter les migrations sur junspro_test :**

```powershell
php artisan migrate --database=test_migrations --force
```

**Vérifier la base utilisée :**

- `.env` : `DB_DATABASE` = base par défaut
- Pour junspro_test : `DB_DATABASE_TEST=junspro_test` (connexion `test_migrations` dans `config/database.php`)

### 3. Ne jamais exécuter migrate:fresh sur la base principale

- Toutes les étapes V2 précisent : **base de test = junspro_test**
- Aucune étape V2 ne nécessite `migrate:fresh` sur la base principale
- Pour valider une migration : utiliser `--database=test_migrations`

### 4. Production

- **junspro_test n’est PAS destinée à la production**
- En production : déployer le code, puis exécuter `php artisan migrate --force` sur la base prod (après backup)
- Pas d’export/import de junspro_test vers prod

### 5. Résumé

| Action | Base |
|--------|------|
| Tester migration V2 | junspro_test (`--database=test_migrations`) |
| Développement local avec données | Base principale (ne pas migrate:fresh) |
| Production | Base prod (migrate après backup) |
