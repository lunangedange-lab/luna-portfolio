<?php
// Configuration Hostinger pour Portfolio L<i class="fas fa-moon"></i>una
// À utiliser après inscription Hostinger

// Remplacer ces valeurs par celles de Hostinger
$host = 'localhost';
$dbname = 'u123456789_portfolio'; // Hostinger ajoute préfixe u123456789_
$username = 'u123456789_luna_user'; // Hostinger ajoute préfixe u123456789_
$password = 'MOT_DE_PASSE_SECURISE_123'; // Ton mot de passe Hostinger

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>
