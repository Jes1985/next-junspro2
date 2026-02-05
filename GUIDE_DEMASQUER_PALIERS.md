# Guide : Démasquer les paliers supérieurs — Engagement en Rituel

## 🎯 Situation actuelle

**Paliers visibles (soft launch)** :
- 0 – 1 000 € — Engagement exploratoire
- 1 000 – 2 500 € — Engagement ciblé
- 2 500 – 5 000 € — Engagement structuré
- 5 000 – 10 000 € — Engagement stratégique

**Paliers masqués (mais conservés)** :
- 10 000 – 20 000 € — Engagement de partenariat
- 20 000 – 60 000 € — Partenariat long terme
- 60 000 € et + — Partenariat stratégique étendu

## ✅ Pourquoi c'est simple à réactiver ?

### 1. **Le mapping JavaScript est déjà prêt**

Les paliers masqués sont **déjà présents** dans le mapping JavaScript (`services/projects.blade.php`, lignes 5157-5159) :

```javascript
// Paliers masqués (soft launch) - conservés pour réactivation future
'10000-20000': { min: 10000, max: 20000 },
'20000-60000': { min: 20000, max: 60000 },
'60000+': { min: 60000, max: 999999 },
```

✅ **Aucune modification JavaScript nécessaire** — le système de calcul fonctionne déjà pour ces paliers.

### 2. **Il suffit d'ajouter 3 lignes dans 2 fichiers**

Les paliers masqués ne sont pas dans les dropdowns HTML. Pour les réactiver, il suffit d'ajouter les options `<option>` dans les deux fichiers de dropdown.

## 📝 Étapes pour démasquer les paliers

### Étape 1 : Modifier `components/home/search-filter.blade.php`

**Fichier** : `junspro-main3/resources/views/components/home/search-filter.blade.php`  
**Ligne** : ~205 (après l'option "5 000 – 10 000 €")

**Ajouter** :
```blade
<option value="10000-20000" data-min="10000" data-max="20000" {{ request('price_range') == '10000-20000' ? 'selected' : '' }}>10 000 – 20 000 € — Engagement de partenariat</option>
<option value="20000-60000" data-min="20000" data-max="60000" {{ request('price_range') == '20000-60000' ? 'selected' : '' }}>20 000 – 60 000 € — Partenariat long terme</option>
<option value="60000+" data-min="60000" data-max="999999" {{ request('price_range') == '60000+' ? 'selected' : '' }}>60 000 € et + — Partenariat stratégique étendu</option>
```

### Étape 2 : Modifier `components/services/filters/universal-filter.blade.php`

**Fichier** : `junspro-main3/resources/views/components/services/filters/universal-filter.blade.php`  
**Ligne** : ~312 (après l'option "5 000 – 10 000 €")

**Ajouter** (dans la section `@if($universe === 'projects')`) :
```blade
<option value="10000-20000" data-min="10000" data-max="20000" {{ request('price_range') == '10000-20000' ? 'selected' : '' }}>10 000 – 20 000 € — Engagement de partenariat</option>
<option value="20000-60000" data-min="20000" data-max="60000" {{ request('price_range') == '20000-60000' ? 'selected' : '' }}>20 000 – 60 000 € — Partenariat long terme</option>
<option value="60000+" data-min="60000" data-max="999999" {{ request('price_range') == '60000+' ? 'selected' : '' }}>60 000 € et + — Partenariat stratégique étendu</option>
```

## ✅ Résultat attendu

Après ces modifications, le dropdown affichera **7 paliers** au total :

1. Tous les engagements
2. 0 – 1 000 € — Engagement exploratoire
3. 1 000 – 2 500 € — Engagement ciblé
4. 2 500 – 5 000 € — Engagement structuré
5. 5 000 – 10 000 € — Engagement stratégique
6. **10 000 – 20 000 € — Engagement de partenariat** ← Nouveau
7. **20 000 – 60 000 € — Partenariat long terme** ← Nouveau
8. **60 000 € et + — Partenariat stratégique étendu** ← Nouveau

## 🔍 Vérifications

- ✅ Le système d'estimation JavaScript fonctionnera automatiquement (mapping déjà présent)
- ✅ Les filtres fonctionneront (le backend ne filtre pas par `price_range` pour projects)
- ✅ Aucune autre modification nécessaire

## 🎯 Pourquoi cette approche est optimale ?

1. **Pas de refonte** : Le mapping JavaScript est déjà en place
2. **Modification minimale** : Seulement 3 lignes à ajouter dans 2 fichiers
3. **Rétrocompatibilité** : Les anciennes valeurs restent supportées
4. **Pas d'impact backend** : Le backend n'utilise pas `price_range` pour projects
5. **Réversible** : Pour remasquer, il suffit de retirer les 3 lignes

## 📋 Checklist de validation

- [ ] Les 3 nouveaux paliers apparaissent dans le dropdown
- [ ] L'estimation en rituels/heures fonctionne pour les nouveaux paliers
- [ ] Le filtre fonctionne correctement
- [ ] Aucune erreur JavaScript dans la console
- [ ] Les libellés sont corrects et cohérents
