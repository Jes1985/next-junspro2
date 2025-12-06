# 💾 Commandes de Sauvegarde Rapide

## ✅ Situation Actuelle

- **Theme version** : 2 (ancien design)
- **Base de données** : `junspro_db` (74 tables)
- **Nouveau design disponible** : Theme 3 (Junspro V2)

---

## 📦 1. Sauvegarder la Base de Données (phpMyAdmin)

### Étapes :

1. **Laragon** → **Menu** → **Database** → **phpMyAdmin**
2. Cliquez sur **`junspro_db`** (à gauche)
3. Cliquez sur l'onglet **"Exporter"** (en haut)
4. Cliquez sur **"Exécuter"** (bouton bleu)
5. Le fichier sera téléchargé : `junspro_db.sql`

**✅ Fait ! Votre base est sauvegardée**

---

## 💻 2. Sauvegarder le Code Source (Git)

### Commandes :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"

# Voir l'état actuel
git status

# Ajouter tous les changements
git add .

# Créer un commit de sauvegarde
git commit -m "Sauvegarde avant changement theme_version vers 3"

# Pousser vers GitHub (optionnel)
git push origin main
```

**✅ Fait ! Votre code est sauvegardé dans Git**

---

## 🎨 3. Changer vers le Nouveau Design (Theme 3)

### Après avoir sauvegardé, exécutez :

```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"

# Changer le thème vers 3
php changer-theme-v3.php

# Vider le cache
php artisan view:clear

# Recharger le navigateur (Ctrl+F5)
```

---

## 📋 Ordre Recommandé

1. ✅ **Sauvegarder la base de données** (phpMyAdmin)
2. ✅ **Sauvegarder le code** (Git commit)
3. ✅ **Changer le thème vers 3**
4. ✅ **Vider le cache**
5. ✅ **Recharger le navigateur**

---

## 🔄 Si Vous Voulez Restaurer

### Restaurer la base de données :

1. phpMyAdmin → `junspro_db` → Onglet **"Importer"**
2. Choisir votre fichier `.sql` sauvegardé
3. Cliquer sur **"Exécuter"**

### Restaurer le code :

```powershell
git reset --hard HEAD~1  # Annule le dernier commit
# OU
git checkout [ancien-commit-hash]
```

---

**Une fois sauvegardé, vous pouvez changer le thème en toute sécurité ! 🚀**

