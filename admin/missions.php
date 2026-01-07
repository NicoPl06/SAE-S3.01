<?php
require_once 'auth.php';
$pdo = getPDO();

// Liste des Pôles disponibles (à adapter selon tes besoins)
$poles_dispo = ['Général', 'Solidarité', 'Événementiel', 'Communication', 'Partenariats', 'Bureau'];

// Récupération des infos de l'utilisateur connecté (pour la sécurité)
$role_user = $_SESSION['user_role'] ?? 'responsable'; // Par défaut, on restreint
$pole_user = $_SESSION['user_pole'] ?? 'Aucun';

// --- TRAITEMENT : AJOUT D'UNE MISSION ---
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    // Si c'est un Admin, il choisit le pôle. Si c'est un Responsable, c'est forcé à son pôle.
    $pole_a_inserer = ($role_user === 'admin') ? $_POST['pole'] : $pole_user;

    $stmt = $pdo->prepare("INSERT INTO missions (titre, description, date_debut, date_fin, nb_places, pole) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
            $_POST['titre'],
            $_POST['desc'],
            $_POST['debut'],
            $_POST['fin'],
            $_POST['places'],
            $pole_a_inserer
    ]);
    header('Location: missions.php'); // Rechargement propre pour éviter les doublons
    exit();
}

// --- TRAITEMENT : SUPPRESSION ---
if (isset($_GET['delete'])) {
    // Sécurité supplémentaire : On pourrait vérifier ici si le responsable a le droit de supprimer CETTE mission
    // Mais pour l'instant, on reste simple.
    $stmt = $pdo->prepare("DELETE FROM missions WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: missions.php');
    exit();
}

// --- RECUPERATION DES MISSIONS (FILTRAGE PAR ROLE) ---
if ($role_user === 'admin') {
    // L'ADMIN voit TOUTES les missions
    $sql = "SELECT * FROM missions ORDER BY date_debut DESC";
    $stmt = $pdo->query($sql);
} else {
    // Le RESPONSABLE ne voit que les missions de SON pôle
    $sql = "SELECT * FROM missions WHERE pole = ? ORDER BY date_debut DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pole_user]);
}
$missions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Missions</title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Charte Graphique FAGE */
        .bg-fage { background-color: #4c8c8c !important; }
        .text-fage { color: #4c8c8c !important; }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
        .btn-fage:hover { background-color: #3b7272; color: white; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="index.php">← Retour Dashboard</a>
    <span class="navbar-text text-white">
            <?= htmlspecialchars($_SESSION['admin_user'] ?? '') ?>
            (<?= htmlspecialchars($pole_user) ?>)
        </span>
</nav>

<div class="container pb-5">
    <h2 class="text-secondary fw-bold mb-4">Gestion des Missions Bénévoles</h2>

    <div class="card p-4 mb-4 shadow-sm border-0">
        <h5 class="mb-3 text-fage">Nouvelle Mission</h5>
        <form method="post" class="row g-3">
            <input type="hidden" name="action" value="add">

            <div class="col-md-6">
                <label class="form-label small text-muted">Titre</label>
                <input type="text" name="titre" class="form-control" placeholder="Titre de la mission" required>
            </div>

            <div class="col-md-6">
                <label class="form-label small text-muted">Pôle Rattaché</label>
                <?php if ($role_user === 'admin'): ?>
                    <select name="pole" class="form-select">
                        <?php foreach($poles_dispo as $p): ?>
                            <option value="<?= $p ?>"><?= $p ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($pole_user) ?>" disabled>
                    <input type="hidden" name="pole" value="<?= htmlspecialchars($pole_user) ?>">
                <?php endif; ?>
            </div>

            <div class="col-md-3">
                <label class="form-label small text-muted">Début</label>
                <input type="date" name="debut" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">Fin</label>
                <input type="date" name="fin" class="form-control">
            </div>

            <div class="col-md-12">
                <textarea name="desc" class="form-control" placeholder="Description de la mission..." rows="2"></textarea>
            </div>

            <div class="col-md-4">
                <input type="number" name="places" class="form-control" placeholder="Nb bénévoles requis">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-fage">Publier la mission</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Pôle</th>
                <th>Détails Mission</th>
                <th>Places</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($missions as $m): ?>
                <tr>
                    <td><?= date('d/m', strtotime($m['date_debut'])) ?></td>

                    <td><span class="badge bg-secondary"><?= htmlspecialchars($m['pole'] ?? 'Général') ?></span></td>

                    <td class="fw-bold">
                        <?= htmlspecialchars($m['titre']) ?>
                        <div class="small text-muted fw-normal text-truncate" style="max-width: 350px;">
                            <?= htmlspecialchars($m['description']) ?>
                        </div>
                    </td>

                    <td><?= $m['nb_places'] ?> pers.</td>

                    <td>
                        <a href="inscription_mission.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-primary mb-1 text-white text-decoration-none">
                             Inscrits
                        </a>

                        <a href="?delete=<?= $m['id'] ?>" class="btn btn-sm btn-outline-danger mb-1" onclick="return confirm('Voulez-vous vraiment supprimer cette mission ?')">
                             X
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php if(empty($missions)): ?>
                <tr><td colspan="5" class="text-center text-muted py-3">Aucune mission pour le moment.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>