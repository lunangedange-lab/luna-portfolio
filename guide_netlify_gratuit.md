# Netlify - Portfolio L<i class="fas fa-moon"></i>una GRATUIT

## Pourquoi Netlify ?

- **100% GRATUIT** pour toujours
- **Formulaires inclus** (pas besoin de PHP)
- **HTTPS automatique**
- **Performance ultra-rapide**
- **Build automatique**
- **Analytics gratuit**

## Étapes Déploiement Netlify

### Étape 1 : Préparation

1. **Convertir** les .php en .html
2. **Supprimer** le code PHP
3. **Ajouter** les formulaires Netlify
4. **Préparer** les assets

### Étape 2 : Déploiement

1. **Aller sur** https://netlify.com
2. **Drag & drop** ton dossier portfolio
3. **Attendre** le déploiement automatique
4. **Obtenir** ton URL gratuite

### Étape 3 : Configuration Formulaires

#### Formulaire Netlify :
```html
<form name="contact" method="POST" data-netlify="true">
    <input type="hidden" name="form-name" value="contact">
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

### Étape 4 : Notifications

1. **Netlify Dashboard** > Forms
2. **Configure** email notifications
3. **Reçois** les messages directement

## URL Finale Netlify

```
https://ton-nom.netlify.app
```

## Avantages Netlify

- **Formulaires inclus** (pas besoin de PHP)
- **Performance CDN** mondial
- **HTTPS automatique**
- **Build automatique**
- **Rollback instantané**
- **Analytics détaillé**

## Coût Total

- **Hébergement** : 0$
- **Formulaires** : 0$ (100 submissions/mois)
- **HTTPS** : 0$
- **Domaine** : 0$ (sous-domaine)

## Recommandation

**Netlify est le meilleur choix si tu veux :**
- Performance ultra-rapide
- Formulaires sans PHP
- Configuration facile
- Analytics gratuit
