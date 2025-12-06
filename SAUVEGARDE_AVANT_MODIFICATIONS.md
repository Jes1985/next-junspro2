# 💾 Sauvegarde Avant Modifications

## ⚠️ Important

Avant d'apporter des modifications, il est **ESSENTIEL** de sauvegarder :
1. ✅ Le code source (déjà dans Git)
2. ✅ La base de données

## 📦 1. Sauvegarder la Base de Données

### Méthode 1 : Via phpMyAdmin (Laragon) - LE PLUS SIMPLE

1. **Ouvrez Laragon**
2. **Menu** → **Database** → **phpMyAdmin**
3. Dans phpMyAdmin, sélectionnez la base `junspro_db` (à gauche)
4. Cliquez sur l'onglet **"Exporter"** (en haut)
5. Cliquez sur **"Exécuter"** (en bas)
6. Le fichier SQL sera téléchargé dans votre dossier Téléchargements

### Méthode 2 : Via la Ligne de Commande

```powershell
# Dans Laragon, utilisez MySQL
cd C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin

# Sauvegarder la base
mysqldump -u root -p junspro_db > C:\Users\younes\Downloads\junspro_db_backup_$(Get-Date -Format 'yyyyMMdd_HHmmss').sql
```

### Méthode 3 : Via HeidiSQL

1. Ouvrez HeidiSQL
2. Sélectionnez la base `junspro_db`
3. Clic droit → **"Exporter la base de données en SQL"**
4. Choisissez un emplacement pour sauvegarder

## 🔄 2. Sauvegarder le Code Source

### Via Git (Recommandé)

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"

# Voir l'état actuel
git status

# Ajouter tous les changements
git add .

# Créer une sauvegarde locale (commit)
git commit -m "Sauvegarde avant modifications du design"

# Pousser vers GitHub (optionnel, mais recommandé)
git push origin main
```

### Via Copie Manuelle

1. Copiez tout le dossier `junspro-main3`
2. Collez-le ailleurs (ex: `junspro-main3_backup`)

## 🎨 3. Pourquoi Vous Voyez l'Ancien Design ?

Le `theme_version` dans la base de données détermine quel design afficher.

Vérifiez avec :
```powershell
php artisan tinker --execute="echo 'Theme version: ' . DB::table('basic_settings')->value('theme_version');"
```

Si c'est **3**, vous devriez voir le nouveau design. Sinon, il faut le changer.

## ✅ Checklist de Sauvegarde

- [ ] Base de données exportée (fichier .sql)
- [ ] Code source commité dans Git
- [ ] Copie de sauvegarde du dossier créée (optionnel)

**Une fois ces sauvegardes faites, vous pouvez modifier en toute sécurité !**

