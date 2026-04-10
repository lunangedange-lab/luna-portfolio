# Guide GitHub Pages - Portfolio L<i class="fas fa-moon"></i>una GRATUIT

## Pourquoi GitHub Pages ?

- **100% GRATUIT** pour toujours
- **HTTPS** automatique
- **Personnalisé** : ton-nom.github.io/portfolio
- **Fiable** : hébergé par GitHub
- **Version statique** : pas de base de données

## Étape 1 : Créer un Compte GitHub

1. **Aller sur** https://github.com
2. **Sign up** gratuit
3. **Vérifier** ton email
4. **Créer un profil** avec ta photo

## Étape 2 : Créer un Repository

1. **Click** sur "+" > "New repository"
2. **Nom** : `portfolio-luna`
3. **Description** : "Portfolio personnel L<i class='fas fa-moon'></i>una"
4. **Public** : Cocher "Public"
5. **Add README** : Cocher
6. **Create repository**

## Étape 3 : Préparer les Fichiers Statiques

### Fichiers à convertir :
```
portfolio/
- index.html (créé)
- about.html (à créer)
- projects.html (à créer)
- nature.html (à créer)
- contact.html (à créer)
- assets/
  - css/portfolio.css
  - js/main.js
  - images/ (toutes les photos)
```

### Modifications nécessaires :
- **Supprimer** tout le code PHP
- **Convertir** les .php en .html
- **Simplifier** le formulaire de contact
- **Mettre** les compétences en dur

## Étape 4 : Upload sur GitHub

### Méthode Web (plus facile) :
1. **Ouvrir** ton repository `portfolio-luna`
2. **Click** sur "Add file" > "Upload files"
3. **Drag & drop** tous tes fichiers
4. **Commit changes** : "Initial portfolio upload"
5. **Commit new file**

## Étape 5 : Activer GitHub Pages

1. **Settings** (onglet dans ton repo)
2. **Pages** (menu gauche)
3. **Source** : "Deploy from a branch"
4. **Branch** : "main" > "root"
5. **Save**

## Étape 6 : Attendre le Déploiement

1. **Patienter** 2-5 minutes
2. **Check** la section "Pages" pour l'URL
3. **URL finale** : `https://ton-nom.github.io/portfolio-luna`

## Étape 7 : Personnaliser le Domaine (Optionnel)

### Domaine gratuit :
- **GitHub Pages** : `ton-nom.github.io/portfolio-luna`

### Domaine personnalisé :
- **Freenom** : domaines gratuits (.tk, .ml, .ga, .cf)
- **Configurer** DNS vers GitHub Pages

## Avantages/Inconvénients

### Avantages :
- **100% GRATUIT** 
- **HTTPS** inclus
- **Fiabilité** GitHub
- **Git versioning**
- **Personnalisation**

### Inconvénients :
- **Pas de PHP** (formulaire statique)
- **Pas de base de données**
- **Mise à jour** manuelle

## Alternative : Formulaire Externe

### Pour remplacer le formulaire PHP :
```html
<!-- Remplacer le formulaire PHP par -->
<form action="https://formspree.io/f/ton-id" method="POST">
    <!-- même HTML, mais envoi via Formspree -->
</form>
```

### Formspree (gratuit) :
1. **Inscription** : https://formspree.io
2. **Créer un formulaire**
3. **Copier l'URL** dans ton HTML
4. **Recevoir** les emails directement

## Timeline Déploiement Gratuit

### Jour 1 : Préparation
- [ ] Convertir tous les .php en .html
- [ ] Simplifier le formulaire de contact
- [ ] Préparer les images

### Jour 2 : Upload
- [ ] Créer compte GitHub
- [ ] Uploader tous les fichiers
- [ ] Activer GitHub Pages

### Jour 3 : Finalisation
- [ ] Tester toutes les pages
- [ ] Configurer Formspree
- [ ] Partager l'URL

## Coût Total

### GitHub Pages : **0$**
### Formspree (gratuit) : **0$**
### Domaine personnalisé : **0$** (optionnel)

## URL Finale

```
https://ton-nom.github.io/portfolio-luna
```

## Support

- **GitHub Docs** : https://docs.github.com
- **Formspree Docs** : https://formspree.io/docs
- **Communauté** : GitHub Discussions
