# Guide Détaillé - Configuration du CRON

Ce guide explique comment configurer le CRON selon votre type d'hébergement.

---

## 🎯 Où configurer le CRON ?

Cela dépend de votre type d'hébergement :

### Option 1 : cPanel (Hébergement partagé)

**Accès :**
1. Connectez-vous à votre **cPanel** (généralement : `https://votre-domaine.com/cpanel`)
2. Dans la barre de recherche, tapez **"Cron Jobs"**
3. Cliquez sur **"Cron Jobs"** dans les résultats

**Configuration :**
1. Dans la section **"Add New Cron Job"** ou **"Ajouter une nouvelle tâche CRON"**
2. Remplissez les champs :
   - **Minute** : `*`
   - **Heure** : `*`
   - **Jour** : `*`
   - **Mois** : `*`
   - **Jour de la semaine** : `*`
   - **Commande** : 
     ```bash
     cd /home/votreuser/public_html/junspro-main3 && php artisan schedule:run
     ```
     *(Remplacez `/home/votreuser/public_html/junspro-main3` par le chemin réel de votre projet)*

3. Cliquez sur **"Add New Cron Job"** ou **"Ajouter"**

**Comment trouver le chemin exact ?**
- Dans cPanel, allez dans **"File Manager"**
- Naviguez jusqu'à votre projet
- Le chemin complet s'affiche en haut (ex: `/home/username/public_html/junspro-main3`)

---

### Option 2 : VPS / Serveur dédié (Linux)

**Accès via SSH :**
1. Connectez-vous à votre serveur via SSH :
   ```bash
   ssh utilisateur@votre-serveur.com
   ```
2. Une fois connecté, éditez le crontab :
   ```bash
   crontab -e
   ```
3. Si c'est la première fois, choisissez un éditeur (recommandé : `nano`)

**Configuration :**
1. Ajoutez cette ligne à la fin du fichier :
   ```bash
   * * * * * cd /var/www/junspro-main3 && php artisan schedule:run >> /dev/null 2>&1
   ```
   *(Remplacez `/var/www/junspro-main3` par le chemin réel de votre projet)*

2. Sauvegardez et quittez :
   - **Nano** : `Ctrl + X`, puis `Y`, puis `Enter`
   - **Vi** : `:wq`, puis `Enter`

**Vérifier que c'est bien configuré :**
```bash
crontab -l
```
Vous devriez voir votre ligne de CRON.

---

### Option 3 : Windows Server

**Accès via Task Scheduler :**
1. Ouvrez **"Planificateur de tâches"** (Task Scheduler)
   - Appuyez sur `Windows + R`
   - Tapez `taskschd.msc`
   - Appuyez sur `Enter`

2. Dans le menu de gauche, cliquez sur **"Bibliothèque du Planificateur de tâches"**

3. Cliquez sur **"Créer une tâche..."** (pas "Créer une tâche de base")

**Configuration :**
1. **Onglet "Général"** :
   - **Nom** : `Junspro Scheduler`
   - Cochez **"Exécuter que l'utilisateur soit connecté ou non"**
   - Cochez **"Exécuter avec les privilèges les plus élevés"**

2. **Onglet "Déclencheurs"** :
   - Cliquez sur **"Nouveau..."**
   - **Démarrer la tâche** : `À l'heure programmée`
   - **Paramètres** : `Répéter la tâche toutes les 1 minutes`
   - Cochez **"Indéfiniment"**
   - Cliquez sur **"OK"**

3. **Onglet "Actions"** :
   - Cliquez sur **"Nouveau..."**
   - **Action** : `Démarrer un programme`
   - **Programme/script** : `C:\php\php.exe` (ou le chemin vers votre PHP)
   - **Ajouter des arguments** : `artisan schedule:run`
   - **Démarrer dans** : `C:\chemin\vers\votre\projet\junspro-main3`
   - Cliquez sur **"OK"**

4. **Onglet "Conditions"** :
   - Décochez **"Mettre le PC en veille uniquement sur secteur"**

5. Cliquez sur **"OK"** et entrez votre mot de passe administrateur

---

### Option 4 : Plesk (Hébergement)

**Accès :**
1. Connectez-vous à votre **Plesk**
2. Allez dans **"Scheduled Tasks"** ou **"Tâches planifiées"**

**Configuration :**
1. Cliquez sur **"Add Task"** ou **"Ajouter une tâche"**
2. Remplissez :
   - **Run** : `Custom script`
   - **Script path** : `/usr/bin/php /var/www/vhosts/votre-domaine.com/httpdocs/junspro-main3/artisan schedule:run`
   - **Run on** : `Minute`
   - **Minute** : `*` (toutes les minutes)
