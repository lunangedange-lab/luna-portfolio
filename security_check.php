<?php
// Fichier de sécurité à inclure sur toutes les pages
require_once 'config/security.php';

// Vérification de l'environnement
$is_localhost = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1', '::1']);

// Configuration des erreurs selon l'environnement
if ($is_localhost) {
    // En développement : afficher les erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    // En production : cacher les erreurs
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Protection contre les attaques de base
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    if (!$is_localhost) {
        // Rediriger vers HTTPS en production
        $redirect_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $redirect_url);
        exit();
    }
}

// Protection contre l'inclusion de fichiers
if (isset($_GET['file']) || isset($_POST['file'])) {
    die('Access denied');
}

// Protection contre les commandes système
if (isset($_GET['cmd']) || isset($_POST['cmd'])) {
    die('Access denied');
}

// Journalisation des accès suspects
function logSuspiciousActivity($reason) {
    $log_file = __DIR__ . '/logs/suspicious.log';
    $log_dir = dirname($log_file);
    
    if (!file_exists($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
    
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $request_uri = $_SERVER['REQUEST_URI'] ?? 'unknown';
    
    $log_entry = "[$timestamp] SUSPICIOUS: $reason | IP: $ip | URI: $request_uri | UA: $user_agent\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

// Vérifications de sécurité basiques
$suspicious_patterns = [
    '/\.\.\//',           // Directory traversal
    '/<script[^>]*>/',    // Script tags
    '/javascript:/',      // JavaScript protocol
    '/data:/',           // Data protocol
    '/vbscript:/'        // VBScript protocol
];

$request_data = $_SERVER['REQUEST_URI'] . http_build_query($_GET);
foreach ($suspicious_patterns as $pattern) {
    if (preg_match($pattern, $request_data)) {
        logSuspiciousActivity('Suspicious pattern detected: ' . $pattern);
        die('Access denied');
    }
}
?>
