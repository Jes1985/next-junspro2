# 💾 Comment Exporter la Base de Données

## 📋 Méthode 1 : Via phpMyAdmin (Interface Graphique)

### Si vous ne voyez pas l'onglet "Exporter" :

1. **Dans phpMyAdmin**, cliquez sur **`junspro_db`** dans la liste de gauche
2. Cherchez en haut de la page :
   - **"Exporter"** (peut être dans un menu déroulant)
   - OU **"Export"** (version anglaise)
   - OU un bouton avec une icône de téléchargement ⬇️
3. Si vous ne trouvez pas, essayez :
   - **Clic droit** sur `junspro_db` → Cherchez "Exporter" ou "Export"
   - Menu **"Plus"** ou **"More"** → "Exporter"

### Alternative dans phpMyAdmin :

1. Cliquez sur **`junspro_db`** (à gauche)
2. En haut, cherchez **"SQL"** ou **"Requêtes"**
3. Tapez : `SHOW TABLES;` et cliquez sur **"Exécuter"**
4. Puis cherchez un bouton **"Exporter"** ou **"Export"** en haut à droite

---

## 📋 Méthode 2 : Via HeidiSQL (Plus Simple)

1. **Ouvrez HeidiSQL**
2. **Clic droit** sur `junspro_db` (dans la liste de gauche)
3. Cliquez sur **"Exporter la base de données en SQL"**
4. Choisissez un emplacement (ex: `C:\Users\younes\Backups\`)
5. Cliquez sur **"Exporter"**

**✅ C'est la méthode la plus simple !**

---

## 📋 Méthode 3 : Via la Ligne de Commande

### Trouver le chemin MySQL de Laragon :

```powershell
# Créer un dossier de sauvegarde
New-Item -ItemType Directory -Force -Path "C:\Users\younes\Backups"

# Exporter via mysqldump (si disponible dans le PATH)
# Sinon, utilisez le chemin complet de Laragon
cd C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin

# Exporter la base
.\mysqldump.exe -u root junspro_db > "C:\Users\younes\Backups\junspro_db_backup.sql"
```

---

## 📋 Méthode 4 : Via Laragon Directement

1. Dans **Laragon**, cliquez sur **Menu** → **MySQL**
2. Cherchez **"Sauvegarder toutes les bases de données"**
3. Cela créera une sauvegarde de toutes les bases

---

## 🎯 Recommandation

**Utilisez HeidiSQL** (Méthode 2) - C'est le plus simple et le plus rapide !

1. Ouvrez HeidiSQL
2. Clic droit sur `junspro_db`
3. **"Exporter la base de données en SQL"**
4. Choisissez où sauvegarder
5. Cliquez sur **"Exporter"**

**C'est tout ! ✅**

