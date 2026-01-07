<?php
require_once 'auth.php';
$pdo = getPDO();

if (!isset($_GET['id'])) { header('Location: membres.php'); exit(); }
$id = $_GET['id'];

// --- MISE A JOUR DES INFOS ---
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $stmt = $pdo->prepare("UPDATE benevoles SET nom=?, prenom=?, email=?, telephone=?, profession=?, ville=?, date_naissance=?, competences=?, fonction=?, pole=? WHERE id=?");
    $stmt->execute([
            $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['tel'],
            $_POST['job'], $_POST['ville'], $_POST['naissance'], $_POST['skills'],
            $_POST['fonction'], $_POST['pole'],
            $id
    ]);
    header("Location: details_benevole.php?id=$id&msg=ok"); exit();
}

// Récupération bénévole
$stmt = $pdo->prepare("SELECT * FROM benevoles WHERE id = ?");
$stmt->execute([$id]);
$b = $stmt->fetch();

// Historique des missions
$sql_history = "SELECT m.titre, m.date_debut, m.pole FROM inscriptions i JOIN missions m ON i.mission_id = m.id WHERE i.benevole_id = ? ORDER BY m.date_debut DESC";
$stmt_hist = $pdo->prepare($sql_history);
$stmt_hist->execute([$id]);
$historique = $stmt_hist->fetchAll();

// Calcul âge
$age = "N/A";
if ($b['date_naissance']) {
    $dob = new DateTime($b['date_naissance']);
    $now = new DateTime();
    $age = $now->diff($dob)->y . " ans";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche : <?= htmlspecialchars($b['nom']) ?></title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> .bg-fage { background-color: #4c8c8c !important; } </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="membres.php">← Retour Liste</a>
</nav>

<div class="container pb-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">✏️ Éditer la fiche</div>
                <div class="card-body">
                    <form method="post" class="row g-3">
                        <input type="hidden" name="action" value="update">

                        <div class="col-md-6"><label class="small text-muted">Nom</label><input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($b['nom']) ?>"></div>
                        <div class="col-md-6"><label class="small text-muted">Prénom</label><input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($b['prenom']) ?>"></div>

                        <div class="col-md-6"><label class="small text-muted">Date Naissance</label><input type="date" name="naissance" class="form-control" value="<?= $b['date_naissance'] ?>"></div>
                        <div class="col-md-6"><label class="small text-muted">Âge</label><input type="text" class="form-control bg-light" value="<?= $age ?>" disabled></div>

                        <div class="col-md-6"><label class="small text-muted">Profession</label><input type="text" name="job" class="form-control" value="<?= htmlspecialchars($b['profession'] ?? '') ?>"></div>
                        <div class="col-md-6"><label class="small text-muted">Ville (Origine)</label><input type="text" name="ville" class="form-control" value="<?= htmlspecialchars($b['ville'] ?? '') ?>"></div>

                        <div class="col-md-6"><label class="small text-muted">Email</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($b['email']) ?>"></div>
                        <div class="col-md-6"><label class="small text-muted">Téléphone</label><input type="text" name="tel" class="form-control" value="<?= htmlspecialchars($b['telephone'] ?? '') ?>"></div>

                        <div class="col-md-6">
                            <label class="small text-muted">Pôle</label>
                            <select name="pole" class="form-select">
                                <?php foreach(['Aucun', 'Bureau', 'Solidarité', 'Événementiel', 'Communication', 'Partenariats'] as $p): ?>
                                    <option value="<?= $p ?>" <?= ($b['pole'] == $p) ? 'selected' : '' ?>><?= $p ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6"><label class="small text-muted">Fonction / Rôle</label><input type="text" name="fonction" class="form-control" value="<?= htmlspecialchars($b['fonction'] ?? '') ?>"></div>

                        <div class="col-12"><label class="small text-muted">Compétences</label><textarea name="skills" class="form-control" rows="3"><?= htmlspecialchars($b['competences'] ?? '') ?></textarea></div>

                        <div class="col-12 text-end"><button type="submit" class="btn btn-success">Enregistrer</button></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">📜 Missions réalisées</div>
                <ul class="list-group list-group-flush">
                    <?php foreach($historique as $h): ?>
                        <li class="list-group-item">
                            <div class="fw-bold"><?= htmlspecialchars($h['titre']) ?></div>
                            <small class="text-muted"><?= date('d/m/Y', strtotime($h['date_debut'])) ?> • <span class="badge bg-secondary"><?= htmlspecialchars($h['pole']) ?></span></small>
                        </li>
                    <?php endforeach; ?>
                    <?php if(empty($historique)): ?><li class="list-group-item text-muted text-center py-4">Aucune participation.</li><?php endif; ?>
                </ul>
            </div>
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body text-center">
                    <small class="text-muted d-block mb-2">Statut Cotisation</small>
                    <?= $b['cotisation_a_jour'] ? '<span class="badge bg-success fs-5">✅ À jour</span>' : '<span class="badge bg-danger fs-5">❌ Non payé</span>' ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>