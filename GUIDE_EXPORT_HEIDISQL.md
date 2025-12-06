# 📋 Guide d'Export HeidiSQL - Configuration Complète

## ✅ Cases à Cocher pour une Sauvegarde COMPLÈTE

### 1. **Base(s) de donn. :** (Base de données)
- ✅ **Cocher "Créer"** → Pour inclure la commande `CREATE DATABASE`
- ❌ **Ne PAS cocher "Supprimer/DR"** → Pour éviter de supprimer la base avant de créer

### 2. **Table(s) :** (Tables)
- ✅ **Cocher "Créer"** → Pour inclure toutes les commandes `CREATE TABLE`
- ❌ **Ne PAS cocher "Supprimer/DR"** → Pour éviter de supprimer les tables avant de créer

### 3. **Données :** (IMPORTANT !)
- ❌ **Ne PAS laisser "Pas de données"**
- ✅ **Changer vers "Insérer"** ou **"Insérer + Mettre à jour"**
  - Cela inclura toutes les données de vos tables dans le fichier SQL

### 4. **Destination :**
- ✅ **Laisser "Fichier .sql unique"** (par défaut)

### 5. **Nom de fichier :**
- ✅ **Vérifier le nom** : `junspro-db-6.12.2025.sql` (ou modifier si besoin)
- ✅ **Cliquer sur l'icône de dossier** pour choisir où sauvegarder

---

## 🎯 Configuration Recommandée pour Sauvegarde Complète

```
✅ Base(s) de donn. :
   ☐ Supprimer/DR
   ☑ Créer

✅ Table(s) :
   ☐ Supprimer/DR
   ☑ Créer

✅ Données :
   [Insérer] ← Changer de "Pas de données" à "Insérer"

✅ Destination :
   [Fichier .sql unique]

✅ Nom de fichier :
   junspro-db-6.12.2025.sql
```

---

## ⚠️ Attention

Si vous laissez **"Pas de données"**, vous n'aurez que la **structure** (tables vides), pas les données !

Pour une sauvegarde complète, **changez "Pas de données" vers "Insérer"** ✅

---

## 🚀 Après Configuration

1. Cliquez sur le bouton **"Exporter"** ou **"Démarrer"** (en bas)
2. Attendez la fin de l'exportation
3. Vérifiez que le fichier `.sql` a été créé

**C'est tout ! ✅**

