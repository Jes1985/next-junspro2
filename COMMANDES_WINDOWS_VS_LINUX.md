# 🔄 Commandes Windows vs Linux

## ⚠️ Important

Vous avez **deux environnements différents** :

1. **Windows (Local)** : Votre machine de développement
2. **Linux (Serveur)** : Le serveur de production via Termius

## 🖥️ Sur Windows (Votre Machine Locale)

### Aller dans le projet
```powershell
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3"
```

### Vérifier la connexion
```powershell
php verifier-connexion.php
```

### Vérifier la configuration
```powershell
findstr "DB_DATABASE" .env
```

### Tester avec artisan
```powershell
php artisan tinker --execute="echo 'Base: ' . DB::connection()->getDatabaseName();"
```

## 🌐 Sur Linux (Serveur via Termius)

### Aller dans le projet
```bash
cd /var/www/junspro
```

### Vérifier la connexion
```bash
php verifier-connexion.php
```

### Vérifier la configuration
```bash
grep "DB_DATABASE" .env
```

### Tester avec artisan
```bash
php artisan tinker --execute="echo 'Base: ' . DB::connection()->getDatabaseName();"
```

## 📋 Tableau Comparatif

| Action | Windows (CMD/PowerShell) | Linux (Bash) |
|--------|-------------------------|--------------|
| Aller dans le projet | `cd "C:\Users\...\junspro-main3"` | `cd /var/www/junspro` |
| Chercher dans fichier | `findstr "mot" fichier` | `grep "mot" fichier` |
| Commentaire | `REM texte` | `# texte` |
| Variables | `%VAR%` | `$VAR` |
| Chemin | `C:\chemin\vers\fichier` | `/chemin/vers/fichier` |

## 💡 Rappel

- **Windows** : Pour développer localement
- **Linux (Termius)** : Pour gérer le serveur de production

Ne copiez **pas** les commandes Linux dans Windows, et vice versa !

