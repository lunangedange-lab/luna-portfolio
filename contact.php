<?php
require_once 'config/database.php';
require_once 'config/security.php';

// Traitement du formulaire de contact
$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Vérification CSRF
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $error_message = 'Erreur de sécurité. Veuillez réessayer.';
    }
    // Vérification rate limiting
    elseif (!checkContactRateLimit()) {
        $error_message = 'Trop de tentatives. Veuillez réessayer dans une heure.';
    }
    // Vérification anti-bot
    elseif (!verifyHuman()) {
        $error_message = 'Accès non autorisé.';
    }
    else {
        // Validation et nettoyage des entrées
        $name = sanitizeInput($_POST['name'] ?? '');
        $email = sanitizeInput($_POST['email'] ?? '');
        $subject = sanitizeInput($_POST['subject'] ?? '');
        $message = sanitizeInput($_POST['message'] ?? '');
        
        // Validation des champs
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            $error_message = 'Tous les champs sont obligatoires.';
        }
        elseif (!validateEmail($email)) {
            $error_message = 'Veuillez entrer une adresse email valide.';
        }
        elseif (strlen($name) < 2 || strlen($name) > 100) {
            $error_message = 'Le nom doit contenir entre 2 et 100 caractères.';
        }
        elseif (strlen($subject) < 5 || strlen($subject) > 200) {
            $error_message = 'Le sujet doit contenir entre 5 et 200 caractères.';
        }
        elseif (strlen($message) < 10 || strlen($message) > 5000) {
            $error_message = 'Le message doit contenir entre 10 et 5000 caractères.';
        }
        else {
            try {
                // Insertion sécurisée dans la base de données
                $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt->execute([$name, $email, $subject, $message]);
                
                // Journalisation de la tentative
                logContactAttempt($name, $email, true);
                
                $message_sent = true;
                
            } catch(PDOException $e) {
                // Journalisation de l'erreur
                logContactAttempt($name, $email, false);
                $error_message = 'Une erreur est survenue. Veuillez réessayer plus tard.';
            }
        }
    }
}

