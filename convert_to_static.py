#!/usr/bin/env python3
"""
Script pour convertir le portfolio PHP en version statique GitHub Pages
Portfolio L<i class="fas fa-moon"></i>una
"""

import os
import re
import shutil

def convert_php_to_html(php_file, html_file):
    """Convertit un fichier PHP en HTML statique"""
    
    # Lire le fichier PHP
    with open(php_file, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Remplacer le code PHP par du contenu statique
    content = re.sub(r'<\?php.*?\?>', '', content, flags=re.DOTALL)
    
    # Remplacer les variables PHP par des valeurs statiques
    replacements = {
        r'\$message_sent\s*=\s*[^;]+;': '$message_sent = false;',
        r'\$error_message\s*=\s*[^;]+;': '$error_message = "";',
        r'<\?=\s*htmlspecialchars\([^)]+\)\s*\?>': '',  # Enlever les echo PHP
        r'<\?=\s*\$[^;]+\s*\?>': '',  # Enlever les variables PHP
    }
    
    for pattern, replacement in replacements.items():
        content = re.sub(pattern, replacement, content)
    
    # Nettoyer le formulaire pour Formspree
    if 'contact.php' in php_file:
        content = content.replace(
            'method="POST" action=""',
            'action="https://formspree.io/f/ton-id" method="POST"'
        )
        content = content.replace(
            '<input type="hidden" name="csrf_token"',
            '<input type="hidden" name="_subject" value="Nouveau message depuis Portfolio L<i class="fas fa-moon"></i>una"'
        )
    
    # Écrire le fichier HTML
    with open(html_file, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print(f"Converti: {php_file} -> {html_file}")

def main():
    """Fonction principale"""
    
    # Fichiers à convertir
    files_to_convert = [
        ('index.php', 'index.html'),
        ('about.php', 'about.html'),
        ('projects.php', 'projects.html'),
        ('nature.php', 'nature.html'),
        ('contact.php', 'contact.html')
    ]
    
    print("Conversion du portfolio PHP en HTML statique...")
    
    for php_file, html_file in files_to_convert:
        if os.path.exists(php_file):
            convert_php_to_html(php_file, html_file)
        else:
            print(f"Fichier {php_file} non trouvé")
    
    # Copier les assets
    if os.path.exists('assets'):
        print("Assets déjà présents")
    else:
        print("Création du dossier assets...")
        os.makedirs('assets', exist_ok=True)
    
    print("\nConversion terminée !")
    print("Prochaines étapes :")
    print("1. Ajouter les fichiers HTML au dépôt Git")
    print("2. Push vers GitHub")
    print("3. Activer GitHub Pages")
    print("4. Configurer Formspree pour le formulaire")

if __name__ == "__main__":
    main()
