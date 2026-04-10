<?php
require_once 'config/database.php';

// Utiliser directement toutes les images disponibles sans dépendre de la base
$photos = [
    [
        'title' => 'Forêt Mystique',
        'image' => 'nature.jpeg',
        'category' => 'Paysage',
        'date_taken' => '2024-01-15',
        'quote' => 'Dans le silence de la forêt, chaque feuille murmure les secrets de la nature.'
    ],
    [
        'title' => 'Ciel Doré',
        'image' => 'ciel.jpeg',
        'category' => 'Ciel',
        'date_taken' => '2024-02-20',
        'quote' => 'Le ciel peint ses émotions avec les couleurs du couchant, promesse d\'un nouveau matin.'
    ],
    [
        'title' => 'Lumière Divine',
        'image' => 'lumiere.jpeg',
        'category' => 'Lumière',
        'date_taken' => '2024-03-10',
        'quote' => 'La lumière traverse les nuages comme l\'espoir traverse les épreuves, toujours victorieuse.'
    ],
    [
        'title' => 'Art Créatif',
        'image' => 'art.jpeg',
        'category' => 'Art',
        'date_taken' => '2024-01-25',
        'quote' => 'L\'art est la manière dont l\'âme communique ce que les mots ne peuvent exprimer.'
    ],
    [
        'title' => 'Succès Éclatant',
        'image' => 'succes.jpeg',
        'category' => 'Inspiration',
        'date_taken' => '2024-02-15',
        'quote' => 'Le succès n\'est pas la destination, mais le voyage de transformation personnelle.'
    ],
    [
        'title' => 'Âme Profonde',
        'image' => 'ame.jpeg',
        'category' => 'Spiritualité',
        'date_taken' => '2024-03-05',
        'quote' => 'L\'âme réside dans les moments où le temps s\'arrête et la beauté prend le dessus.'
    ],
    [
        'title' => 'Vision Future',
        'image' => 'fac.jpeg',
        'category' => 'Vision',
        'date_taken' => '2024-01-30',
        'quote' => 'La vision est l\'art de voir l\'invisible et de croire à l\'impossible.'
    ],
    [
        'title' => 'Collation Lunaire',
        'image' => 'collation.jpeg',
        'category' => 'Lunaire',
        'date_taken' => '2024-02-25',
        'quote' => 'Sous la lune, chaque moment devient une douce révélation de l\'âme.'
    ]
];

