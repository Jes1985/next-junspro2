# Guide d'Installation PHP et Laravel

## 🍫 Installation de Chocolatey

### Méthode 1 : Via PowerShell (Recommandé)

1. **Ouvrez PowerShell en tant qu'administrateur** :
   - Appuyez sur `Windows + X`
   - Sélectionnez "Windows PowerShell (Admin)" ou "Terminal (Admin)"
   - Acceptez la demande d'autorisation

2. **Exécutez cette commande** :
   ```powershell
   Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
   ```

3. **Fermez et rouvrez PowerShell** (en tant qu'admin)

4. **Vérifiez l'installation** :
   ```powershell
   choco --version
   ```

### Méthode 2 : Téléchargement manuel

1. Allez sur https://chocolatey.org/install
2. Suivez les instructions d'installation

---

## 🐘 Installation de PHP

### Une fois Chocolatey installé :

1. **Ouvrez PowerShell en tant qu'administrateur**

2. **Installez PHP** :
   ```powershell
   choco install php -y
   ```

3. **Fermez et rouvrez PowerShell** (pour mettre à jour le PATH)

4. **Vérifiez l'installation** :
   ```powershell
   php --version
   ```

---

## 📦 Installation de Composer (Gestionnaire de dépendances PHP)

### Via Chocolatey :
```powershell
choco install composer -y
```

### Ou manuellement :
1. Téléchargez depuis https://getcomposer.org/download/
2. Installez Composer-Setup.exe

---

## 🗄️ Installation de MySQL/MariaDB

### Via Chocolatey :
```powershell
choco install mysql -y
# Ou MariaDB
choco install mariadb -y
```

### Ou utilisez XAMPP/WAMP qui inclut MySQL

---

## 🚀 Configuration du projet Laravel

### 1. Installer les dépendances PHP :
```powershell
cd C:\Users\younes\junspro
composer install
```

### 2. Configurer le fichier .env :
Copiez `.env.example` vers `.env` et configurez :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=junspro
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Générer la clé de l'application :
```powershell
php artisan key:generate
```

### 4. Créer la base de données :
```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Exécuter les migrations :
```powershell
php artisan migrate
```

---

## ✅ Vérification

Testez que tout fonctionne :
```powershell
php --version
composer --version
php artisan --version
```

---

## 🔧 Alternative : Utiliser Laragon (Tout-en-un)

Laragon est un environnement de développement complet pour Windows qui inclut :
- PHP
- MySQL
- Apache/Nginx
- Composer
- Node.js

**Téléchargement** : https://laragon.org/download/

Une fois installé, ajoutez simplement votre projet dans le dossier `laragon/www/`