// Générer le token CSRF
$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L<i class="fas fa-moon"></i>una - Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/portfolio.css">
    <style>
        .contact-hero {
            padding: calc(100px + var(--spacing-2xl)) 0 var(--spacing-2xl);
            text-align: center;
            background: linear-gradient(135deg, var(--primary-moon) 0%, var(--primary-moon-light) 50%, var(--primary-moon-dark) 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .contact-hero::before {
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
        
        .contact-hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
            position: relative;
            z-index: 1;
        }
        
        .contact-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: var(--spacing-md);
            background: linear-gradient(135deg, var(--moon-gold) 0%, var(--accent-gold) 50%, var(--white) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .contact-hero-tagline {
            font-size: 1.25rem;
            margin-bottom: var(--spacing-xl);
            opacity: 0.9;
            font-weight: 300;
            color: var(--moon-silver);
        }
        
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: var(--spacing-2xl);
            align-items: start;
        }
        
        .contact-info {
            background: var(--white);
            padding: var(--spacing-xl);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--gray-200);
            position: sticky;
            top: calc(100px + var(--spacing-lg));
        }
        
        .contact-form {
            background: var(--white);
            padding: var(--spacing-xl);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            border: 2px solid var(--gray-200);
        }
        
        .contact-info h2, .contact-form h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-moon);
            margin-bottom: var(--spacing-lg);
            text-align: center;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            padding: var(--spacing-md);
            background: rgba(243, 156, 18, 0.05);
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }
        
        .contact-item:hover {
            background: rgba(243, 156, 18, 0.1);
            transform: translateX(4px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--moon-gold), var(--accent-gold));
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        
        .contact-details h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-moon);
            margin-bottom: var(--spacing-xs);
        }
        
        .contact-details p {
            color: var(--gray-700);
            font-size: 0.95rem;
        }
        
        .form-group {
            margin-bottom: var(--spacing-lg);
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: var(--spacing-sm);
            font-size: 0.95rem;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: var(--spacing-md);
            border: 2px solid var(--gray-300);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--moon-gold);
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .submit-btn {
            width: 100%;
            padding: var(--spacing-md) var(--spacing-xl);
            background: linear-gradient(135deg, var(--moon-gold), var(--accent-gold));
            color: var(--primary-moon-dark);
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
        }
        
        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .success-message {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            margin-bottom: var(--spacing-lg);
            text-align: center;
            font-weight: 600;
            border: 2px solid #20c997;
        }
        
        .error-message {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: var(--white);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            margin-bottom: var(--spacing-lg);
            text-align: center;
            font-weight: 600;
            border: 2px solid #c82333;
        }
        
        .social-links-contact {
            display: flex;
            justify-content: center;
            gap: var(--spacing-md);
            margin-top: var(--spacing-xl);
        }
        
        .social-link-contact {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--moon-gold), var(--accent-gold));
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-moon-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.25rem;
        }
        
        .social-link-contact:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
        }
        
        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2rem;
            }
            
            .contact-container {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
            }
            
            .contact-info,
            .contact-form {
                padding: var(--spacing-lg);
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
                <li><a href="nature.php" class="nav-link">Nature</a></li>
                <li><a href="contact.php" class="nav-link active">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contact Hero -->
    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>Contact</h1>
            <p class="contact-hero-tagline">Discutons de votre projet ou de vos idées. Je serais ravi de collaborer avec vous.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="contact-container">
                <!-- Contact Info -->
                <div class="contact-info fade-in-up">
                    <h2>Restons en Contact</h2>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>lunangedange@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Téléphone</h3>
                            <p>+243 979 294 221</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Localisation</h3>
                            <p>Kinshasa, RD Congo</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Disponibilité</h3>
                            <p>Lun - Ven: 9h - 18h</p>
                        </div>
                    </div>
                    
                    <div class="social-links-contact">
                        <a href="https://www.facebook.com/share/1UqC4YAKZL/?mibextid=wwXIfr" class="social-link-contact" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/mangomaange?igsh=NHo4NnZhNzYxZGMz&utm_source=qr" class="social-link-contact" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.tiktok.com/@angemangomaa" class="social-link-contact" target="_blank">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://github.com" class="social-link-contact" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://linkedin.com" class="social-link-contact" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="contact-form fade-in-up">
                    <h2>Envoyez un Message</h2>
                    
                    <?php if ($message_sent): ?>
                        <div class="success-message">
                            <i class="fas fa-check-circle"></i>
                            Votre message a été envoyé avec succès ! Je vous répondrai dans les plus brefs délais.
                        </div>
                    <?php elseif ($error_message): ?>
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        <div class="form-group">
                            <label for="name">Nom Complet *</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Adresse Email *</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Sujet *</label>
                            <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer le Message
                        </button>
                        
                        <div style="text-align: center; margin-top: var(--spacing-lg);">
                            <p style="color: var(--gray-600); font-size: 0.9rem; margin-bottom: var(--spacing-sm);">OU</p>
                            <button type="button" class="submit-btn" onclick="sendToWhatsApp()" style="background: linear-gradient(135deg, #25D366, #128C7E);">
                                <i class="fab fa-whatsapp"></i>
                                Envoyer via WhatsApp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="social-links">
                <a href="https://www.facebook.com/share/1UqC4YAKZL/?mibextid=wwXIfr" class="social-link" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/mangomaange?igsh=NHo4NnZhNzYxZGMz&utm_source=qr" class="social-link" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.tiktok.com/@angemangomaa" class="social-link" target="_blank">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="https://github.com" class="social-link" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://linkedin.com" class="social-link" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="mailto:lunangedange@gmail.com" class="social-link">
                    <i class="fas fa-envelope"></i>
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
        function sendToWhatsApp() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            if (!name || !email || !subject || !message) {
                alert('Veuillez remplir tous les champs avant d\'envoyer via WhatsApp.');
                return;
            }
            
            const whatsappMessage = `*Nouveau message de contact depuis le portfolio L${String.fromCharCode(0x1F319)}una*\n\n` +
                `*Nom:* ${name}\n` +
                `*Email:* ${email}\n` +
                `*Sujet:* ${subject}\n\n` +
                `*Message:*\n${message}`;
            
            const whatsappUrl = `https://wa.me/243979294221?text=${encodeURIComponent(whatsappMessage)}`;
            window.open(whatsappUrl, '_blank');
        }
    </script>
</body>
</html>
