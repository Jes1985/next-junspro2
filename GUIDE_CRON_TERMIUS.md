# Guide - Configuration CRON avec Termius

Ce guide explique comment configurer le CRON en utilisant Termius pour se connecter à votre serveur.

---

## 📱 Étape 1 : Se connecter au serveur avec Termius

### 1.1 Ouvrir Termius

1. Ouvrez l'application **Termius** sur votre ordinateur
2. Si vous n'avez pas encore de connexion configurée, créez-en une :
   - Cliquez sur **"+"** ou **"New Host"**
   - Remplissez :
     - **Label** : `Mon Serveur Junspro` (nom de votre choix)
     - **Address** : `votre-serveur.com` ou l'IP de votre serveur
     - **Username** : `root` ou votre nom d'utilisateur
     - **Port** : `22` (par défaut pour SSH)
     - **Password** : Votre mot de passe (ou utilisez une clé SSH)

3. Cliquez sur **"Save"** puis **"Connect"**

### 1.2 Se connecter

1. Double-cliquez sur votre serveur dans la liste
2. Entrez votre mot de passe si demandé
3. Vous devriez voir un terminal avec quelque chose comme :
   ```
   user@server:~$
   ```

---

## 🔧 Étape 2 : Trouver le chemin de votre projet

### 2.1 Naviguer vers votre projet

```bash
# Aller dans le répertoire de votre projet
cd /var/www/junspro-main3

# OU si c'est dans public_html
cd /home/votreuser/public_html/junspro-main3

# OU si vous ne connaissez pas le chemin, cherchez-le
find / -name "artisan" -type f 2>/dev/null | grep junspro
```

### 2.2 Vérifier que vous êtes au bon endroit

```bash
# Afficher le chemin actuel
pwd

# Vérifier que artisan existe
ls -la artisan

# Vous devriez voir quelque chose comme :
# -rwxr-xr-x 1 user user 1234 Dec  7 10:00 artisan
```

**Notez le chemin complet** (ex: `/var/www/junspro-main3` ou `/home/username/public_html/junspro-main3`)

---

## ⚙️ Étape 3 : Configurer le CRON

### 3.1 Ouvrir le crontab

```bash
# Éditer le crontab de l'utilisateur actuel
crontab -e
```

**Si c'est la première fois**, vous devrez choisir un éditeur :
- Tapez `1` pour **nano** (recommandé, plus simple)
- Ou `2` pour **vi** (si vous êtes à l'aise avec)

### 3.2 Ajouter la ligne CRON

Dans l'éditeur (nano), ajoutez cette ligne à la fin du fichier :

```bash
* * * * * cd /var/www/junspro-main3 && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

**⚠️ Important :** Remplacez `/var/www/junspro-main3` par le chemin réel de votre projet (celui que vous avez noté à l'étape 2.2).

**Exemple si votre projet est dans public_html :**
```bash
* * * * * cd /home/username/public_html/junspro-main3 && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

### 3.3 Sauvegarder et quitter

**Avec nano :**
1. Appuyez sur `Ctrl + X`
2. Appuyez sur `Y` (pour confirmer)
3. Appuyez sur `Enter`

**Avec vi :**
1. Appuyez sur `Esc`
2. Tapez `:wq`
3. Appuyez sur `Enter`

---

## ✅ Étape 4 : Vérifier que c'est bien configuré

### 4.1 Voir les CRON configurés

```bash
# Lister les CRON de l'utilisateur actuel
crontab -l
```

Vous devriez voir votre ligne :
```
* * * * * cd /var/www/junspro-main3 && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

### 4.2 Tester manuellement

```bash
# Aller dans votre projet
cd /var/www/junspro-main3

# Exécuter manuellement le scheduler
php artisan schedule:run
```

Si vous voyez des messages comme :
```
Running scheduled command: App\Jobs\ProcessSubscriptionReminders
```
Cela signifie que tout fonctionne ! ✅

---

## 🔍 Étape 5 : Trouver le chemin de PHP (si nécessaire)

Si vous avez une erreur "php: command not found", trouvez le chemin complet de PHP :

```bash
# Trouver où se trouve PHP
which php

# Ou
whereis php

# Vous obtiendrez quelque chose comme : /usr/bin/php
```

Ensuite, utilisez le chemin complet dans le CRON :
```bash
* * * * * cd /var/www/junspro-main3 && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

---

## 🐛 Dépannage

### Erreur "Permission denied"

```bash
# Donner les permissions d'exécution à artisan
chmod +x artisan

# Donner les permissions aux dossiers
chmod -R 775 storage bootstrap/cache
```

### Erreur "artisan: command not found"

Utilisez le chemin complet vers PHP et artisan :
```bash
* * * * * cd /var/www/junspro-main3 && /usr/bin/php /var/www/junspro-main3/artisan schedule:run
```

### Vérifier les logs du CRON

```bash
# Voir les logs système (sur certaines distributions)
tail -f /var/log/cron

# Ou
journalctl -u cron -f

# Voir les logs Laravel
tail -f /var/www/junspro-main3/storage/logs/laravel.log
```

### Tester avec un CRON simple

Pour vérifier que le CRON fonctionne, testez avec une commande simple :

```bash
# Éditer le crontab
crontab -e

# Ajouter cette ligne de test
* * * * * echo "CRON fonctionne - $(date)" >> /tmp/cron-test.log

# Attendre 1-2 minutes, puis vérifier
cat /tmp/cron-test.log
```

Si vous voyez des messages avec des dates, le CRON fonctionne ! Vous pouvez alors remplacer cette ligne par la vraie commande.

---

## 📝 Exemple complet dans Termius

Voici un exemple de session complète dans Termius :

```bash
# 1. Se connecter (fait automatiquement par Termius)
user@server:~$

# 2. Aller dans le projet
cd /var/www/junspro-main3
user@server:/var/www/junspro-main3$

# 3. Vérifier le chemin
pwd
# Résultat : /var/www/junspro-main3

# 4. Vérifier que artisan existe
ls artisan
# Résultat : artisan

# 5. Trouver PHP
which php
# Résultat : /usr/bin/php

# 6. Éditer le crontab
crontab -e
# (Choisir nano en tapant 1)

# 7. Ajouter la ligne (dans nano)
* * * * * cd /var/www/junspro-main3 && /usr/bin/php artisan schedule:run >> /dev/null 2>&1

# 8. Sauvegarder (Ctrl+X, Y, Enter)

# 9. Vérifier
crontab -l
# Vous devriez voir votre ligne

# 10. Tester
php artisan schedule:run
# Vous devriez voir des messages de jobs
```

---

## 🎯 Résumé rapide

1. **Ouvrir Termius** → Se connecter à votre serveur
2. **Trouver le chemin** : `cd /chemin/vers/projet && pwd`
3. **Éditer le crontab** : `crontab -e`
4. **Ajouter la ligne** : `* * * * * cd /chemin/projet && php artisan schedule:run`
5. **Sauvegarder** : `Ctrl+X`, `Y`, `Enter`
6. **Vérifier** : `crontab -l`
7. **Tester** : `php artisan schedule:run`

---

## 💡 Astuce

Vous pouvez copier-coller les commandes directement dans Termius. Termius supporte le copier-coller normal (Ctrl+C / Ctrl+V ou Cmd+C / Cmd+V sur Mac).

---

**Besoin d'aide ?** Si vous avez une erreur, copiez le message d'erreur complet et je pourrai vous aider à le résoudre.

