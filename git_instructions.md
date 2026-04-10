# Instructions Git pour Portfolio L<i class="fas fa-moon"></i>una

## Étape 1 : Remplacer TON-NOM dans la commande

Remplace la commande précédente par :
```bash
git remote add origin https://github.com/VRAI-NOM/portfolio-luna.git
```

Où "VRAI-NOM" est ton nom d'utilisateur GitHub.

## Étape 2 : Push vers GitHub

```bash
git push -u origin master
```

## Étape 3 : Activer GitHub Pages

1. **Aller sur** ton repository GitHub
2. **Settings** (onglet)
3. **Pages** (menu gauche)
4. **Source** : Deploy from a branch
5. **Branch** : master > root
6. **Save**

## Étape 4 : Attendre le déploiement

- **URL finale** : https://TON-NOM.github.io/portfolio-luna
- **Délai** : 2-5 minutes

## Pour version statique (si pas de PHP)

Si tu veux une version statique sans PHP :

1. **Créer** des versions .html de tes fichiers
2. **Ajouter** les fichiers statiques
3. **Push** vers GitHub
4. **Activer** GitHub Pages

## Pour version PHP avec hébergement gratuit

1. **Utiliser** InfinityFree avec Git
2. **Cloner** le dépôt sur l'hébergeur
3. **Configurer** la base de données
4. **Déployer** automatiquement

## Commandes utiles

```bash
# Vérifier le statut
git status

# Ajouter des fichiers
git add .

# Faire un commit
git commit -m "Message descriptif"

# Push vers GitHub
git push

# Pull depuis GitHub
git pull

# Voir les commits
git log --oneline
```
