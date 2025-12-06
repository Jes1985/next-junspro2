# 🔧 Résoudre l'Erreur "Unable to create directory"

## ❌ Problème
HeidiSQL ne peut pas créer le répertoire pour sauvegarder le fichier SQL.

## ✅ Solution 1 : Choisir un Emplacement Valide

1. **Cliquez sur l'icône de dossier** 📁 à côté de "Nom de fichier"
2. **Naviguez vers un dossier existant**, par exemple :
   - `C:\Users\younes\Documents\`
   - `C:\Users\younes\Desktop\`
   - `C:\Users\younes\Downloads\`
3. **Tapez le nom du fichier** : `junspro-db-backup.sql`
4. Cliquez sur **"Enregistrer"**

---

## ✅ Solution 2 : Créer un Dossier de Sauvegarde

### Via PowerShell :
```powershell
# Créer un dossier de sauvegarde
New-Item -ItemType Directory -Force -Path "C:\Users\younes\Backups"
```

### Via l'Explorateur Windows :
1. Ouvrez l'Explorateur Windows
2. Allez dans `C:\Users\younes\`
3. Clic droit → **Nouveau** → **Dossier**
4. Nommez-le `Backups`

Puis dans HeidiSQL, cliquez sur l'icône de dossier et choisissez `C:\Users\younes\Backups\`

---

## ✅ Solution 3 : Utiliser un Chemin Simple

Au lieu de laisser le nom par défaut, **cliquez sur l'icône de dossier** et choisissez :
- **Bureau** (`C:\Users\younes\Desktop\`)
- **Documents** (`C:\Users\younes\Documents\`)

Puis nommez le fichier : `junspro-db-backup.sql`

---

## ⚠️ IMPORTANT : N'oubliez pas les Données !

Dans le champ **"Données :"**, changez :
- ❌ **"Pas de données"** 
- ✅ **"Insérer"**

Sinon vous n'aurez que la structure (tables vides), pas les données !

---

## 🎯 Étapes Complètes

1. ✅ Cliquez sur **l'icône de dossier** 📁
2. ✅ Choisissez un emplacement (ex: Bureau ou Documents)
3. ✅ Nommez le fichier : `junspro-db-backup.sql`
4. ✅ Changez **"Données"** de "Pas de données" à **"Insérer"**
5. ✅ Cliquez sur **"Exporter"**

**C'est tout ! ✅**

