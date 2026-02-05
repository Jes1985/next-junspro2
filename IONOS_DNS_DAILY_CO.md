# Configuration DNS Ionos pour Daily.co

## 📋 Vue d'ensemble

Ce guide explique comment configurer les DNS sur Ionos pour utiliser Daily.co avec votre propre domaine (ex: `meet.junspro.com`).

## ⚠️ Important

**Si vous utilisez simplement `junspro.daily.co`** (sous-domaine de Daily.co) :
- ✅ **AUCUNE configuration DNS sur Ionos n'est nécessaire**
- Daily.co gère automatiquement ce domaine
- Passez directement à la section "Configuration dans Daily.co"

## 🎯 Quand configurer les DNS sur Ionos ?

Vous devez configurer les DNS sur Ionos **UNIQUEMENT** si vous souhaitez utiliser :
- Votre propre domaine : `meet.junspro.com`
- Un sous-domaine personnalisé : `video.junspro.com`
- Tout autre domaine que vous possédez

## 📝 Étapes de configuration

### Étape 1 : Configurer le domaine dans Daily.co

1. Connectez-vous à votre compte Daily.co : [https://dashboard.daily.co](https://dashboard.daily.co)
2. **Important** : Dans le menu de gauche, cliquez sur **"Paramètres"** (Settings) - **PAS** sur "Développeurs"
3. Dans la page Paramètres, faites défiler jusqu'à la section **"Domaines"** ou **"Domains"**
4. Cliquez sur le bouton **"Ajouter un domaine"** ou **"Add Domain"** (généralement un bouton bleu/vert)
5. Entrez votre domaine (ex: `meet.junspro.com`)
6. Daily.co vous affichera les instructions DNS spécifiques
7. **Notez** les valeurs fournies par Daily.co (CNAME ou adresse IP)

### Étape 2 : Configurer les DNS sur Ionos

#### A. Accéder à la gestion DNS Ionos

1. Connectez-vous à votre compte Ionos : [https://www.ionos.fr/](https://www.ionos.fr/)
2. Allez dans **Domaines & SSL**
3. Cliquez sur votre domaine (ex: `junspro.com`)
4. Cliquez sur **Gestion DNS** ou **DNS**

#### B. Ajouter l'enregistrement DNS

Daily.co peut demander soit un **CNAME**, soit un **A**. Suivez les instructions exactes de Daily.co.

**Option 1 : Enregistrement CNAME** (le plus courant)

1. Dans la section **Enregistrements DNS**, cliquez sur **Ajouter un enregistrement**
2. Sélectionnez **CNAME**
3. Remplissez les champs :
   ```
   Nom : meet
   (ou le sous-domaine que vous souhaitez utiliser)
   
   Valeur : [valeur fournie par Daily.co]
   (généralement quelque chose comme: daily.co ou cname.daily.co)
   
   TTL : 3600
   (ou laissez la valeur par défaut)
   ```
4. Cliquez sur **Enregistrer**

**Option 2 : Enregistrement A** (si Daily.co le demande)

1. Dans la section **Enregistrements DNS**, cliquez sur **Ajouter un enregistrement**
2. Sélectionnez **A**
3. Remplissez les champs :
   ```
   Nom : meet
   (ou le sous-domaine que vous souhaitez utiliser)
   
   Valeur : [adresse IP fournie par Daily.co]
   (ex: 52.85.123.45)
   
   TTL : 3600
   (ou laissez la valeur par défaut)
   ```
4. Cliquez sur **Enregistrer**

### Étape 3 : Attendre la propagation DNS

- ⏱️ **Délai** : La propagation DNS peut prendre de **5 minutes à 48 heures**
- 🌍 **Vérification** : Utilisez [whatsmydns.net](https://www.whatsmydns.net) pour vérifier la propagation mondiale
- 🔍 **Commande** : Vous pouvez aussi vérifier avec :
  ```bash
  nslookup meet.junspro.com
  ```
  ou
  ```bash
  dig meet.junspro.com
  ```

### Étape 4 : Valider dans Daily.co

1. Retournez dans Daily.co > **Settings** > **Domains**
2. Daily.co vérifiera automatiquement la configuration DNS
3. Une fois la propagation terminée, vous verrez un statut **"Verified"** ou **"Active"**
4. Vous recevrez une notification de confirmation par email

## 📸 Exemple de configuration Ionos

### Interface Ionos - Ajout CNAME

```
┌─────────────────────────────────────────┐
│ Gestion DNS - junspro.com              │
├─────────────────────────────────────────┤
│                                         │
│ Type: CNAME                             │
│ Nom: meet                               │
│ Valeur: daily.co                        │
│ TTL: 3600                               │
│                                         │
│ [Enregistrer]                           │
└─────────────────────────────────────────┘
```

### Résultat attendu

Après configuration, votre domaine `meet.junspro.com` pointera vers Daily.co et pourra être utilisé pour les vidéoconférences.

## ✅ Vérification

### 1. Vérifier la propagation DNS

Allez sur [whatsmydns.net](https://www.whatsmydns.net) et entrez `meet.junspro.com` :
- ✅ Si vous voyez les valeurs Daily.co partout → Configuration réussie
- ⏳ Si certaines zones montrent encore l'ancienne valeur → Propagation en cours

### 2. Vérifier dans Daily.co

Dans Daily.co > Settings > Domains :
- ✅ Statut **"Verified"** ou **"Active"** → Tout est bon
- ⚠️ Statut **"Pending"** → Attendez encore la propagation
- ❌ Statut **"Failed"** → Vérifiez la configuration DNS

## 🐛 Problèmes courants

### Le domaine ne se valide pas dans Daily.co

**Solutions** :
1. Vérifiez que vous avez bien enregistré les DNS sur Ionos
2. Attendez au moins 1 heure (propagation DNS)
3. Vérifiez que le nom du sous-domaine correspond exactement
4. Vérifiez que la valeur CNAME/A est correcte (copiez-collez depuis Daily.co)
5. Vérifiez qu'il n'y a pas de conflit avec d'autres enregistrements DNS

### Erreur "DNS not found" après 48h

**Solutions** :
1. Vérifiez que l'enregistrement DNS existe bien dans Ionos
2. Vérifiez le type d'enregistrement (CNAME vs A)
3. Contactez le support Ionos si nécessaire
4. Vérifiez que vous avez bien sauvegardé les modifications DNS

### Le domaine fonctionne mais les vidéos ne se chargent pas

**Solutions** :
1. Vérifiez que `DAILY_DOMAIN` dans votre `.env` correspond au domaine configuré
2. Vérifiez que votre clé API Daily.co est valide
3. Vérifiez les logs Laravel pour les erreurs
4. Testez avec le domaine Daily.co par défaut (`junspro.daily.co`) pour isoler le problème

## 📞 Support

- **Ionos Support** : [https://www.ionos.fr/assistance](https://www.ionos.fr/assistance)
- **Daily.co Support** : [https://help.daily.co](https://help.daily.co)
- **Documentation Daily.co DNS** : [https://docs.daily.co/docs/custom-domains](https://docs.daily.co/docs/custom-domains)

## 💡 Astuce

Pour tester rapidement sans attendre la propagation DNS complète, vous pouvez utiliser le domaine Daily.co par défaut (`junspro.daily.co`) dans votre `.env` :

```env
DAILY_DOMAIN=junspro.daily.co
```

Une fois votre domaine personnalisé validé, vous pourrez le changer pour :

```env
DAILY_DOMAIN=meet.junspro.com
```

