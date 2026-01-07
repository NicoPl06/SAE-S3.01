<?php
require_once 'auth.php';
$pdo = getPDO();

// (Gardez votre code PHP de traitement ici, il ne change pas)
if (isset($_POST['action']) && $_POST['action'] == 'ajouter') {
    $stmt = $pdo->prepare("INSERT INTO articles (title, excerpt, date_pub, image, link) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['titre'], $_POST['resume'], $_POST['date'], $_POST['image'], $_POST['lien']]);
    header('Location: gestion_actus.php'); exit();
}
if (isset($_GET['supprimer'])) {
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$_GET['supprimer']]);
    header('Location: gestion_actus.php'); exit();
}
$articles = $pdo->query("SELECT * FROM articles ORDER BY date_pub DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les actus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-fage { background-color: #4c8c8c !important; }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
        .btn-fage:hover { background-color: #3b7272; color: white; }
        .text-fage { color: #4c8c8c !important; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="index.php">← Retour Dashboard</a>
</nav>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-fage fw-bold">Gestion des Actualités</h2>
    </div>

    <div class="card p-4 mb-5 shadow-sm border-0">
        <h5 class="mb-3 text-secondary">Nouvel Article</h5>
        <form method="post">
            <input type="hidden" name="action" value="ajouter">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="titre" class="form-control" placeholder="Titre de l'article" required>
                </div>
                <div class="col-md-6">
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <textarea name="resume" class="form-control" placeholder="Court résumé..." rows="2" required></textarea>
                </div>
                <div class="col-md-6">
                    <input type="text" name="image" class="form-control" value="images/Actualites/" placeholder="Chemin image">
                </div>
                <div class="col-md-6">
                    <input type="url" name="lien" class="form-control" placeholder="Lien vers l'article" required>
                </div>
            </div>
            <button type="submit" class="btn btn-fage mt-3 px-4">Publier l'article</button>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Date</th><th>Titre</th><th class="text-end">Action</th></tr></thead>
            <tbody>
            <?php foreach($articles as $art): ?>
                <tr>
                    <td class="text-muted"><?= $art['date_pub'] ?></td>
                    <td class="fw-bold"><?= htmlspecialchars($art['title']) ?></td>
                    <td class="text-end">
                        <a href="?supprimer=<?= $art['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>