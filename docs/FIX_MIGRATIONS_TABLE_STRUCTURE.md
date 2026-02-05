# Correction table `migrations` — structure standard Laravel

## Mini If/Then (procédure obligatoire)

| Si vous avez… | Alors… |
|---------------|--------|
| **Erreur "Colonne 4"** (ou champ non standard dans `migrations`) | 1) Exécuter la migration de correction : `php artisan migrate --path=database/migrations/2026_01_26_110000_fix_migrations_table_structure_to_laravel_standard.php --force`<br>2) Puis : `php artisan migrate --force` |
| **"Table 'users' already exists"** (ou autre "table already exists" sur une migration de *création*) | L’historique de la table `migrations` est **désynchronisé** par rapport aux tables réelles (les tables existent mais Laravel ne les a pas enregistrées). Ne pas relancer toutes les migrations. Suivre la section [Si "table already exists" / historique désynchronisé](#si-table-already-exists--historique-désynchronisé) pour resynchroniser proprement (sans bricolage manuel). |

---

## Diagnostic

L’erreur **"Field 'Colonne 4' doesn't have a default value"** apparaît lors de l’insert dans `migrations` après une migration. La table `migrations` a donc une **4ᵉ colonne** (souvent nommée littéralement `Colonne 4`, ex. après export/import ou outil en français) **sans valeur par défaut** et non renseignée par Laravel.

Laravel n’écrit que `migration` et `batch` (plus `id` en auto-increment). Toute colonne supplémentaire sans défaut provoque l’erreur en mode strict MySQL.

**Structure attendue :** `id`, `migration`, `batch` uniquement.

---

## Pourquoi la migration lead_conversations n’est pas idempotente

La migration **2026_01_26_120000** (lead_conversations) est **normale** (sans `hasTable` / `hasColumn`) pour ne pas masquer un état DB incohérent. Si les tables existent déjà alors que la migration n’est pas enregistrée dans `migrations`, on doit **resynchroniser l’historique** (voir procédures ci‑dessous) plutôt que de faire passer la migration en silence. Ainsi, un échec "table already exists" signale clairement une désynchronisation à traiter.

---

## Solution appliquée (versionnée)

- **Migration de correction**  
  `database/migrations/2026_01_26_110000_fix_migrations_table_structure_to_laravel_standard.php`  
  Supprime toute colonne de `migrations` qui n’est pas `id`, `migration`, `batch` (MySQL/MariaDB, PostgreSQL ; noms avec espaces gérés).

- **Migration lead_conversations**  
  `database/migrations/2026_01_26_120000_create_lead_conversations_and_add_to_chat_messages.php`  
  Comportement standard : crée les tables/colonnes. Pas d’idempotence ; l’état est géré via la table `migrations`.

---

## Procédures par environnement

### If/Then rapide

| Situation | Action |
|-----------|--------|
| **Erreur "Colonne 4"** (ou champ non standard dans `migrations`) | Exécuter la migration de correction, puis `migrate` (voir [Colonne 4](#si-erreur-colonne-4)). |
| **"Table 'users' already exists"** (ou autre table déjà existante) sur une migration de création | L’historique `migrations` est **désynchronisé** par rapport aux tables réelles. Ne pas relancer bêtement toutes les migrations. Suivre [Resynchronisation](#si-table-already-exists--historique-désynchronisé). |

---

### a) PROD (base cohérente, migrations suivies)

- Déploiement normal : `php artisan migrate --force`.
- Si jamais l’erreur "Colonne 4" apparaît en prod : exécuter une seule fois la migration de correction avec `--path`, puis `php artisan migrate --force` (voir [Colonne 4](#si-erreur-colonne-4)).
- Ne jamais faire `migrate:fresh` ni `migrate:refresh` en prod.

---

### b) STAGING

- Même principe qu’en prod : `php artisan migrate --force`.
- Si la base est recréée depuis un dump ou un clone, vérifier que la table `migrations` a bien **uniquement** les colonnes `id`, `migration`, `batch`. Sinon, appliquer la migration de correction puis `migrate`.
- Si staging est "propre" (reset DB + migrations à jour), le test final `php artisan migrate --force` doit donner **exit 0** sans erreur.

---

### c) LOCAL (base parfois importée)

- **Base importée (dump, clone)** : la table `migrations` peut avoir une structure non standard ou un historique incomplet.
  - Si erreur "Colonne 4" → [Colonne 4](#si-erreur-colonne-4).
  - Si erreur "table already exists" sur une migration de création → [Resynchronisation](#si-table-already-exists--historique-désynchronisé).
- **Base locale créée par vous** : normalement structure standard. `php artisan migrate --force` suffit.

---

### Si erreur "Colonne 4"

1. Exécuter uniquement la migration de correction :
   ```bash
   php artisan migrate --path=database/migrations/2026_01_26_110000_fix_migrations_table_structure_to_laravel_standard.php --force
   ```
2. Puis lancer toutes les migrations en attente :
   ```bash
   php artisan migrate --force
   ```
3. Vérifier : la table `migrations` ne doit plus avoir que `id`, `migration`, `batch`.

---

### Si "table already exists" / historique désynchronisé

Cela signifie que des tables existent déjà alors que la table `migrations` n’a pas (ou plus) l’enregistrement des migrations correspondantes. Laravel repart donc du début et tente de recréer des tables.

**Options selon le contexte :**

1. **En LOCAL (perte de données acceptable)**  
   Remettre la base et l’historique au propre :
   ```bash
   php artisan migrate:fresh --force
   ```
   Puis éventuellement reseed. À n’utiliser qu’en dev/local.

2. **En LOCAL / STAGING (garder les données)**  
   - Consulter l’état : `php artisan migrate:status`.
   - Identifier les migrations "Ran" vs "Pending".
   - Si la base contient déjà toutes les tables jusqu’à une certaine date, il faut que `migrations` contienne **exactement** les noms de fichiers de ces migrations (avec un `batch` cohérent).  
   - Méthode propre : soit recréer la table `migrations` standard (3 colonnes) et réinsérer **à la main** les lignes correspondant aux migrations déjà appliquées (en s’aidant de la liste des fichiers dans `database/migrations` et de l’ordre des batches), soit restaurer un dump de la table `migrations` d’un environnement cohérent.  
   - Ne pas "insérer au hasard" : chaque ligne doit correspondre à une migration réellement exécutée sur cette base.

3. **En PROD**  
   Ne jamais faire de resync hasardeux. S’assurer que chaque déploiement exécute `php artisan migrate --force` après déploiement du code, pour que chaque migration soit enregistrée. Si une migration a été exécutée manuellement (ex. avec `--path`) et que l’insert dans `migrations` a échoué (ex. Colonne 4), corriger d’abord la structure de `migrations` (migration de correction), puis insérer **une seule ligne** dans `migrations` pour cette migration déjà appliquée :  
   `INSERT INTO migrations (migration, batch) VALUES ('2026_01_26_120000_create_lead_conversations_and_add_to_chat_messages', <batch_courant>);`  
   avec `batch_courant` = max(batch)+1. Ensuite `php artisan migrate --force` ne rejouera pas cette migration.

---

## Test final requis

Sur un environnement où la table `migrations` est **cohérente** (staging propre, ou DB locale après `migrate:fresh`, ou prod avec migrations suivies) :

```bash
php artisan migrate --force
```

**Résultat attendu :** exit 0, aucune erreur. Soit "Nothing to migrate.", soit exécution des migrations en attente puis exit 0.

**Note :** Si vous obtenez "Table 'users' already exists" (ou autre table déjà existante), l’environnement n’est pas cohérent : l’historique `migrations` est désynchronisé. Suivre [Si "table already exists" / historique désynchronisé](#si-table-already-exists--historique-désynchronisé) avant de considérer le test final comme réussi.

---

## Fichiers concernés

| Fichier | Rôle |
|---------|------|
| `database/migrations/2026_01_26_110000_fix_migrations_table_structure_to_laravel_standard.php` | Correction structure `migrations` |
| `database/migrations/2026_01_26_120000_create_lead_conversations_and_add_to_chat_messages.php` | Migration standard (non idempotente) |
| `docs/FIX_MIGRATIONS_TABLE_STRUCTURE.md` | Ce document |
