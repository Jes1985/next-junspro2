# Installation et Configuration MySQL pour Junspro V2

## Option 1 : Installation MySQL Standalone

### Téléchargement
1. Téléchargez MySQL depuis : https://dev.mysql.com/downloads/installer/
2. Choisissez "MySQL Installer for Windows"
3. Sélectionnez "Full" ou "Developer Default"

### Installation
1. Exécutez l'installateur
2. Suivez les instructions
3. Notez le mot de passe root que vous définissez

### Configuration
1. Démarrez le service MySQL (Services Windows)
2. Créez la base de données :
```sql
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'junspro_user'@'localhost' IDENTIFIED BY 'junspro2025';
GRANT ALL PRIVILEGES ON junspro.* TO 'junspro_user'@'localhost';
FLUSH PRIVILEGES;
```

### Configuration .env
Modifiez votre fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=junspro
DB_USERNAME=junspro_user
DB_PASSWORD=junspro2025
```

### Exécution des migrations
```bash
php artisan migrate:fresh
```

---

## Option 2 : XAMPP (Plus simple)

### Installation
1. Téléchargez XAMPP : https://www.apachefriends.org/
2. Installez XAMPP
3. Démarrez MySQL depuis le panneau de contrôle XAMPP

### Configuration
1. Accédez à phpMyAdmin : http://localhost/phpmyadmin
2. Créez la base de données `junspro`
3. Créez l'utilisateur `junspro_user` avec le mot de passe `junspro2025`
4. Accordez tous les privilèges

### Configuration .env
Même configuration que l'Option 1.

---

## Option 3 : Utiliser SQLite (Déjà configuré)

SQLite est déjà configuré et fonctionne. Pour continuer avec SQLite, aucune action n'est nécessaire.

Pour revenir à MySQL plus tard, suivez les étapes ci-dessus.



