<?php
// On démarre la session ici pour qu'elle soit disponible sur toutes les pages qui incluent config.php
session_start();

// Paramètres de connexion à la base de données
$host = "localhost";
$dbname = "covoiturage_db";
$username = "root";
$password = ""; // À modifier si votre MySQL a un mot de passe

try {
    // Connexion avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configuration des erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si la base de données n'existe pas, vous pouvez afficher un message d'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage() . "<br>Avez-vous bien importé database.sql ?");
}
?>
