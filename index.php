<?php
require_once 'config/database.php';

// Récupérer les projets featured
$stmt = $pdo->query("SELECT * FROM projects WHERE featured = TRUE ORDER BY created_at DESC LIMIT 3");
$featured_projects = $stmt->fetchAll();

// Récupérer les photos nature récentes
$stmt = $pdo->query("SELECT * FROM nature_photos ORDER BY created_at DESC LIMIT 3");
$recent_photos = $stmt->fetchAll();

// Récupérer les informations À propos
$stmt = $pdo->query("SELECT content FROM about WHERE section_name = 'presentation'");
$about_content = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L<i class="fas fa-moon"></i>una - Portfolio Développeur & Nature</title>
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
                <li><a href="index.php" class="nav-link active">Accueil</a></li>
                <li><a href="about.php" class="nav-link">À propos</a></li>
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
            <h1>Développeur Passionné</h1>
            <p class="hero-tagline">De la nature au code, je crée des expériences numériques qui inspirent</p>
            <div class="hero-cta">
                <a href="projects.php" class="btn btn-primary">
                    <i class="fas fa-code"></i>
                    Voir mes projets
                </a>
                <a href="nature.php" class="btn btn-secondary">
                    <i class="fas fa-camera"></i>
                    Galerie nature
                </a>
            </div>
        </div>
    </section>

    <!-- Section Projets en Avant -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in-up">Projets Phares</h2>
            <p class="section-subtitle fade-in-up">Découvrez mes réalisations récentes en développement web</p>
            
            <div class="projects-grid">
                <?php foreach ($featured_projects as $project): ?>
                <div class="card project-card fade-in-up">
                    <div class="project-symbol">
                        <?php if ($project['title'] === 'G-Résilience Dashboard'): ?>
                            <i class="fas fa-chart-line" style="font-size: 4rem; color: var(--moon-gold);"></i>
                        <?php elseif ($project['title'] === 'SalaireMobile Dashboard'): ?>
                            <i class="fas fa-mobile-alt" style="font-size: 4rem; color: var(--moon-gold);"></i>
                        <?php elseif (strpos($project['title'], 'Gestion de Stock') !== false): ?>
                            <i class="fas fa-warehouse" style="font-size: 4rem; color: var(--moon-gold);"></i>
                        <?php elseif (strpos($project['title'], 'Système Événementiel') !== false): ?>
                            <i class="fas fa-calendar-alt" style="font-size: 4rem; color: var(--moon-gold);"></i>
                        <?php elseif (strpos($project['title'], 'Data Analyse') !== false): ?>
                            <i class="fas fa-chart-pie" style="font-size: 4rem; color: var(--moon-gold);"></i>
                        <?php else: ?>
                            <i class="fas fa-laptop-code" style="font-size: 4rem; color: var(--moon-gold);"></i>
                        <?php endif; ?>
                    </div>
                    <h3 class="project-title"><?= htmlspecialchars($project['title']) ?></h3>
                    <p class="project-description"><?= htmlspecialchars($project['description']) ?></p>
                    <div class="project-tech">
                        <?php 
                        $techs = explode(', ', $project['tech']);
                        foreach ($techs as $tech): 
                        ?>
                            <span class="tech-badge"><?= htmlspecialchars($tech) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="project-links">
                        <?php if ($project['link_demo']): ?>
                            <a href="<?= htmlspecialchars($project['link_demo']) ?>" class="project-link" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                Démo
                            </a>
                        <?php endif; ?>
                        <?php if ($project['link_github']): ?>
                            <a href="<?= htmlspecialchars($project['link_github']) ?>" class="project-link" target="_blank">
                                <i class="fab fa-github"></i>
                                GitHub
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div style="text-align: center;">
                <a href="projects.php" class="btn btn-primary">
                    <i class="fas fa-th"></i>
                    Tous les projets
                </a>
            </div>
        </div>
    </section>

    <!-- Section Nature -->
    <section class="section" style="background: var(--gray-50);">
        <div class="container">
            <h2 class="section-title fade-in-up">Galerie Nature</h2>
            <p class="section-subtitle fade-in-up">Captures de moments inspirants au plus près de la nature</p>
            
            <div class="nature-grid">
                <?php foreach ($recent_photos as $photo): ?>
                <div class="nature-card fade-in-up">
                    <?php 
                    $photoMapping = [
                        'Forêt Mystique' => 'nature.jpeg',
                        'Coucher de Soleil' => 'ciel.jpeg', 
                        'Montagne enneigée' => 'lumiere.jpeg'
                    ];
                    $imagePath = isset($photoMapping[$photo['title']]) ? 
                        "assets/images/" . $photoMapping[$photo['title']] : 
                        "assets/images/nature.jpeg";
                    ?>
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($photo['title']) ?>" class="nature-image">
                    <div class="nature-overlay">
                        <h3 class="nature-title"><?= htmlspecialchars($photo['title']) ?></h3>
                        <p class="nature-quote">"<?= htmlspecialchars($photo['quote']) ?>"</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div style="text-align: center;">
                <a href="nature.php" class="btn btn-primary">
                    <i class="fas fa-images"></i>
                    Toutes les photos
                </a>
            </div>
        </div>
    </section>

    <!-- Section À Propos -->
    <section class="section">
        <div class="container">
            <h2 class="section-title fade-in-up">À Propos</h2>
            <p class="section-subtitle fade-in-up">Mon parcours et ma philosophie</p>
            
            <div class="about-content fade-in-up">
                <div class="about-text">
                    <p><?= nl2br(htmlspecialchars($about_content)) ?></p>
                    <p>Je combine ma passion pour le développement web avec mon amour de la nature pour créer des solutions numériques qui sont à la fois fonctionnelles et esthétiquement plaisantes.</p>
                    <p>Chaque projet pour moi est une opportunité d'apprendre, d'innover et de repousser les limites du possible.</p>
                    <div style="margin-top: var(--spacing-lg);">
                        <a href="about.php" class="btn btn-primary">
                            <i class="fas fa-user"></i>
                            En savoir plus
                        </a>
                    </div>
                </div>
                <div>
                    <img src="assets/images/ame.jpeg" alt="À propos Luna" class="about-image">
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
