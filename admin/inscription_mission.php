<?php
require_once 'auth.php';
$pdo = getPDO();

if (!isset($_GET['id'])) { header('Location: missions.php'); exit(); }
$mission_id = $_GET['id'];

// Récupérer la mission
$stmt = $pdo->prepare("SELECT * FROM missions WHERE id = ?");
$stmt->execute([$mission_id]);
$mission = $stmt->fetch();

// --- TRAITEMENT : INSCRIRE / DÉSINSCRIRE ---
if (isset($_POST['action']) && $_POST['action'] == 'toggle') {
    $benevole_id = $_POST['benevole_id'];

    // On regarde s'il est déjà inscrit
    $check = $pdo->prepare("SELECT * FROM inscriptions WHERE mission_id = ? AND benevole_id = ?");
    $check->execute([$mission_id, $benevole_id]);

    if ($check->fetch()) {
        // Déjà inscrit -> On supprime
        $del = $pdo->prepare("DELETE FROM inscriptions WHERE mission_id = ? AND benevole_id = ?");
        $del->execute([$mission_id, $benevole_id]);
    } else {
        // Pas inscrit -> On ajoute
        $add = $pdo->prepare("INSERT INTO inscriptions (mission_id, benevole_id) VALUES (?, ?)");
        $add->execute([$mission_id, $benevole_id]);
    }
    // On reste sur la page
    header("Location: inscription_mission.php?id=$mission_id"); exit();
}

// Récupérer tous les bénévoles
$benevoles = $pdo->query("SELECT * FROM benevoles ORDER BY nom ASC")->fetchAll();

// Récupérer la liste des ID déjà inscrits (pour cocher les cases)
$inscrits_stmt = $pdo->prepare("SELECT benevole_id FROM inscriptions WHERE mission_id = ?");
$inscrits_stmt->execute([$mission_id]);
$ids_inscrits = $inscrits_stmt->fetchAll(PDO::FETCH_COLUMN); // Tableau simple des IDs [1, 5, 8...]
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscriptions - <?= htmlspecialchars($mission['titre']) ?></title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-fage { background-color: #4c8c8c !important; }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="missions.php">← Retour aux missions</a>
</nav>

<div class="container pb-5">
    <h2 class="text-secondary fw-bold mb-3">Inscriptions : <?= htmlspecialchars($mission['titre']) ?></h2>
    <p class="lead">Cochez les bénévoles qui participent à cette mission.</p>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Participe ?</th>
                    <th>Nom</th>
                    <th>Pôle</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($benevoles as $b): ?>
                    <?php $est_inscrit = in_array($b['id'], $ids_inscrits); ?>
                    <tr class="<?= $est_inscrit ? 'table-success' : '' ?>">
                        <td style="width: 100px;">
                            <form method="post">
                                <input type="hidden" name="action" value="toggle">
                                <input type="hidden" name="benevole_id" value="<?= $b['id'] ?>">
                                <button type="submit" class="btn btn-sm <?= $est_inscrit ? 'btn-success' : 'btn-outline-secondary' ?>">
                                    <?= $est_inscrit ? 'INSCRIT' : 'Inscrire' ?>
                                </button>
                            </form>
                        </td>
                        <td class="fw-bold"><?= htmlspecialchars($b['nom'] . ' ' . $b['prenom']) ?></td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($b['pole'] ?? '-') ?></span></td>
                        <td class="text-muted small"><?= htmlspecialchars($b['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
