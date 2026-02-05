# Système d'Estimation "À l'Heure" - Documentation

## 🎯 Objectif

Ajouter un système d'estimation "à l'heure" en parallèle du système actuel (rituels), utilisant la **même technique de calcul dynamique** basée sur les tarifs horaires réels des freelances visibles.

## ✅ Pourquoi c'est plus précis et contextuel ?

### 1. **Tarif horaire dynamique et contextuel**
- ❌ **Ancien système** : Utilise un tarif fixe ou moyen global
- ✅ **Nouveau système** : Calcule le tarif horaire à partir des **freelances actuellement visibles** sur la page
- **Avantage** : L'estimation s'adapte automatiquement aux filtres appliqués (domaine, spécialisation, pays, etc.)

### 2. **Calcul basé sur la médiane (robuste)**
- Si **1-2 freelances** visibles : utilise le premier tarif
- Si **3+ freelances** visibles : utilise la **médiane** des tarifs
- **Avantage** : Résistant aux valeurs extrêmes (freelances très chers ou très bon marché)

### 3. **Mise à jour automatique**
L'estimation se recalcule automatiquement quand :
- Le budget change
- Les résultats sont filtrés (domaine, spécialisation, pays, etc.)
- Les résultats sont triés
- La pagination change
- Les cartes de freelances se chargent

### 4. **Transparence accrue**
Affiche maintenant :
- Estimation en rituels (système actuel)
- **Estimation directe à l'heure** (nouveau)
- **Tarif horaire moyen** utilisé pour le calcul
- **Fourchette de tarifs** (min-max) si plusieurs freelances

## 📊 Exemple de calcul

### Scénario
- Budget sélectionné : **1000-2000 €**
- Freelances visibles avec tarifs : [30€, 45€, 50€, 60€, 80€]

### Calcul
1. **Tarif horaire de référence** : Médiane = **50€/h**
2. **Estimation en rituels** :
   - Min : ceil(1000 / 50) = **20 rituels**
   - Max : floor(2000 / 50) = **40 rituels**
3. **Estimation à l'heure** :
   - Min : ceil(1000 / 50) = **20 heures**
   - Max : floor(2000 / 50) = **40 heures**

### Affichage
```
≈ 20–40 rituels (soit ~20–40 h)

Estimation à l'heure : ~20–40 h • Tarif moyen : 50€/h (fourchette : 30€-80€)
```

## 🔧 Implémentation technique

### Fichiers modifiés

1. **`resources/views/services/projects.blade.php`**
   - Fonction `updateBudgetEstimate()` améliorée
   - Ajout du calcul "à l'heure" en parallèle
   - Affichage enrichi avec tarif moyen et fourchette

### Fonctions clés

#### `getVisibleHourlyRates()`
Récupère les tarifs horaires depuis les attributs `data-hourly-rate` ou `data-ritual-rate` des cartes de freelances visibles.

#### `getRateToUse(rates)`
Détermine le tarif à utiliser :
- 1-2 freelances : premier tarif
- 3+ freelances : médiane

#### `updateBudgetEstimate()`
Calcule et affiche :
- Estimation en rituels (système actuel)
- Estimation à l'heure (nouveau)
- Tarif moyen utilisé
- Fourchette min-max des tarifs

## 📈 Avantages du système

### 1. **Précision contextuelle**
L'estimation reflète les tarifs réels des freelances correspondant aux critères de recherche, pas une moyenne globale.

### 2. **Adaptabilité**
S'adapte automatiquement aux filtres :
- Filtre par domaine → estimation basée sur les tarifs de ce domaine
- Filtre par pays → estimation basée sur les tarifs de ce pays
- Tri par prix → estimation mise à jour

### 3. **Transparence**
Le client voit :
- Le tarif moyen utilisé pour le calcul
- La fourchette de tarifs disponibles
- L'estimation directe en heures (plus compréhensible)

### 4. **Robustesse**
Utilisation de la médiane pour éviter l'impact des valeurs extrêmes.

## 🚀 Utilisation

Le système fonctionne automatiquement. Aucune action requise de la part de l'utilisateur.

### Pour les développeurs

Si vous voulez utiliser ce système ailleurs :

1. **Assurez-vous que les cartes de freelances ont les attributs** :
   ```html
   data-hourly-rate="{{ $freelancer->hourly_rate }}"
   data-ritual-rate="{{ $freelancer->hourly_rate }}"
   ```

2. **Ajoutez l'élément d'affichage** :
   ```html
   <div id="budgetEstimate" class="budget-estimate"></div>
   ```

3. **Incluez le JavaScript** (déjà présent dans `projects.blade.php`)

## 📝 Notes importantes

- Le système utilise la **médiane** pour plus de robustesse
- Les calculs utilisent `Math.ceil()` pour le minimum (optimiste) et `Math.floor()` pour le maximum (réaliste)
- 1 rituel = 1 heure dans le système actuel
- Le tarif horaire est recalculé à chaque changement de filtres/tri/pagination

## 🔄 Évolutions futures possibles

1. **Distinction rituel/heure** : Si 1 rituel ≠ 1 heure (ex: 50 min), adapter le calcul
2. **Estimation par freelance** : Afficher l'estimation spécifique pour chaque freelance
3. **Graphique de distribution** : Visualiser la répartition des tarifs
4. **Estimation personnalisée** : Permettre à l'utilisateur de saisir un tarif horaire manuel
