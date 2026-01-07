<?php
require_once 'auth.php';

// Sécurité : Seul un admin principal devrait pouvoir sauvegarder
// (Si vous voulez que les responsables puissent aussi le faire, retirez ce bloc)
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php?msg=Accès refusé&type=danger");
    exit();
}

// Chemins des fichiers
$source = __DIR__ . '/../back/data.sqlite';
$dossier_backup = __DIR__ . '/../back/backups/';
$nom_fichier = 'backup_' . date('Y-m-d_H-i-s') . '.sqlite';
$destination = $dossier_backup . $nom_fichier;

// Créer le dossier 'backups' s'il n'existe pas
if (!is_dir($dossier_backup)) {
    mkdir($dossier_backup, 0777, true);
}

// Copie du fichier
if (copy($source, $destination)) {
    $msg = "Sauvegarde réussie : " . $nom_fichier;
    $type = "success";
} else {
    $msg = "Erreur lors de la copie de la base de données.";
    $type = "danger";
}

// Retour au tableau de bord
header("Location: index.php?msg=" . urlencode($msg) . "&type=" . $type);
exit();
?>