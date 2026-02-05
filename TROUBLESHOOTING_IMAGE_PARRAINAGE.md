# 🔧 Dépannage : Image hero parrainage ne s'affiche pas

## 📋 Problème

L'image hero de la page `/parrainage` ne s'affiche pas.

## ✅ Solutions

### 1. Vérifier l'emplacement de l'image

L'image doit être placée dans **UN** de ces emplacements :

**Option 1 (recommandé)** :
```
public/images/parrainage-hero.png
```
ou
```
public/images/parrainage-hero.jpg
```

**Option 2** :
```
public/assets/img/parrainage-hero.png
```
ou
```
public/assets/img/parrainage-hero.jpg
```

### 2. Vérifier le nom du fichier

Le fichier doit s'appeler **exactement** :
- `parrainage-hero.png` ✅
- `parrainage-hero.jpg` ✅
- `parrainage-hero.jpeg` ✅

**Noms incorrects** :
- `parrainage-hero-1.png` ❌
- `parrainage hero.png` ❌ (espace)
- `Parrainage-Hero.png` ❌ (majuscules)
- `parrainage_hero.png` ❌ (underscore)

### 3. Vérifier les permissions

Sur Linux/Mac, assurez-vous que le fichier est lisible :
```bash
chmod 644 public/images/parrainage-hero.png
```

### 4. Vider le cache Laravel

Après avoir ajouté l'image, videz le cache :
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### 5. Vérifier dans le navigateur

1. Ouvrez la page `/parrainage` dans votre navigateur
2. Ouvrez les outils de développement (F12)
3. Allez dans l'onglet **Network** (Réseau)
4. Rechargez la page
5. Cherchez `parrainage-hero` dans la liste
6. Vérifiez si l'image est chargée (statut 200) ou si elle retourne une erreur 404

### 6. Vérifier le chemin dans le code source

1. Ouvrez la page `/parrainage`
2. Clic droit sur l'image (ou sur l'espace où elle devrait être)
3. Sélectionnez **"Inspecter l'élément"** ou **"Inspect"**
4. Regardez l'attribut `src` de la balise `<img>`
5. Vérifiez si le chemin est correct

## 🔍 Diagnostic automatique

Le code vérifie maintenant automatiquement plusieurs emplacements :

1. `public/images/parrainage-hero.png`
2. `public/images/parrainage-hero.jpg`
3. `public/images/parrainage-hero.jpeg`
4. `public/assets/img/parrainage-hero.png`
5. `public/assets/img/parrainage-hero.jpg`
6. `public/assets/img/parrainage-hero.jpeg`

Si aucune image n'est trouvée, le placeholder SVG sera utilisé automatiquement.

## 📝 Instructions pour ajouter l'image

### Méthode 1 : Via l'explorateur de fichiers

1. Ouvrez l'explorateur de fichiers Windows
2. Naviguez vers : `C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\public\images\`
3. Copiez votre image dans ce dossier
4. Renommez-la en `parrainage-hero.png` (ou `.jpg`)

### Méthode 2 : Via le terminal

```powershell
# Aller dans le dossier images
cd "C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\public\images"

# Copier votre image (remplacez le chemin source)
Copy-Item "C:\Chemin\Vers\Votre\Image.jpg" -Destination "parrainage-hero.jpg"
```

### Méthode 3 : Via FTP/SFTP (si sur serveur)

1. Connectez-vous à votre serveur via FTP/SFTP
2. Naviguez vers `public/images/`
3. Uploadez votre image
4. Renommez-la en `parrainage-hero.png`

## ✅ Vérification finale

Après avoir ajouté l'image :

1. ✅ Vérifiez que le fichier existe : `public/images/parrainage-hero.png`
2. ✅ Videz le cache : `php artisan cache:clear`
3. ✅ Rechargez la page `/parrainage` (Ctrl+F5 pour forcer le rechargement)
4. ✅ Vérifiez dans les outils de développement que l'image se charge (statut 200)

## 🐛 Si l'image ne s'affiche toujours pas

1. **Vérifiez la console du navigateur** (F12 > Console) pour les erreurs
2. **Vérifiez les logs Laravel** : `storage/logs/laravel.log`
3. **Testez l'URL directement** : `http://localhost:8000/images/parrainage-hero.png`
4. **Vérifiez les permissions** du fichier et du dossier
5. **Vérifiez la taille du fichier** (ne doit pas être trop lourd, max 2-3 MB recommandé)

## 📞 Support

Si le problème persiste après avoir suivi ces étapes, vérifiez :
- Les logs Laravel pour les erreurs
- La console du navigateur pour les erreurs JavaScript/CSS
- Que le serveur web a les permissions de lecture sur le fichier

