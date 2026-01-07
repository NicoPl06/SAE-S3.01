<?php
require_once 'auth.php';
$pdo = getPDO();

// --- AJOUT PARTENAIRE ---
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $stmt = $pdo->prepare("INSERT INTO partenaires (nom, logo, site_web) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nom'], $_POST['logo'], $_POST['site']]);
    header('Location: partenaires.php'); exit();
}

// --- SUPPRESSION ---
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM partenaires WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: partenaires.php'); exit();
}

$parts = $pdo->query("SELECT * FROM partenaires")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Partenaires</title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-fage { background-color: #4c8c8c !important; }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
        .btn-fage:hover { background-color: #3b7272; color: white; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="index.php">← Retour Dashboard</a>
</nav>

<div class="container pb-5">
    <h2 class="text-secondary fw-bold mb-4">Gestion des Partenaires</h2>

    <div class="card p-4 mb-4 shadow-sm border-0">
        <h5 class="mb-3">Nouveau Partenaire</h5>
        <form method="post" class="row g-3">
            <input type="hidden" name="action" value="add">
            <div class="col-md-4">
                <input type="text" name="nom" class="form-control" placeholder="Nom de l'organisme" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="logo" class="form-control" value="images/Partenaires/" placeholder="Chemin logo">
            </div>
            <div class="col-md-4">
                <input type="url" name="site" class="form-control" placeholder="Site web (https://...)">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-fage">Ajouter</button>
            </div>
        </form>
    </div>

    <div class="row g-4">
        <?php foreach($parts as $p): ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0 text-center p-3">
                    <div style="height: 80px; display: flex; align-items: center; justify-content: center;">
                        <img src="../<?= htmlspecialchars($p['logo']) ?>" alt="Logo" style="max-height: 60px; max-width: 100%;" onerror="this.src='https://via.placeholder.com/150?text=Logo'">
                    </div>
                    <h5 class="card-title mt-2"><?= htmlspecialchars($p['nom']) ?></h5>
                    <div class="mt-auto pt-3">
                        <a href="<?= htmlspecialchars($p['site_web']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Voir site</a>
                        <a href="?delete=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>