3. Cliquez sur **"OK"**

---

### Option 5 : DirectAdmin

**Accès :**
1. Connectez-vous à votre **DirectAdmin**
2. Allez dans **"Advanced Features"** → **"Cron Jobs"**

**Configuration :**
1. Dans **"Add Cron Job"**, remplissez :
   - **Minute** : `*`
   - **Hour** : `*`
   - **Day** : `*`
   - **Month** : `*`
   - **Weekday** : `*`
   - **Command** :
     ```bash
     cd /home/votreuser/domains/votre-domaine.com/public_html/junspro-main3 && php artisan schedule:run
     ```
2. Cliquez sur **"Add"**

---

## 🔍 Comment trouver le chemin exact de votre projet ?

### Méthode 1 : Via cPanel File Manager
1. Ouvrez **File Manager**
2. Naviguez jusqu'à votre projet
3. Le chemin complet s'affiche en haut

### Méthode 2 : Via SSH
```bash
# Se connecter en SSH
ssh utilisateur@votre-serveur.com

# Aller dans votre projet
cd /chemin/vers/votre/projet

# Afficher le chemin actuel
pwd
```

### Méthode 3 : Via PHP
Créez un fichier `test-path.php` dans votre projet :
```php
<?php
echo __DIR__;
?>
```
Accédez à `https://votre-domaine.com/test-path.php` pour voir le chemin.

---

## ✅ Vérifier que le CRON fonctionne

### Méthode 1 : Test manuel
```bash
cd /chemin/vers/votre/projet
php artisan schedule:run
```

Si vous voyez des messages comme :
```
Running scheduled command: App\Jobs\ProcessSubscriptionReminders
```
Cela signifie que le CRON fonctionne.

### Méthode 2 : Vérifier les logs
```bash
# Voir les logs Laravel
tail -f storage/logs/laravel.log

# Ou dans cPanel
# File Manager → storage/logs/laravel.log
```

### Méthode 3 : Vérifier les entrées dans la base de données
Si les jobs CRON fonctionnent, vous devriez voir des entrées dans :
- `audit_logs`
- `notification_logs`

---

## 🐛 Dépannage

### Le CRON ne s'exécute pas

1. **Vérifier le chemin PHP** :
   ```bash
   which php
   # ou
   whereis php
   ```
   Utilisez le chemin complet dans le CRON : `/usr/bin/php` au lieu de `php`

2. **Vérifier les permissions** :
   ```bash
   chmod +x artisan
   ```

3. **Vérifier les logs** :
   - Dans cPanel : **Cron Jobs** → **Cron Logs**
   - Sur VPS : `/var/log/cron` ou `journalctl -u cron`

4. **Tester avec un CRON simple** :
   ```bash
   * * * * * echo "Test CRON" >> /tmp/cron-test.log
   ```
   Vérifiez que le fichier `/tmp/cron-test.log` est créé après 1 minute.

### Erreur "artisan: command not found"

Utilisez le chemin complet :
```bash
cd /chemin/vers/projet && /usr/bin/php artisan schedule:run
```

### Erreur de permissions

```bash
chmod 755 artisan
chmod -R 775 storage bootstrap/cache
```

---

## 📝 Exemple complet pour cPanel

**Commande CRON complète :**
```bash
cd /home/username/public_html/junspro-main3 && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

**Décomposition :**
- `cd /home/username/public_html/junspro-main3` : Aller dans le projet
- `&&` : Si le cd réussit, alors...
- `/usr/bin/php` : Chemin complet vers PHP
- `artisan schedule:run` : Commande Laravel
- `>> /dev/null 2>&1` : Rediriger les sorties (optionnel)

---

## 🎯 Résumé rapide

**Pour cPanel :**
1. cPanel → Cron Jobs
2. Ajouter : `* * * * * cd /chemin/projet && php artisan schedule:run`

**Pour VPS :**
1. SSH : `ssh user@server`
2. Éditer : `crontab -e`
3. Ajouter : `* * * * * cd /chemin/projet && php artisan schedule:run`

**Pour Windows :**
1. Task Scheduler
2. Créer une tâche qui s'exécute toutes les minutes
3. Action : `php.exe artisan schedule:run`

---

**Besoin d'aide ?** Vérifiez les logs ou contactez votre hébergeur pour connaître le chemin exact de votre projet.

