<?php
require_once 'config/database.php';

// Récupérer toutes les sections À propos
$stmt = $pdo->query("SELECT section_name, content FROM about ORDER BY id");
$about_sections = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Récupérer les compétences
$stmt = $pdo->query("SELECT * FROM skills ORDER BY category, name");
$skills = $stmt->fetchAll();

// Grouper les compétences par catégorie
$skills_by_category = [];
foreach ($skills as $skill) {
    $skills_by_category[$skill['category']][] = $skill;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L<i class="fas fa-moon"></i>una - À Propos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/portfolio.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-brand">
                <img src="assets/images/icon.jpeg" alt="L Icon" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                L<i class="fas fa-moon" style="font-size: 1.2rem; margin: 0 2px; color: var(--moon-gold);"></i>una
            </a>
            <button class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="nav-link">Accueil</a></li>
                <li><a href="about.php" class="nav-link active">À propos</a></li>
                <li><a href="projects.php" class="nav-link">Projets</a></li>
                <li><a href="nature.php" class="nav-link">Nature</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="assets/images/collation.jpeg" alt="Photo de profil L" class="hero-avatar">
            <h1>À Propos de Moi</h1>
            <p class="hero-tagline">Développeur passionné par la nature et l'innovation</p>
            <div class="hero-cta">
                <a href="#story" class="btn btn-primary">
                    <i class="fas fa-book-open"></i>
                    Mon Histoire
                </a>
                <a href="#skills" class="btn btn-secondary">
                    <i class="fas fa-code"></i>
                    Mes Compétences
                </a>
            </div>
        </div>
    </section>

    <!-- Mon Histoire -->
    <section class="section" id="story">
        <div class="container">
            <h2 class="section-title fade-in-up">Mon Parcours</h2>
            <p class="section-subtitle fade-in-up">Découvrez mon histoire et ma passion</p>
            
            <div class="about-content fade-in-up">
                <div class="about-text">
                    <h3 style="color: var(--moon-gold); margin-bottom: var(--spacing-md); font-size: 1.5rem;">
                        <i class="fas fa-star"></i> Présentation
                    </h3>
                    <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: var(--spacing-lg);">
                        Qui suis-je en vrai
                    </p>
                    
                    <h3 style="color: var(--moon-gold); margin-bottom: var(--spacing-md); font-size: 1.5rem;">
                        <i class="fas fa-heart"></i> Ma Philosophie
                    </h3>
                    <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: var(--spacing-lg);">
                        Le corps pourrait bien être qu'une apparence, la réalité c'est l'âme.
                    </p>
                    <p style="font-size: 1.05rem; line-height: 1.7; margin-bottom: var(--spacing-lg); color: var(--gray-700);">
                        Je crée des solutions qui ont une âme et qui créent une véritable connexion avec l'utilisateur.
                    </p>
                    
                    <div style="margin-top: var(--spacing-xl); padding: var(--spacing-lg); background: rgba(243, 156, 18, 0.1); border-radius: var(--border-radius-lg); border: 2px solid var(--moon-gold);">
                        <h4 style="color: var(--moon-gold); margin-bottom: var(--spacing-sm); font-size: 1.3rem;">
                            <i class="fas fa-quote-left"></i> Mon Engagement
                        </h4>
                        <p style="font-style: italic; color: var(--gray-700); font-size: 1.05rem;">
                            "Créer des expériences qui marquent durablement ceux qui les utilisent."
                        </p>
                        <p style="margin-top: var(--spacing-sm); text-align: right; color: var(--moon-gold); font-weight: 600;">
                            - L<span style="color: var(--moon-gold);"><i class="fas fa-moon"></i></span>una
                        </p>
                    </div>
                </div>
                <div>
                    <img src="assets/images/ame.jpeg" alt="À propos L" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Compétences -->
    <section class="section" id="skills" style="background: var(--gray-50);">
        <div class="container">
            <h2 class="section-title fade-in-up">Mes Compétences</h2>
            <p class="section-subtitle fade-in-up">Technologies et outils que je maîtrise</p>
            
            <div class="skills-grid fade-in-up">
                <?php 
                // Catégories personnalisées pour L Luna
                $skills_data = [
                    'backend' => [
                        ['name' => 'Base de Données', 'level' => 95, 'icon' => 'fas fa-database'],
                        ['name' => 'PHP/MySQL', 'level' => 90, 'icon' => 'fab fa-php'],
                        ['name' => 'C Programming', 'level' => 75, 'icon' => 'fas fa-code'],
                        ['name' => 'Linux/Ubuntu', 'level' => 85, 'icon' => 'fab fa-linux']
                    ],
                    'frontend' => [
                        ['name' => 'HTML5', 'level' => 95, 'icon' => 'fab fa-html5'],
                        ['name' => 'CSS3', 'level' => 90, 'icon' => 'fab fa-css3-alt'],
                        ['name' => 'JavaScript', 'level' => 80, 'icon' => 'fab fa-js']
                    ],
                    'business' => [
                        ['name' => 'Gestion de Stock', 'level' => 90, 'icon' => 'fas fa-warehouse'],
                        ['name' => 'Événementiel', 'level' => 80, 'icon' => 'fas fa-calendar-alt']
                    ],
                    'creative' => [
                        ['name' => 'Photographie', 'level' => 85, 'icon' => 'fas fa-camera'],
                        ['name' => 'Data Analyse Excel', 'level' => 90, 'icon' => 'fas fa-chart-pie']
                    ]
                ];
                
                $category_titles = [
                    'backend' => 'Backend',
                    'frontend' => 'Frontend', 
                    'business' => 'Business',
                    'creative' => 'Créatif'
                ];
                
                foreach ($skills_data as $category => $category_skills): ?>
                <div class="skill-category">
                    <h3 class="category-title" style="color: var(--moon-gold); margin-bottom: var(--spacing-lg); text-align: center;">
                        <?= $category_titles[$category] ?>
                    </h3>
                    <div class="skills-list">
                        <?php foreach ($category_skills as $skill): ?>
                        <div class="skill-item">
                            <div class="skill-header">
                                <i class="<?= $skill['icon'] ?>"></i>
                                <span class="skill-name"><?= htmlspecialchars($skill['name']) ?></span>
                                <span class="skill-percentage"><?= $skill['level'] ?>%</span>
                            </div>
                            <div class="skill-progress">
                                <div class="skill-progress-bar" style="width: <?= $skill['level'] ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in-up">Mon Parcours</h2>
            <p class="section-subtitle fade-in-up">Les moments clés de mon voyage</p>
            
            <div class="timeline fade-in-up">
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Licence Informatique</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2020 - 2023</p>
                        <p>Licence en informatique avec spécialisation en développement web et bases de données. Formation solide en PHP, JavaScript et systèmes d'information.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fab fa-linux"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Maîtrise Linux/Ubuntu</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2021 - Présent</p>
                        <p>Apprentissage autonome de la programmation sur Ubuntu, développement de scripts en ligne de commande et gestion système avancée.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Programmation Système C</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2022</p>
                        <p>Développement d'un système complet de gestion de stocks en C avec interface terminal sur Ubuntu, combinant performance et efficacité.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Formation Photographie</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2022 - 2023</p>
                        <p>Formation professionnelle en photographie avec Events Studio, maîtrise des techniques de prise de vue et de traitement d'image.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Secrétaire Events Studio</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2023</p>
                        <p>Gestion événementielle et développement de systèmes pour Events Studio, avec création d'interfaces de planification et de suivi.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Expertise Data Analyse</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2023 - Présent</p>
                        <p>Maîtrise avancée d'Excel avec projets complexes d'analyse de données, tableaux croisés dynamiques et visualisations personnalisées.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Master UPN</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2024 - Présent</p>
                        <p>Poursuite du Master en informatique à l'UPN, spécialisation en développement web et intelligence artificielle.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 style="color: var(--moon-gold);">Portfolio L<span style="color: var(--moon-gold);"><i class="fas fa-moon"></i></span>una</h3>
                        <p style="color: var(--gray-600); font-size: 0.9rem;">2024 - Présent</p>
                        <p>Création du portfolio personnel avec thème lunaire, intégrant toutes mes compétences et passions pour le code et la nature.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="social-links">
                <a href="https://github.com" class="social-link" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://linkedin.com" class="social-link" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="mailto:contact@example.com" class="social-link">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://twitter.com" class="social-link" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            <p>&copy; <?= date('Y') ?> L<i class="fas fa-moon"></i>una - Portfolio Développeur & Nature. Tous droits réservés.</p>
            <p style="margin-top: var(--spacing-sm); opacity: 0.8; font-size: 0.9rem;">
                Créé avec <i class="fas fa-heart" style="color: var(--accent-red);"></i> et beaucoup de café sous la lune
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>
