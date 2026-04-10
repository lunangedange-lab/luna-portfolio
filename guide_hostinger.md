# Guide Hostinger pour Portfolio L<i class="fas fa-moon"></i>una

## Étape 1 : Inscription

1. **Aller sur** https://www.hostinger.com
2. **Choisir** "Web Hosting" > "Premium Web Hosting"
3. **Sélectionner** 12 mois (meilleur prix)
4. **Domaine gratuit** : luna-portfolio.xyz ou ton-nom.com
5. **Créer un compte** avec ton email

## Étape 2 : Configuration Initiale

1. **Paiement** : Carte bancaire ou PayPal
2. **Vérification** : Email de confirmation
3. **Accès** : hPanel (tableau de bord Hostinger)

## Étape 3 : Préparation des Fichiers

### Fichiers à uploader :
```
portfolio/
- index.php
- about.php
- projects.php
- nature.php
- contact.php
- config/database.php (à modifier)
- assets/
  - css/portfolio.css
  - js/main.js
  - images/ (toutes tes photos)
```

### Actions :
1. **ZIP le dossier** portfolio
2. **Exporte la base** données depuis phpMyAdmin
3. **Note les identifiants** FTP

## Étape 4 : Upload des Fichiers

### Méthode 1 : File Manager (plus facile)
1. **hPanel** > "File Manager"
2. **public_html** > "Upload Files"
3. **Upload** le ZIP portfolio.zip
4. **Extract** le ZIP
5. **Vérifie** que tous les fichiers sont là

### Méthode 2 : FTP (plus avancé)
1. **Télécharge** FileZilla
2. **Connecte** avec identifiants FTP
3. **Upload** tous les fichiers dans public_html

## Étape 5 : Configuration Base de Données

1. **hPanel** > "MySQL Databases"
2. **Créer une base** : "portfolio_luna"
3. **Créer un utilisateur** : "luna_user"
4. **Ajouter l'utilisateur** à la base
5. **Importer** le fichier SQL exporté

## Étape 6 : Configuration PHP

1. **hPanel** > "PHP Configuration"
2. **Version PHP** : 8.0 ou 8.1
3. **Extensions activées** :
   - mysqli
   - pdo_mysql
   - curl
   - json

## Étape 7 : Modification config/database.php

```php
<?php
// Hostinger Database Configuration
$host = 'localhost';
$dbname = 'u123456789_portfolio'; // Hostinger ajoute un préfixe
$username = 'u123456789_luna_user'; // Hostinger ajoute un préfixe
$password = 'ton_mot_de_passe_securise';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}
?>
```

## Étape 8 : Test Final

1. **Accès** : https://ton-domaine.com/portfolio/
2. **Vérifie** toutes les pages
3. **Teste** le formulaire de contact
4. **Teste** le bouton WhatsApp

## Étape 9 : SSL et Sécurité

1. **hPanel** > "SSL"
2. **Activer** SSL gratuit Let's Encrypt
3. **Forcer HTTPS** dans les réglages
4. **Vérifier** le cadenas vert

## Support si Problème

- **Live Chat** Hostinger 24/7
- **Email** : support@hostinger.com
- **Tutoriels** : https://support.hostinger.com

## Coût Estimé

- **Hébergement** : 2.99$/mois (35.88$/an)
- **Domaine** : Gratuit la première année
- **Total première année** : ~35.88$
