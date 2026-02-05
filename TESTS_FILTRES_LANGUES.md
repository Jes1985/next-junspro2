# Tests - Filtres Langues (Le freelance parle)

## Prérequis

Exécuter la migration pour créer la table `freelancer_languages` :
```bash
php artisan migrate
```

## Tests à effectuer

### 1. Test Logique OR (TÂCHE 1)

**Objectif** : Vérifier que la sélection de plusieurs langues retourne les freelances qui parlent AU MOINS UNE des langues sélectionnées.

**URL de test** :
```
http://localhost:8000/services/projects?teacher_speaks[]=fr&teacher_speaks[]=ar&teacher_speaks[]=es
```

**Résultat attendu** : Tous les freelances qui parlent Français OU Arabe OU Espagnol doivent apparaître.

**Requête SQL équivalente** :
```sql
SELECT DISTINCT freelancer_profiles.*
FROM freelancer_profiles
WHERE EXISTS (
    SELECT 1 FROM freelancer_languages
    WHERE freelancer_languages.freelancer_id = freelancer_profiles.id
    AND freelancer_languages.language_code IN ('fr', 'ar', 'es')
)
```

### 2. Test Toggle "Freelances natifs uniquement" (TÂCHE 1)

**Objectif** : Vérifier que le toggle filtre uniquement les freelances natifs pour les langues sélectionnées.

**URL de test** :
```
http://localhost:8000/services/projects?teacher_speaks[]=fr&teacher_speaks[]=en&native_only=1
```

**Résultat attendu** : Seuls les freelances qui ont le niveau "native" pour au moins une des langues sélectionnées (fr ou en) doivent apparaître.

**Requête SQL équivalente** :
```sql
SELECT DISTINCT freelancer_profiles.*
FROM freelancer_profiles
WHERE EXISTS (
    SELECT 1 FROM freelancer_languages
    WHERE freelancer_languages.freelancer_id = freelancer_profiles.id
    AND freelancer_languages.language_code IN ('fr', 'en')
    AND freelancer_languages.level = 'native'
)
```

### 3. Test Tri par niveau (TÂCHE 3)

**Objectif** : Vérifier que les freelances sont triés par leur meilleur niveau dans les langues sélectionnées.

**URL de test** :
```
http://localhost:8000/services/projects?teacher_speaks[]=fr&teacher_speaks[]=en
```

**Résultat attendu** : 
- Les freelances avec niveau "native" en premier
- Puis "c2", "c1", "b2", "b1", "a2", "a1" dans l'ordre décroissant
- Pour chaque niveau, tri par `reliability_score` DESC, puis `hourly_rate` ASC

**Requête SQL équivalente** :
```sql
SELECT freelancer_profiles.*,
       COALESCE(lang_levels.best_level, 0) as best_level
FROM freelancer_profiles
LEFT JOIN (
    SELECT freelancer_id,
           MAX(CASE 
               WHEN level = 'native' THEN 7
               WHEN level = 'c2' THEN 6
               WHEN level = 'c1' THEN 5
               WHEN level = 'b2' THEN 4
               WHEN level = 'b1' THEN 3
               WHEN level = 'a2' THEN 2
               WHEN level = 'a1' THEN 1
               ELSE 0
           END) as best_level
    FROM freelancer_languages
    WHERE language_code IN ('fr', 'en')
    GROUP BY freelancer_id
) as lang_levels ON freelancer_profiles.id = lang_levels.freelancer_id
WHERE EXISTS (
    SELECT 1 FROM freelancer_languages
    WHERE freelancer_languages.freelancer_id = freelancer_profiles.id
    AND freelancer_languages.language_code IN ('fr', 'en')
)
ORDER BY best_level DESC, reliability_score DESC, hourly_rate ASC
```

### 4. Test Affichage Langues + Niveaux (TÂCHE 2)

**Objectif** : Vérifier que les cartes freelances affichent correctement les langues avec leurs niveaux.

**Format attendu** :
- 1 langue : "Français (Natif)"
- 2 langues : "Français (Natif), Anglais (B2)"
- 3+ langues : "Français (Natif), Anglais (B2) +2"

**Vérification** : Ouvrir la page et vérifier que chaque carte freelance affiche les langues au format attendu.

## Données de test recommandées

Pour tester efficacement, créer quelques freelances avec différentes combinaisons de langues :

```sql
-- Exemple : Freelance 1 - Natif français, B2 anglais
INSERT INTO freelancer_languages (freelancer_id, language_code, level, created_at, updated_at)
VALUES (1, 'fr', 'native', NOW(), NOW()),
       (1, 'en', 'b2', NOW(), NOW());

-- Exemple : Freelance 2 - C1 français, Natif anglais
INSERT INTO freelancer_languages (freelancer_id, language_code, level, created_at, updated_at)
VALUES (2, 'fr', 'c1', NOW(), NOW()),
       (2, 'en', 'native', NOW(), NOW());

-- Exemple : Freelance 3 - B1 français seulement
INSERT INTO freelancer_languages (freelancer_id, language_code, level, created_at, updated_at)
VALUES (3, 'fr', 'b1', NOW(), NOW());
```

## Notes importantes

- Si la table `freelancer_languages` n'existe pas encore, le code gère l'erreur gracieusement et utilise le tri par défaut
- Le fallback vers l'ancien format JSON (`languages` en JSON) est géré dans la vue si la relation n'existe pas
- Les constantes de niveau sont définies dans `FreelancerLanguage::getLevelRank()` et `FreelancerLanguage::getLevelLabel()`
