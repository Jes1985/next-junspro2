# Guide Pas à Pas - Configuration Termius pour test.junspro.com

## 📱 Étape 1 : Installation de Termius

### Sur Windows :
1. Allez sur [termius.com](https://www.termius.com/)
2. Cliquez sur **"Download"** → **"Windows"**
3. Téléchargez et installez l'application
4. Ouvrez Termius

### Alternative : Version Web
- Vous pouvez aussi utiliser Termius Web directement dans votre navigateur

---

## 🔧 Étape 2 : Créer un Compte Termius (Optionnel mais Recommandé)

1. Dans Termius, cliquez sur **"Sign Up"** ou **"Create Account"**
2. Créez un compte gratuit (permet de synchroniser vos connexions)
3. Connectez-vous

---

## 🖥️ Étape 3 : Créer une Nouvelle Connexion SSH

### Option A : Via l'Interface Graphique

1. **Ouvrir le panneau de connexion**
   - Cliquez sur le bouton **"+"** en haut à gauche
   - Ou cliquez sur **"Add Host"** dans le menu

2. **Remplir les informations de base**
   ```
   Label: test.junspro.com
   Address: 85.215.146.171
   Port: 22
   Username: root
   ```

3. **Configurer l'authentification**

   **Si vous utilisez un mot de passe :**
   - Dans la section **"Authentication"**, sélectionnez **"Password"**
   - Entrez votre mot de passe
   - Cochez **"Save password"** si vous voulez que Termius le sauvegarde

   **Si vous utilisez une clé SSH :**
   - Sélectionnez **"Key"**
   - Cliquez sur **"Import"** ou **"Select Key"**
   - Naviguez vers votre fichier de clé privée (`.pem`, `.ppk`, ou `id_rsa`)
   - Si vous n'avez pas de clé, vous pouvez en générer une dans Termius

4. **Sauvegarder**
   - Cliquez sur **"Save"** ou **"Add"** en bas

### Option B : Via le Terminal (Avancé)

1. Cliquez sur **"Terminal"** dans Termius
2. Tapez :
   ```bash
   ssh root@85.215.146.171
   ```
3. Termius vous proposera de sauvegarder cette connexion

---

## 🔐 Étape 4 : Générer une Clé SSH (Recommandé pour la Sécurité)

Si vous n'avez pas de clé SSH, générez-en une :

1. Dans Termius, allez dans **"Settings"** → **"Keys"**
2. Cliquez sur **"Generate"** ou **"+"**
3. Choisissez le type de clé (RSA ou Ed25519)
4. Donnez un nom à votre clé (ex: "junspro-vps")
5. Cliquez sur **"Generate"**
6. **Important** : Copiez la clé publique (Public Key)
7. Sur le serveur, ajoutez cette clé :
   ```bash
   # Connectez-vous d'abord avec le mot de passe
   # Puis exécutez :
   mkdir -p ~/.ssh
   echo "VOTRE_CLE_PUBLIQUE" >> ~/.ssh/authorized_keys
   chmod 600 ~/.ssh/authorized_keys
   chmod 700 ~/.ssh
   ```

---

## 📂 Étape 5 : Se Connecter au Serveur

1. Dans la liste des hosts, trouvez **"test.junspro.com"**
2. Cliquez dessus
3. Termius va établir la connexion SSH
4. Vous verrez le terminal du serveur s'afficher

**Première connexion** : Vous pourrez voir un message demandant de confirmer la clé du serveur. Cliquez sur **"Accept"** ou **"Yes"**.

---

## 📁 Étape 6 : Utiliser SFTP pour Transférer des Fichiers

### Méthode 1 : Interface SFTP de Termius

1. **Ouvrir l'onglet SFTP**
   - En bas de l'écran Termius, cliquez sur l'onglet **"SFTP"**
   - Ou utilisez le raccourci clavier

2. **Navigation**
   - **Panneau de gauche** : Fichiers de votre machine locale
   - **Panneau de droite** : Fichiers du serveur distant

3. **Transférer des fichiers**
   - **Glisser-Déposer** : Glissez un fichier d'un panneau à l'autre
   - **Bouton Upload/Download** : Utilisez les boutons de transfert
   - **Clic droit** : Menu contextuel avec options de transfert

4. **Naviguer sur le serveur**
   - Double-cliquez sur les dossiers pour les ouvrir
   - Utilisez le chemin : `/var/www/test.junspro.com`

### Méthode 2 : Synchronisation de Dossier

1. Dans SFTP, sélectionnez un dossier
2. Clic droit → **"Sync"** ou **"Synchronize"**
3. Choisissez la direction (Local → Remote ou Remote → Local)
4. Termius synchronisera automatiquement les fichiers

---

## 🔍 Étape 7 : Vérifier l'Installation Existante

Une fois connecté, vérifions ce qui existe déjà :

```bash
# Vérifier où se trouve le projet actuel
ls -la /var/www/

# Vérifier si test.junspro.com existe déjà
ls -la /var/www/test.junspro.com/

# Vérifier la configuration Nginx
ls -la /etc/nginx/sites-available/ | grep test

# Vérifier la base de données actuelle
mysql -u root -p -e "SHOW DATABASES;" | grep junspro

# Trouver le fichier .env actuel
find /var/www -name ".env" -type f 2>/dev/null

# Voir la configuration de la base de données
cat /var/www/test.junspro.com/.env | grep DB_
```

---

## 🚀 Étape 8 : Mettre à Jour le Projet depuis Git

Si le projet est déjà sur le serveur et connecté à Git :

```bash
# Aller dans le répertoire du projet
cd /var/www/test.junspro.com

# Vérifier le statut Git
git status

# Récupérer les dernières modifications
git pull origin main

# Si vous avez des conflits, résolvez-les d'abord
```

---

## 📤 Étape 9 : Transférer les Fichiers depuis votre Machine

### Via SFTP dans Termius :

1. **Ouvrir SFTP** dans Termius
2. **Naviguer vers le serveur** : `/var/www/test.junspro.com`
3. **Naviguer vers votre machine locale** : `C:\Users\younes\junspro`
4. **Sélectionner les fichiers à transférer** :
   - Exclure : `.env`, `node_modules`, `.git`, `storage`
   - Inclure : Tous les autres fichiers du projet
5. **Glisser-déposer** ou utiliser **Upload**

### Via Terminal (rsync) :

Si vous avez rsync installé sur Windows (via WSL ou Git Bash) :

```bash
rsync -avz --exclude='node_modules' --exclude='.git' --exclude='storage' \
  --exclude='.env' \
  C:/Users/younes/junspro/ root@85.215.146.171:/var/www/test.junspro.com/
```

---

## 🔄 Étape 10 : Exécuter le Script de Mise à Jour

Une fois les fichiers transférés :

```bash
# Se connecter au serveur via Termius
cd /var/www/test.junspro.com

# Rendre le script exécutable (si nécessaire)
chmod +x update-test.sh

# Exécuter le script de mise à jour
bash update-test.sh
```

Le script va automatiquement :
- ✅ Créer un backup de la base de données
- ✅ Installer les dépendances
- ✅ Appliquer les migrations
- ✅ Optimiser l'application
- ✅ Redémarrer les services

---

## ⚙️ Étape 11 : Configuration Avancée de Termius

### Créer des Snippets (Raccourcis de Commandes)

1. Dans Termius, allez dans **"Snippets"**
2. Cliquez sur **"+"**
3. Créez un snippet pour des commandes fréquentes :

   **Exemple : "Mise à jour Junspro"**
   ```bash
   cd /var/www/test.junspro.com && git pull && bash update-test.sh
   ```

4. Sauvegardez
5. Utilisez le snippet depuis n'importe quelle connexion

### Organiser les Connexions

1. Créez des **Groups** (groupes) :
   - "Production Servers"
   - "Development"
   - "Junspro"

2. Glissez vos connexions dans les groupes appropriés

### Personnaliser le Terminal

1. Allez dans **"Settings"** → **"Terminal"**
2. Personnalisez :
   - Couleurs du terminal
   - Police
   - Taille
   - Thème

---

## 🐛 Dépannage

### Problème : "Connection refused" ou "Connection timeout"

**Solutions :**
- Vérifiez que l'adresse IP est correcte : `85.215.146.171`
- Vérifiez que le port est `22`
- Vérifiez votre connexion internet
- Vérifiez que le serveur est en ligne

### Problème : "Permission denied"

**Solutions :**
- Vérifiez votre nom d'utilisateur (probablement `root`)
- Vérifiez votre mot de passe
- Si vous utilisez une clé SSH, vérifiez qu'elle est correctement configurée

### Problème : SFTP ne fonctionne pas

**Solutions :**
- Vérifiez que le service SSH est actif sur le serveur
- Vérifiez les permissions des dossiers sur le serveur
- Essayez de vous reconnecter

### Problème : Les fichiers ne se transfèrent pas

**Solutions :**
- Vérifiez les permissions du répertoire de destination
- Vérifiez l'espace disque disponible sur le serveur
- Vérifiez les logs dans Termius

---

## 📋 Checklist de Configuration Termius

- [ ] Termius installé
- [ ] Compte créé (optionnel)
- [ ] Connexion SSH créée pour test.junspro.com
- [ ] Authentification configurée (mot de passe ou clé SSH)
- [ ] Connexion testée avec succès
- [ ] SFTP testé
- [ ] Installation existante vérifiée sur le serveur
- [ ] Fichiers transférés (si nécessaire)
- [ ] Script de mise à jour exécuté

---

## 🎯 Prochaines Étapes

Une fois Termius configuré :

1. **Connectez-vous au serveur**
2. **Vérifiez l'installation existante** (Étape 7)
3. **Mettez à jour le code** (via Git ou SFTP)
4. **Exécutez le script de mise à jour** (`update-test.sh`)
5. **Vérifiez que le site fonctionne** : https://test.junspro.com

---

## 📚 Ressources

- [Documentation officielle Termius](https://docs.termius.com/)
- Guide de déploiement complet : `DEPLOY_TEST_JUNSPRO.md`
- Guide Termius détaillé : `GUIDE_TERMIUS_DEPLOY.md`
- Script de mise à jour : `update-test.sh`

---

## 💡 Astuces

1. **Utilisez des onglets multiples** : Ouvrez plusieurs connexions en même temps
2. **Sauvegardez vos commandes** : Utilisez les snippets pour les commandes fréquentes
3. **Synchronisez vos connexions** : Créez un compte Termius pour synchroniser entre appareils
4. **Utilisez les favoris** : Marquez les connexions importantes comme favoris
5. **Personnalisez** : Ajustez les couleurs et le thème pour un meilleur confort visuel

