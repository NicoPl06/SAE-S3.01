<?php
require_once 'auth.php';
$pdo = getPDO();

$poles_dispo = ['Général', 'Solidarité', 'Événementiel', 'Communication', 'Partenariats', 'Bureau'];

// --- AJOUT EVENT ---
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $stmt = $pdo->prepare("INSERT INTO evenements (nom, lieu, date_event, description, pole) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
            $_POST['nom'],
            $_POST['lieu'],
            $_POST['date'],
            $_POST['desc'],
            $_POST['pole'] // Nouveau champ
    ]);
    header('Location: evenements.php'); exit();
}

// --- SUPPRESSION ---
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM evenements WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: evenements.php'); exit();
}

$events = $pdo->query("SELECT * FROM evenements ORDER BY date_event DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Événements</title>
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
    <h2 class="text-secondary fw-bold mb-4">Gestion des Événements</h2>

    <div class="card p-4 mb-4 shadow-sm border-0">
        <h5 class="mb-3">Nouvel Événement</h5>
        <form method="post" class="row g-3">
            <input type="hidden" name="action" value="add">

            <div class="col-md-5">
                <input type="text" name="nom" class="form-control" placeholder="Nom de l'événement" required>
            </div>

            <div class="col-md-3">
                <select name="pole" class="form-select">
                    <?php foreach($poles_dispo as $p): ?>
                        <option value="<?= $p ?>"><?= $p ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <input type="datetime-local" name="date" class="form-control" required>
            </div>

            <div class="col-md-12">
                <input type="text" name="lieu" class="form-control" placeholder="Lieu" required>
            </div>

            <div class="col-md-12">
                <textarea name="desc" class="form-control" placeholder="Détails..." rows="2"></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-fage">Créer l'événement</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>Date</th><th>Pôle</th><th>Événement</th><th>Lieu</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach($events as $e): ?>
                <tr>
                    <td><?= date('d/m H:i', strtotime($e['date_event'])) ?></td>
                    <td><span class="badge bg-info text-dark"><?= htmlspecialchars($e['pole'] ?? 'Général') ?></span></td>
                    <td class="fw-bold"><?= htmlspecialchars($e['nom']) ?></td>
                    <td><?= htmlspecialchars($e['lieu']) ?></td>
                    <td><a href="?delete=<?= $e['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">X</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>