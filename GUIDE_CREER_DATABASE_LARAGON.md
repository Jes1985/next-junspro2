# 🗄️ Guide : Créer la Base de Données dans Laragon

## 📍 Étape par Étape

### 1️⃣ Ouvrir phpMyAdmin depuis Laragon

Dans le menu Laragon que vous avez ouvert :
1. Cliquez sur **"phpMyAdmin"** (c'est la première option dans le sous-menu MySQL)
   - C'est l'option avec le logo phpMyAdmin (deux éléphants)
   
   → Cela va ouvrir phpMyAdmin dans votre navigateur

### 2️⃣ Dans phpMyAdmin

Une fois phpMyAdmin ouvert dans votre navigateur :

1. **Cliquez sur l'onglet "SQL"** en haut de la page
   - C'est un onglet à côté de "Structure", "Rechercher", etc.

2. **Dans la zone de texte SQL**, collez cette commande :

```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. **Cliquez sur le bouton "Exécuter"** en bas (ou appuyez sur **Ctrl+Entrée**)

### 3️⃣ Vérifier la Création

Après avoir cliqué sur "Exécuter", vous devriez voir :
- ✅ Un message de succès : "Requête SQL exécutée avec succès"
- ✅ La base de données `junspro` apparaît dans la liste à gauche

### 4️⃣ Alternative : Utiliser "Créer une base de données"

Si vous préférez une interface graphique :

1. Dans le menu Laragon → MySQL, cliquez sur **"Créer une base de données"**
2. Entrez le nom : **junspro**
3. Choisissez l'encodage : **utf8mb4_unicode_ci**
4. Cliquez sur **Créer**

## ✅ Après la Création

1. **Rechargez votre navigateur** sur http://localhost:8000
2. L'erreur "Unknown database 'junspro'" devrait disparaître !

---

## 🎯 Résumé Rapide

```
Laragon → Menu → MySQL → phpMyAdmin → Onglet SQL → Coller la commande → Exécuter
```

