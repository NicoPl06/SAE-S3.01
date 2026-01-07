<?php
session_start();

// Si la variable de session 'admin_user' n'existe pas, on redirige vers le login
if (!isset($_SESSION['admin_user'])) {
    header('Location: login.php');
    exit();
}

// Fonction pour se connecter à la base de données (utilisée par toutes les pages admin)
function getPDO() {
    try {
        // On remonte d'un cran pour trouver le fichier data.sqlite
        $db_path = __DIR__ . '/../back/data.sqlite';
        return new PDO("sqlite:$db_path", null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die("Erreur de connexion BDD : " . $e->getMessage());
    }
}
?>