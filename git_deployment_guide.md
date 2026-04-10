# Déploiement Git avec Hébergeur Gratuit

## Option 1 : InfinityFree + Git

### Étape 1 : Créer le dépôt Git local
```bash
git init
git add .
git commit -m "Portfolio L<i class='fas fa-moon'></i>una - Version sécurisée"
```

### Étape 2 : Push vers GitHub
```bash
git remote add origin https://github.com/TON-NOM/portfolio-luna.git
git push -u origin master
```

### Étape 3 : Déploiement sur InfinityFree

1. **Inscription** : https://infinityfree.com
2. **Upload** via Git :
   - Aller dans "File Manager"
   - "Git Clone"
   - URL : https://github.com/TON-NOM/portfolio-luna.git
   - Cloner dans le répertoire principal

### Étape 4 : Configuration
1. **Base de données** MySQL
2. **config/database.php** avec identifiants InfinityFree
3. **logs/** répertoire avec permissions 755

## Option 2 : Netlify + Git (Statique)

### Étape 1 : Convertir en statique
```bash
python convert_to_static.py
```

### Étape 2 : Ajouter les fichiers statiques
```bash
git add *.html
git commit -m "Add static HTML version"
git push
```

### Étape 3 : Déploiement Netlify
1. **Aller sur** https://netlify.com
2. **"New site from Git"**
3. **Connecter** GitHub
4. **Choisir** portfolio-luna
5. **Build settings** : Pas de build (statique)
6. **Deploy**

## Option 3 : GitHub Pages (Statique)

### Étape 1 : Activer GitHub Pages
1. **Repository** > Settings > Pages
2. **Source** : Deploy from branch
3. **Branch** : master > root
4. **Save**

### Étape 2 : Attendre le déploiement
- **URL** : https://TON-NOM.github.io/portfolio-luna
- **Délai** : 2-5 minutes

## Commandes Git Utiles

### Pour mettre à jour
```bash
git add .
git commit -m "Mise à jour du portfolio"
git push
```

### Pour voir le statut
```bash
git status
git log --oneline
```

### Pour revenir en arrière
```bash
git reset --hard HEAD~1
```

## Avantages du déploiement Git

- **Versioning** : Historique complet
- **Rollback** : Retour facile aux versions précédentes
- **Collaboration** : Travail en équipe possible
- **Automatisation** : Déploiement automatique
- **Backup** : Code sécurisé sur GitHub

## Workflow Recommandé

1. **Développer** en local
2. **Tester** toutes les fonctionnalités
3. **Commit** avec message clair
4. **Push** vers GitHub
5. **Déployer** automatiquement

## Sécurité

- **Ne jamais commit** les mots de passe
- **Utiliser** .gitignore pour les fichiers sensibles
- **Variables d'environnement** pour la production
- **HTTPS** obligatoire en production
