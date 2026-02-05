# Configuration Daily.co pour Junspro

## 📋 Vue d'ensemble

Daily.co est utilisé pour les vidéoconférences dans l'écosystème Junspro. Ce document explique comment configurer Daily.co.

## 🔑 Variables d'environnement requises

Ajoutez ces variables dans votre fichier `.env` :

```env
# Daily.co - Vidéoconférence
DAILY_API_KEY=your_daily_api_key_here
DAILY_DOMAIN=junspro.daily.co
DAILY_ENABLE_PRECALL=true
```

## 📝 Description des variables

### `DAILY_API_KEY` (requis)
- **Description** : Clé API Daily.co pour authentifier les requêtes
- **Où l'obtenir** : 
  1. Connectez-vous à votre compte Daily.co
  2. Allez dans **Settings** > **API Keys**
  3. Créez une nouvelle clé API ou copiez une clé existante
- **Format** : Chaîne alphanumérique (ex: `abc123def456...`)

### `DAILY_DOMAIN` (optionnel)
- **Description** : Domaine personnalisé Daily.co pour votre organisation
- **Valeur par défaut** : `junspro.daily.co`
- **Format** : Sous-domaine Daily.co (ex: `junspro.daily.co`, `meet.junspro.daily.co`)

### `DAILY_ENABLE_PRECALL` (optionnel)
- **Description** : Active l'interface de pré-appel (test audio/vidéo avant de rejoindre)
- **Valeur par défaut** : `true`
- **Valeurs possibles** : `true` ou `false`

## 🚀 Configuration initiale

### 1. Créer un compte Daily.co

1. Allez sur [https://www.daily.co/](https://www.daily.co/)
2. Créez un compte ou connectez-vous
3. Choisissez un plan (Free tier disponible pour commencer)

### 2. Obtenir votre clé API

1. Dans le dashboard Daily.co, allez dans **Settings** > **API Keys**
2. Cliquez sur **Create API Key**
3. Donnez un nom à votre clé (ex: "Junspro Production")
4. Copiez la clé API générée
5. ⚠️ **Important** : La clé ne sera affichée qu'une seule fois, sauvegardez-la immédiatement

### 3. Configurer un domaine personnalisé (optionnel)

#### Option A : Utiliser le domaine Daily.co par défaut (`junspro.daily.co`)

Si vous utilisez simplement `junspro.daily.co` (sous-domaine de Daily.co) :
- ✅ **Aucune configuration DNS sur Ionos n'est nécessaire**
- Daily.co gère automatiquement ce domaine
- Il suffit de l'ajouter dans Daily.co dashboard > **Paramètres** > **Domaines**

#### Option B : Utiliser votre propre domaine (ex: `meet.junspro.com`)

Si vous souhaitez utiliser votre propre domaine hébergé sur Ionos :

1. **Dans Daily.co** :
   - **Étape 1** : Cliquez sur **"Paramètres"** dans le menu de gauche (pas "Développeurs")
   - **Étape 2** : Dans la page Paramètres, cherchez la section **"Domaines"** ou **"Domains"**
   - **Étape 3** : Cliquez sur le bouton **"Ajouter un domaine"** ou **"Add Domain"**
   - **Étape 4** : Entrez votre domaine (ex: `meet.junspro.com`)
   - **Étape 5** : Daily.co vous donnera des instructions DNS spécifiques à configurer sur Ionos

2. **Dans Ionos** (configuration DNS) :
   - Connectez-vous à votre compte Ionos
   - Allez dans **Domaines** > **Gestion DNS**
   - Sélectionnez votre domaine (ex: `junspro.com`)
   - Ajoutez/modifiez les enregistrements suivants selon les instructions Daily.co :
     
     **Type CNAME** :
     ```
     Nom : meet (ou le sous-domaine choisi)
     Valeur : [valeur fournie par Daily.co, généralement quelque chose comme: daily.co ou cname.daily.co]
     TTL : 3600 (ou valeur par défaut)
     ```
     
     OU **Type A** (si Daily.co le demande) :
     ```
     Nom : meet
     Valeur : [adresse IP fournie par Daily.co]
     TTL : 3600
     ```

3. **Attendre la propagation DNS** :
   - La propagation peut prendre de 5 minutes à 48 heures
   - Vérifiez avec : `nslookup meet.junspro.com` ou [whatsmydns.net](https://www.whatsmydns.net)

4. **Valider dans Daily.co** :
   - Une fois la propagation terminée, Daily.co validera automatiquement le domaine
   - Vous recevrez une notification de confirmation

### 4. Ajouter les variables dans `.env`

Ouvrez votre fichier `.env` et ajoutez :

```env
DAILY_API_KEY=votre_cle_api_ici
DAILY_DOMAIN=junspro.daily.co
DAILY_ENABLE_PRECALL=true
```

### 5. Vérifier la configuration

Après avoir ajouté les variables, vérifiez que la configuration est correcte :

```bash
php artisan config:clear
php artisan config:cache
```

## 🔧 Utilisation dans le code

La configuration Daily.co est accessible via :

```php
use Illuminate\Support\Facades\Config;

$apiKey = config('services.daily.api_key');
$domain = config('services.daily.domain');
$enablePrecall = config('services.daily.enable_precall');
```

## 📚 Documentation Daily.co

- **API Documentation** : [https://docs.daily.co/reference](https://docs.daily.co/reference)
- **JavaScript SDK** : [https://docs.daily.co/reference/daily-js](https://docs.daily.co/reference/daily-js)
- **React Hooks** : [https://docs.daily.co/reference/daily-react](https://docs.daily.co/reference/daily-react)

## 🔒 Sécurité

- ⚠️ **Ne jamais** commiter le fichier `.env` dans Git
- ⚠️ **Ne jamais** exposer la clé API dans le code frontend
- ⚠️ Utilisez des clés API différentes pour développement et production
- ⚠️ Régénérez la clé API si elle est compromise

## 🐛 Dépannage

### Erreur : "Invalid API key"
- Vérifiez que `DAILY_API_KEY` est correctement défini dans `.env`
- Vérifiez qu'il n'y a pas d'espaces avant/après la clé
- Exécutez `php artisan config:clear` pour vider le cache

### Erreur : "Domain not found"
- Vérifiez que `DAILY_DOMAIN` correspond à un domaine configuré dans votre compte Daily.co
- Si vous utilisez le domaine par défaut (`junspro.daily.co`), aucune configuration DNS n'est nécessaire
- Si vous utilisez votre propre domaine, vérifiez la configuration DNS sur Ionos

### Configuration DNS sur Ionos ne fonctionne pas
- Vérifiez que vous avez ajouté le bon type d'enregistrement (CNAME ou A)
- Vérifiez que le nom du sous-domaine est correct (ex: `meet` pour `meet.junspro.com`)
- Attendez la propagation DNS (peut prendre jusqu'à 48h)
- Utilisez [whatsmydns.net](https://www.whatsmydns.net) pour vérifier la propagation mondiale
- Vérifiez que Daily.co a bien validé votre domaine dans leur dashboard

### Les vidéoconférences ne se chargent pas
- Vérifiez que votre clé API a les permissions nécessaires
- Vérifiez les logs Laravel pour les erreurs d'API
- Vérifiez que le domaine est correctement configuré dans Daily.co
- Si vous utilisez votre propre domaine, vérifiez que la propagation DNS est terminée

## 📞 Support

Pour toute question sur Daily.co :
- **Documentation** : [https://docs.daily.co](https://docs.daily.co)
- **Support Daily.co** : [https://help.daily.co](https://help.daily.co)