// Compter les photos par catégorie
$photo_count = count($photos);
$categories = [];
foreach ($photos as $photo) {
    $cat = $photo['category'] ?? 'Nature';
    $categories[$cat] = ($categories[$cat] ?? 0) + 1;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L<i class="fas fa-moon"></i>una - Nature</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/portfolio.css">
    <style>
        .nature-hero {
            padding: calc(100px + var(--spacing-2xl)) 0 var(--spacing-2xl);
            text-align: center;
            background: linear-gradient(135deg, var(--primary-moon) 0%, var(--primary-moon-light) 50%, var(--primary-moon-dark) 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .nature-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 70%, rgba(243, 156, 18, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(52, 152, 219, 0.15) 0%, transparent 50%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="stars" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.3)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.3)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.2)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.2)"/><circle cx="90" cy="50" r="0.5" fill="rgba(255,255,255,0.2)"/></pattern></defs><rect width="100" height="100" fill="url(%23stars)"/></svg>');
            opacity: 0.6;
        }
        
        .nature-hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
            position: relative;
            z-index: 1;
        }
        
        .nature-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: var(--spacing-md);
            background: linear-gradient(135deg, var(--moon-gold) 0%, var(--accent-gold) 50%, var(--white) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nature-hero-tagline {
            font-size: 1.25rem;
            margin-bottom: var(--spacing-xl);
            opacity: 0.9;
            font-weight: 300;
            color: var(--moon-silver);
        }
        
        .nature-stats {
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
        
        .nature-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: var(--spacing-lg);
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .nature-card {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid var(--gray-200);
            position: relative;
            cursor: pointer;
        }
        
        .nature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--moon-gold);
        }
        
        .nature-image-container {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }
        
        .nature-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        
        .nature-card:hover .nature-image {
            transform: scale(1.1);
        }
        
        .nature-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(26, 26, 46, 0.9), transparent);
            color: var(--white);
            padding: var(--spacing-lg);
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .nature-card:hover .nature-overlay {
            transform: translateY(0);
        }
        
        .nature-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: var(--spacing-xs);
            color: var(--moon-gold);
        }
        
        .nature-quote {
            font-size: 0.95rem;
            line-height: 1.6;
            font-style: italic;
            margin-bottom: var(--spacing-sm);
            opacity: 0.9;
        }
        
        .nature-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--moon-silver);
        }
        
        .nature-category {
            background: rgba(243, 156, 18, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-weight: 600;
            border: 1px solid var(--moon-gold);
        }
        
        .nature-date {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="leaves" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M20,30 Q25,20 30,30 T40,30" stroke="rgba(243,156,18,0.1)" fill="none" stroke-width="0.5"/><circle cx="50" cy="50" r="2" fill="rgba(243,156,18,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23leaves)"/></svg>');
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
        
        .hidden {
            display: none !important;
        }
        
        @media (max-width: 768px) {
            .nature-hero h1 {
                font-size: 2rem;
            }
            
            .nature-gallery {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: var(--spacing-md);
            }
            
            .nature-stats {
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
                <li><a href="projects.php" class="nav-link">Projets</a></li>
                <li><a href="nature.php" class="nav-link active">Nature</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Nature Hero -->
    <section class="nature-hero">
        <div class="nature-hero-content">
            <h1>Galerie Nature</h1>
            <p class="nature-hero-tagline">Captures de moments inspirants au plus près de la nature</p>
            
            <div class="nature-stats">
                <div class="stat-item">
                    <div class="stat-number"><?= $photo_count ?></div>
                    <div class="stat-label">Photos Capturées</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= count($categories) ?></div>
                    <div class="stat-label">Catégories</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Thèmes Uniques</div>
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
                        <i class="fas fa-th"></i> Toutes
                    </button>
                    <button class="filter-btn" data-filter="paysage">
                        <i class="fas fa-mountain"></i> Paysages
                    </button>
                    <button class="filter-btn" data-filter="ciel">
                        <i class="fas fa-cloud-sun"></i> Ciel
                    </button>
                    <button class="filter-btn" data-filter="lumiere">
                        <i class="fas fa-sun"></i> Lumière
                    </button>
                    <button class="filter-btn" data-filter="art">
                        <i class="fas fa-palette"></i> Art
                    </button>
                    <button class="filter-btn" data-filter="inspiration">
                        <i class="fas fa-lightbulb"></i> Inspiration
                    </button>
                    <button class="filter-btn" data-filter="spiritualite">
                        <i class="fas fa-spa"></i> Spiritualité
                    </button>
                    <button class="filter-btn" data-filter="vision">
                        <i class="fas fa-eye"></i> Vision
                    </button>
                    <button class="filter-btn" data-filter="lunaire">
                        <i class="fas fa-moon"></i> Lunaire
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Nature Gallery -->
    <section class="section">
        <div class="container">
            <div class="nature-gallery">
                <?php foreach ($photos as $photo): ?>
                <div class="nature-card fade-in-up" data-category="<?= strtolower($photo['category']) ?>">
                    <div class="nature-image-container">
                        <img src="assets/images/<?= htmlspecialchars($photo['image']) ?>" alt="<?= htmlspecialchars($photo['title']) ?>" class="nature-image">
                        
                        <div class="nature-overlay">
                            <h3 class="nature-title"><?= htmlspecialchars($photo['title']) ?></h3>
                            <p class="nature-quote">"<?= htmlspecialchars($photo['quote']) ?>"</p>
                            <div class="nature-meta">
                                <span class="nature-category"><?= htmlspecialchars($photo['category']) ?></span>
                                <span class="nature-date">
                                    <i class="fas fa-calendar"></i>
                                    <?= date('d/m/Y', strtotime($photo['date_taken'])) ?>
                                </span>
                            </div>
                        </div>
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
                La nature ne fait jamais de bruit inutile. Elle est silencieuse, patiente et sage.
                Elle nous enseigne que la véritable beauté réside dans la simplicité et l'harmonie.
            </div>
            <div class="quote-author">
                - L<span style="color: var(--moon-gold);"><i class="fas fa-moon"></i></span>una
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
    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const natureCards = document.querySelectorAll('.nature-card');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const filter = this.dataset.filter;
                    
                    natureCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                            setTimeout(() => card.style.opacity = '1', 10);
                        } else {
                            const category = card.dataset.category;
                            if (category === filter) {
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
    </script>
</body>
</html>
