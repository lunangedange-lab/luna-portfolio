# Préparation Déploiement Portfolio L<i class="fas fa-moon"></i>una

## Checklist Pré-Déploiement

### 1. Fichiers à Vérifier
- [ ] index.php - Page d'accueil
- [ ] about.php - Page à propos
- [ ] projects.php - Projets
- [ ] nature.php - Galerie nature
- [ ] contact.php - Contact
- [ ] config/database.php - Configuration BD
- [ ] assets/css/portfolio.css - Styles
- [ ] assets/js/main.js - JavaScript
- [ ] assets/images/ - Toutes les photos

### 2. Tests Locaux
- [ ] Navigation entre pages fonctionne
- [ ] Filtres projets et nature fonctionnent
- [ ] Formulaire contact envoie bien
- [ ] Bouton WhatsApp fonctionne
- [ ] Photos s'affichent correctement
- [ ] Responsive mobile fonctionne

### 3. Base de Données
- [ ] Exporter la base portfolio
- [ ] Sauvegarder le fichier SQL
- [ ] Noter la structure des tables

### 4. Configuration à Modifier
```php
// Dans config/database.php - remplacer par les infos Hostinger
$host = 'localhost';
$dbname = 'NOUVEAU_NOM_BD';
$username = 'NOUVEAU_UTILISATEUR';
$password = 'NOUVEAU_MOT_DE_PASSE';
```

### 5. Optimisations
- [ ] Compresser les images (si nécessaire)
- [ ] Vérifier les chemins relatifs
- [ ] Ajouter meta-tags SEO
- [ ] Vérifier les liens externes

## Actions Immédiates

### 1. ZIP le Portfolio
```
1. Aller dans c:\xampp\htdocs\portfolio\
2. Sélectionner tous les fichiers (Ctrl+A)
3. Clic droit > Envoyer vers > Dossier compressé
4. Nommer : luna-portfolio.zip
```

### 2. Exporter Base de Données
```
1. Ouvrir phpMyAdmin (http://localhost/phpmyadmin)
2. Sélectionner la base "portfolio"
3. Cliquer sur "Exporter"
4. Quick > Format SQL > Exécuter
5. Sauvegarder : portfolio_database.sql
```

### 3. Préparer Messages de Partage
```
Message WhatsApp :
"Mon portfolio est maintenant en ligne ! 
Découvrez mes projets et compétences ici : 
https://ton-domaine.com/portfolio/"

Message LinkedIn :
"Je suis ravi de partager mon portfolio professionnel L<i class="fas fa-moon"></i>una ! 
Développé avec PHP/MySQL, thème lunaire unique.
Lien : https://ton-domaine.com/portfolio/"
```

## Timeline Déploiement

### Jour 1 : Inscription Hostinger
- Créer compte
- Choisir domaine
- Payer l'hébergement

### Jour 2 : Configuration
- Upload fichiers
- Configurer base de données
- Modifier config/database.php

### Jour 3 : Test et Lancement
- Tester toutes les fonctionnalités
- Activer SSL
- Partager sur réseaux sociaux

## Budget

### Coûts Annuels Estimés
- Hébergement Hostinger : 35.88$
- Domaine (année 2+) : 12$
- Total annuel : ~48$

### Économies Possibles
- Payement annuel : -20%
- Code promo étudiant : -15%
- Hébergeur gratuit (limité) : 0$

## Support Technique

### Si Problèmes
1. **Hostinger Live Chat** : immédiat
2. **Documentation** : https://support.hostinger.com
3. **Communautés** : Stack Overflow, Reddit
4. **Moi** : Je peux aider avec le code

### Problèmes Communs
- **Erreur 500** : Vérifier syntaxe PHP
- **Base de données** : Vérifier identifiants
- **Images** : Vérifier chemins
- **HTTPS** : Forcer redirection
