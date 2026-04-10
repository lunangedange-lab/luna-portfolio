# GitHub Pages - Portfolio L<i class="fas fa-moon"></i>una GRATUIT

## Pourquoi GitHub Pages ?

- **100% GRATUIT** pour toujours
- **HTTPS automatique**
- **Personnalisé** : ton-nom.github.io/portfolio
- **Fiable** : hébergé par GitHub
- **Version statique** : ultra-rapide

## Étapes Déploiement GitHub Pages

### Étape 1 : Préparation des fichiers statiques

1. **Convertir** tous les .php en .html
2. **Supprimer** le code PHP
3. **Simplifier** le formulaire (Formspree)
4. **Mettre** les compétences en dur

### Étape 2 : Créer Repository GitHub

1. **Aller sur** https://github.com
2. **New repository** : `portfolio-luna`
3. **Public** (obligatoire pour Pages)
4. **Initialize with README**

### Étape 3 : Upload des fichiers

1. **Upload files** dans le repository
2. **Commit** "Initial portfolio upload"

### Étape 4 : Activer GitHub Pages

1. **Settings** > Pages
2. **Source** : Deploy from branch
3. **Branch** : main > root
4. **Save**

### Étape 5 : Attendre le déploiement

- **URL** : `https://ton-nom.github.io/portfolio-luna`
- **Délai** : 2-5 minutes

## Formulaire Statique avec Formspree

### Remplacer le formulaire PHP par :
```html
<form action="https://formspree.io/f/ton-id" method="POST">
    <input type="hidden" name="_subject" value="Nouveau message depuis Portfolio L<i class="fas fa-moon"></i>una">
    <div class="form-group">
        <label for="name">Nom Complet *</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Adresse Email *</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="subject">Sujet *</label>
        <input type="text" id="subject" name="subject" required>
    </div>
    <div class="form-group">
        <label for="message">Message *</label>
        <textarea id="message" name="message" required></textarea>
    </div>
    <button type="submit" class="submit-btn">Envoyer</button>
</form>
```

### Configuration Formspree :

1. **Inscription** : https://formspree.io
2. **Create new form**
3. **Copier l'ID** du formulaire
4. **Coller** dans l'action du formulaire

## Avantages GitHub Pages

- **Ultra-rapide** (CDN mondial)
- **HTTPS automatique**
- **Versioning Git**
- **Personnalisation** domaine
- **Analytics** gratuit

## Inconvénients

- **Pas de PHP** (formulaires externes)
- **Pas de base de données**
- **Mises à jour** manuelles

## URL Finale

```
https://ton-nom.github.io/portfolio-luna
```

## Alternative : Netlify

- **URL** : https://ton-nom.netlify.app
- **Formulaires** inclus
- **HTTPS** automatique
- **Performance** excellente
