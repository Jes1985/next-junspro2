# 💾 Guide Complet de Sauvegarde

## ⚠️ TRÈS IMPORTANT : Sauvegarder AVANT de Modifier

Avant d'apporter des modifications au design ou à la base de données, **SAUVEGARDEZ TOUT** !

---

## 📦 1. Sauvegarder la Base de Données

### Méthode 1 : Via phpMyAdmin (RECOMMANDÉ - Le Plus Simple)

1. **Ouvrez Laragon**
2. Cliquez sur **Menu** → **Database** → **phpMyAdmin**
3. Dans phpMyAdmin :
   - Cliquez sur `junspro_db` dans la liste de gauche
   - Cliquez sur l'onglet **"Exporter"** (en haut)
   - Laissez les options par défaut
   - Cliquez sur **"Exécuter"** (bouton bleu en bas)
4. Un fichier `.sql` sera téléchargé (ex: `junspro_db.sql`)
5. **Gardez ce fichier en sécurité** dans un dossier de sauvegarde

**✅ Cette méthode sauvegarde TOUTE la base de données**

### Méthode 2 : Via HeidiSQL

1. Ouvrez HeidiSQL
2. Sélectionnez la base `junspro_db`
3. **Clic droit** sur `junspro_db` → **"Exporter la base de données en SQL"**
4. Choisissez un emplacement pour sauvegarder (ex: `C:\Users\younes\Backups\`)
5. Cliquez sur **"Exporter"**

### Méthode 3 : Via la Ligne de Commande (Avancé)

```powershell
# Trouver le chemin MySQL de Laragon
cd C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin

# Exporter la base (remplacez le chemin de sauvegarde)
mysqldump -u root junspro_db > "C:\Users\younes\Backups\junspro_db_backup_$(Get-Date -Format 'yyyyMMdd_HHmmss').sql"
```

---

## 💻 2. Sauvegarder le Code Source

### Méthode 1 : Via Git (Recommandé)

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"

# Vérifier l'état
git status

# Ajouter tous les fichiers
git add .

# Créer un commit de sauvegarde
git commit -m "Sauvegarde avant modifications design - $(Get-Date -Format 'yyyy-MM-dd HH:mm')"

# Pousser vers GitHub (si vous avez un dépôt distant)
git push origin main
```

### Méthode 2 : Copie Manuelle du Dossier

1. Fermez tous les programmes qui utilisent le dossier
2. **Copiez** le dossier entier :
   - Source : `C:\Users\younes\Downloads\junspro-main (1)\junspro-main3`
   - Destination : `C:\Users\younes\Backups\junspro-main3_backup_2025-12-06`
3. Attendez que la copie soit terminée

---

## 🎨 3. Pourquoi Vous Voyez l'Ancien Design ?

Le **theme_version** dans la table `basic_settings` détermine quel design afficher :
- **1** = Ancien design (theme 1)
- **2** = Design intermédiaire (theme 2)
- **3** = Nouveau design Junspro V2 ✅

Pour vérifier votre version actuelle :
```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
php verifier-theme.php
```

Pour changer vers le nouveau design (theme 3) :
- Via l'interface admin (Nova ou Admin Panel)
- OU directement dans la base de données (voir ci-dessous)

---

## 📋 Checklist Complète de Sauvegarde

- [ ] **Base de données exportée** (fichier .sql)
  - Fichier sauvegardé : `junspro_db_backup_YYYYMMDD.sql`
  - Emplacement : `C:\Users\younes\Backups\` (créez ce dossier)

- [ ] **Code source sauvegardé**
  - [ ] Commit Git créé : `git commit -m "Sauvegarde avant modifications"`
  - [ ] OU copie du dossier créée : `junspro-main3_backup`

- [ ] **Vérification effectuée**
  - [ ] Base de données testée (connexion OK)
  - [ ] Code source accessible

---

## ✅ Une Fois la Sauvegarde Terminée

Vous pouvez maintenant :
1. Modifier le design en toute sécurité
2. Changer le theme_version vers 3 pour voir le nouveau design
3. Tester vos modifications

---

## 🔄 Pour Restaurer une Sauvegarde (Si Besoin)

### Restaurer la Base de Données :

1. **Via phpMyAdmin** :
   - Ouvrir phpMyAdmin
   - Sélectionner `junspro_db`
   - Onglet **"Importer"**
   - Choisir votre fichier `.sql`
   - Cliquer sur **"Exécuter"**

2. **Via HeidiSQL** :
   - Ouvrir votre fichier `.sql`
   - Exécuter le script SQL

### Restaurer le Code Source :

1. **Via Git** : `git reset --hard [commit-hash]`
2. **Via copie manuelle** : Remplacer le dossier par la sauvegarde

---

## 💡 Recommandation

**Créez un dossier de sauvegardes** :
```
C:\Users\younes\Backups\
  ├── junspro_db_backup_2025-12-06.sql
  └── junspro-main3_backup_2025-12-06\
```

**Faites une sauvegarde quotidienne pendant le développement !**

