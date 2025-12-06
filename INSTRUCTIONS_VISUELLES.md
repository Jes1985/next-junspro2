# 📍 OÙ COLLER LA COMMANDE SQL

## 🎯 Voici exactement où cliquer :

### ÉTAPE 1 : Ouvrir phpMyAdmin
Dans le menu Laragon que vous avez ouvert :
- Cliquez sur **"phpMyAdmin"** (première option dans le sous-menu MySQL)
  - C'est l'option avec le logo phpMyAdmin (deux éléphants bleus/blancs)

→ phpMyAdmin s'ouvrira dans votre navigateur (généralement sur http://localhost/phpmyadmin)

---

### ÉTAPE 2 : Dans phpMyAdmin

1. **En haut de la page**, vous verrez plusieurs onglets :
   - Structure | SQL | Rechercher | Insérer | etc.
   
2. **Cliquez sur l'onglet "SQL"** (celui qui est gris/foncé)

3. **Vous verrez une grande zone de texte blanche**

4. **Copiez cette commande** (dans le fichier COMMANDE_SQL.txt) :

```
CREATE DATABASE junspro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

5. **Collez-la dans la zone de texte SQL**

6. **Cliquez sur le bouton "Exécuter"** en bas à droite (bouton bleu)
   - OU appuyez sur **Ctrl+Entrée**

---

### ÉTAPE 3 : Vérifier

Vous devriez voir un message vert :
✅ **"Requête SQL exécutée avec succès"**

Et la base `junspro` apparaîtra dans la liste à gauche de phpMyAdmin.

---

## 🚀 Après ça

1. Retournez sur http://localhost:8000
2. Rechargez la page (F5)
3. L'erreur devrait disparaître !

---

## 💡 Alternative : Interface Graphique

Si vous préférez ne pas utiliser SQL :

1. Dans le menu Laragon → MySQL, cliquez sur **"Créer une base de données"**
2. Nom : **junspro**
3. Encodage : **utf8mb4_unicode_ci**
4. Cliquez **Créer**

C'est tout ! 🎉

