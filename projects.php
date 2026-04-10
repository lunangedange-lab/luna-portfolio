<?php
require_once 'config/database.php';

// Récupérer tous les projets
$stmt = $pdo->query("SELECT * FROM projects ORDER BY featured DESC, created_at DESC");
$projects = $stmt->fetchAll();

// Compter les projets par catégorie
$project_count = count($projects);
$featured_count = 0;
foreach ($projects as $project) {
    if ($project['featured']) $featured_count++;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L<i class="fas fa-moon"></i>una - Projets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/portfolio.css">
    <style>
        .project-hero {
            padding: calc(100px + var(--spacing-2xl)) 0 var(--spacing-2xl);
            text-align: center;
            background: linear-gradient(135deg, var(--primary-moon) 0%, var(--primary-moon-light) 50%, var(--primary-moon-dark) 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .project-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 70%, rgba(243, 156, 18, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(52, 152, 219, 0.15) 0%, transparent 50%);
            opacity: 0.6;
        }
        
        .project-hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
            position: relative;
            z-index: 1;
        }
        
        .project-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: var(--spacing-md);
            background: linear-gradient(135deg, var(--moon-gold) 0%, var(--accent-gold) 50%, var(--white) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .project-hero-tagline {
            font-size: 1.25rem;
            margin-bottom: var(--spacing-xl);
            opacity: 0.9;
            font-weight: 300;
            color: var(--moon-silver);
        }
        
        .project-stats {
            display: flex;
            justify-content: center;
            gap: var(--spacing-xl);
            margin: var(--spacing-xl) 0;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            padding: var(--spacing-md);
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius-lg);
            border: 2px solid var(--moon-gold);
            backdrop-filter: blur(10px);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--moon-gold);
            margin-bottom: var(--spacing-xs);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--moon-silver);
            font-weight: 500;
        }
        
        .project-card {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-lg);
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }
        
        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--moon-gold), var(--accent-gold));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .project-card:hover::before {
            transform: scaleX(1);
        }
        
        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--moon-gold);
        }
        
        .project-illustration {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
            border-radius: var(--border-radius);
            margin-bottom: var(--spacing-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--moon-gold);
            position: relative;
            overflow: hidden;
        }
        
        .project-illustration::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(243, 156, 18, 0.1) 0%, transparent 70%);
            animation: pulse 3s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.8; }
        }
        
        .project-badge {
            position: absolute;
            top: var(--spacing-md);
            right: var(--spacing-md);
            background: var(--moon-gold);
            color: var(--primary-moon-dark);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        .project-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-moon);
            margin-bottom: var(--spacing-sm);
            line-height: 1.3;
        }
        
        .project-description {
            color: var(--gray-700);
            margin-bottom: var(--spacing-md);
            line-height: 1.6;
            font-size: 0.95rem;
        }
        
        .project-tech {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-xs);
            margin-bottom: var(--spacing-md);
        }
        
        .tech-badge {
            background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
            color: var(--gray-700);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid var(--gray-300);
            transition: all 0.3s ease;
        }
        
        .tech-badge:hover {
            background: linear-gradient(135deg, var(--moon-gold), var(--accent-gold));
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .project-links {
            display: flex;
            gap: var(--spacing-sm);
            flex-wrap: wrap;
        }
        
        .project-link {
            color: var(--moon-gold);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: rgba(243, 156, 18, 0.1);
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .project-link:hover {
            background: var(--moon-gold);
            color: var(--primary-moon-dark);
            transform: translateX(4px);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        .quote-section {
            background: linear-gradient(135deg, var(--gray-50), var(--white));
            padding: var(--spacing-2xl) 0;
            text-align: center;
            position: relative;
        }
        
        .quote-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="stars" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(243,156,18,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(243,156,18,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(243,156,18,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23stars)"/></svg>');
            opacity: 0.3;
        }
        
        .quote-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
            position: relative;
            z-index: 1;
        }
        
        .quote-text {
            font-size: 1.5rem;
            font-weight: 300;
            color: var(--primary-moon);
            line-height: 1.8;
            margin-bottom: var(--spacing-md);
            font-style: italic;
            position: relative;
        }
        
        .quote-text::before,
        .quote-text::after {
            content: '"';
            font-size: 3rem;
            color: var(--moon-gold);
            position: absolute;
            opacity: 0.3;
        }
        
        .quote-text::before {
            top: -20px;
            left: -40px;
        }
        
        .quote-text::after {
            bottom: -40px;
            right: -40px;
        }
        
        .quote-author {
            font-size: 1.1rem;
            color: var(--moon-gold);
            font-weight: 600;
            margin-top: var(--spacing-md);
        }
        
        .filter-section {
            background: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: var(--spacing-xl);
            border: 2px solid var(--gray-200);
        }
        
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: var(--spacing-md);
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 0.5rem 1.5rem;
            border: 2px solid var(--gray-300);
            background: var(--white);
            color: var(--gray-700);
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: var(--moon-gold);
            color: var(--primary-moon-dark);
            border-color: var(--moon-gold);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        @media (max-width: 768px) {
            .project-hero h1 {
                font-size: 2rem;
            }
            
            .project-stats {
                gap: var(--spacing-md);
            }
            
            .stat-item {
                min-width: 120px;
            }
            
            .quote-text {
                font-size: 1.2rem;
            }
            
            .quote-text::before,
            .quote-text::after {
                font-size: 2rem;
            }
        }
    </style>
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
                <li><a href="about.php" class="nav-link">À propos</a></li>
                <li><a href="projects.php" class="nav-link active">Projets</a></li>
                <li><a href="nature.php" class="nav-link">Nature</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Project Hero -->
    <section class="project-hero">
        <div class="project-hero-content">
            <h1>Mes Projets</h1>
            <p class="project-hero-tagline">Une collection de créations numériques inspirées par la passion et l'innovation</p>
            
            <div class="project-stats">
                <div class="stat-item">
                    <div class="stat-number"><?= $project_count ?></div>
                    <div class="stat-label">Projets Créés</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= $featured_count ?></div>
                    <div class="stat-label">Projets Phares</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Passion</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="section">
        <div class="container">
            <div class="filter-section">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">
                        <i class="fas fa-th"></i> Tous
                    </button>
                    <button class="filter-btn" data-filter="featured">
                        <i class="fas fa-star"></i> Phares
                    </button>
                    <button class="filter-btn" data-filter="web">
                        <i class="fas fa-globe"></i> Web
                    </button>
                    <button class="filter-btn" data-filter="dashboard">
                        <i class="fas fa-chart-bar"></i> Dashboards
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="section">
        <div class="container">
            <div class="projects-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--spacing-md); max-width: 1200px; margin: 0 auto;">
                <?php 
                $unique_projects = [];
                $seen_titles = [];
                
                foreach ($projects as $project) {
                    $project_key = strtolower(trim($project['title']));
                    if (!in_array($project_key, $seen_titles)) {
                        $seen_titles[] = $project_key;
                        $unique_projects[] = $project;
                    }
                }
                
                foreach ($unique_projects as $project): ?>
                <div class="project-card fade-in-up" style="padding: var(--spacing-md); border-radius: var(--border-radius); background: var(--white); box-shadow: var(--shadow-md); border: 2px solid var(--gray-200); transition: all 0.3s ease; position: relative; overflow: hidden;" data-category="<?= $project['featured'] ? 'featured' : 'web' ?> <?= strpos($project['description'], 'dashboard') !== false ? 'dashboard' : '' ?>">
                    <?php if ($project['featured']): ?>
                        <div class="project-badge" style="position: absolute; top: var(--spacing-sm); right: var(--spacing-sm); background: var(--moon-gold); color: var(--primary-moon-dark); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3); z-index: 2;">
                            <i class="fas fa-star"></i> Phare
                        </div>
                    <?php endif; ?>
                    
                    <div class="project-illustration" style="width: 100%; height: 120px; background: linear-gradient(135deg, var(--gray-100), var(--gray-200)); border-radius: var(--border-radius); margin-bottom: var(--spacing-sm); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: var(--moon-gold); position: relative; overflow: hidden;">
                        <?php
                        $icons = [
                            'G-Résilience' => 'fas fa-chart-line',
                            'SalaireMobile' => 'fas fa-mobile-alt',
                            'Portfolio' => 'fas fa-code',
                            'Gestion de Stock' => 'fas fa-warehouse',
                            'Système Événementiel' => 'fas fa-calendar-alt',
                            'Data Analyse' => 'fas fa-chart-pie',
                            'default' => 'fas fa-laptop-code'
                        ];
                        
                        $icon = 'fas fa-laptop-code';
                        foreach ($icons as $keyword => $projectIcon) {
                            if ($keyword !== 'default' && strpos($project['title'], $keyword) !== false) {
                                $icon = $projectIcon;
                                break;
                            }
                        }
                        ?>
                        <i class="<?= $icon ?>"></i>
                    </div>
                    
                    <h3 class="project-title" style="font-size: 1.1rem; font-weight: 700; color: var(--primary-moon); margin-bottom: var(--spacing-xs); line-height: 1.3;"><?= htmlspecialchars($project['title']) ?></h3>
                    <p class="project-description" style="color: var(--gray-700); margin-bottom: var(--spacing-sm); line-height: 1.5; font-size: 0.85rem;"><?= htmlspecialchars($project['description']) ?></p>
                    
                    <div class="project-tech" style="display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: var(--spacing-sm);">
                        <?php 
                        $techs = explode(', ', $project['tech']);
                        foreach ($techs as $tech): 
                        ?>
                            <span class="tech-badge" style="background: linear-gradient(135deg, var(--gray-100), var(--gray-200)); color: var(--gray-700); padding: 0.2rem 0.5rem; border-radius: 10px; font-size: 0.7rem; font-weight: 500; border: 1px solid var(--gray-300); transition: all 0.3s ease;"><?= htmlspecialchars($tech) ?></span>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="project-links" style="display: flex; gap: var(--spacing-xs); flex-wrap: wrap;">
                        <?php if ($project['link_demo']): ?>
                            <a href="<?= htmlspecialchars($project['link_demo']) ?>" class="project-link" style="color: var(--moon-gold); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; padding: 0.4rem 0.8rem; border-radius: var(--border-radius); background: rgba(243, 156, 18, 0.1); transition: all 0.3s ease; border: 1px solid transparent; font-size: 0.85rem;" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                                Démo
                            </a>
                        <?php endif; ?>
                        <?php if ($project['link_github']): ?>
                            <a href="<?= htmlspecialchars($project['link_github']) ?>" class="project-link" style="color: var(--moon-gold); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; padding: 0.4rem 0.8rem; border-radius: var(--border-radius); background: rgba(243, 156, 18, 0.1); transition: all 0.3s ease; border: 1px solid transparent; font-size: 0.85rem;" target="_blank">
                                <i class="fab fa-github"></i>
                                GitHub
                            </a>
                        <?php endif; ?>
                        <a href="#" class="project-link" style="color: var(--moon-gold); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; padding: 0.4rem 0.8rem; border-radius: var(--border-radius); background: rgba(243, 156, 18, 0.1); transition: all 0.3s ease; border: 1px solid transparent; font-size: 0.85rem;" onclick="showProjectDetails(<?= $project['id'] ?>); return false;">
                            <i class="fas fa-info-circle"></i>
                            Détails
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="quote-section">
        <div class="quote-content">
            <div class="quote-text">
                Le corps pourrait bien être qu'une apparence, la réalité c'est l'âme. Luna nature
            </div>
            <div class="quote-author">- L<span style="color: var(--moon-gold);"><i class="fas fa-moon"></i></span>una</div>
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
    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const filter = this.dataset.filter;
                    
                    projectCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                            setTimeout(() => card.style.opacity = '1', 10);
                        } else {
                            const categories = card.dataset.category.split(' ');
                            if (categories.includes(filter)) {
                                card.style.display = 'block';
                                setTimeout(() => card.style.opacity = '1', 10);
                            } else {
                                card.style.opacity = '0';
                                setTimeout(() => card.style.display = 'none', 300);
                            }
                        }
                    });
                });
            });
        });
        
        function showProjectDetails(projectId) {
            // You can implement a modal or redirect to a detailed project page
            alert('Détails du projet #' + projectId + ' - Fonctionnalité à venir!');
        }
    </script>
</body>
</html>
