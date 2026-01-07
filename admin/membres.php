<?php
require_once 'auth.php';
$pdo = getPDO();
$poles_dispo = ['Aucun', 'Bureau', 'Solidarité', 'Événementiel', 'Communication', 'Partenariats'];

// Actions
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $stmt = $pdo->prepare("INSERT INTO benevoles (nom, prenom, email, telephone, fonction, pole, cotisation_a_jour) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $cotis = isset($_POST['cotisation']) ? 1 : 0;
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['tel'], $_POST['fonction'], $_POST['pole'], $cotis]);
    header("Location: membres.php"); exit();
}
if (isset($_POST['action']) && $_POST['action'] === 'update_cotis') {
    $stmt = $pdo->prepare("UPDATE benevoles SET cotisation_a_jour = ? WHERE id = ?");
    $cotis = isset($_POST['cotisation']) ? 1 : 0;
    $stmt->execute([$cotis, $_POST['id']]);
    header("Location: membres.php" . (isset($_GET['q']) ? "?q=" . urlencode($_GET['q']) : "")); exit();
}
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM benevoles WHERE id = ?")->execute([$_GET['delete']]);
    header("Location: membres.php"); exit();
}

// Recherche
$recherche = $_GET['q'] ?? '';
if ($recherche) {
    $stmt = $pdo->prepare("SELECT * FROM benevoles WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? ORDER BY pole ASC, nom ASC");
    $stmt->execute(["%$recherche%", "%$recherche%", "%$recherche%"]);
    $liste = $stmt->fetchAll();
} else {
    $liste = $pdo->query("SELECT * FROM benevoles ORDER BY pole ASC, nom ASC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Bénévoles</title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-fage { background-color: #4c8c8c !important; }
        .text-fage { color: #4c8c8c !important; }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
        .btn-fage:hover { background-color: #3b7272; color: white; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="index.php">← Retour Dashboard</a>
</nav>

<div class="container pb-5">
    <h2 class="text-secondary fw-bold mb-4">Annuaire des Adhérents</h2>

    <div class="card p-4 mb-4 shadow-sm border-0">
        <h5 class="mb-3 text-fage">Nouveau Bénévole</h5>
        <form method="post" class="row g-3">
            <input type="hidden" name="action" value="add">
            <div class="col-md-3"><input type="text" name="nom" class="form-control" placeholder="Nom" required></div>
            <div class="col-md-3"><input type="text" name="prenom" class="form-control" placeholder="Prénom" required></div>
            <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email"></div>
            <div class="col-md-3"><input type="text" name="tel" class="form-control" placeholder="Téléphone"></div>
            <div class="col-md-3">
                <select name="pole" class="form-select">
                    <option value="" disabled selected>Pôle...</option>
                    <?php foreach($poles_dispo as $p): ?><option value="<?= $p ?>"><?= $p ?></option><?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3"><input type="text" name="fonction" class="form-control" placeholder="Fonction (ex: VP)"></div>
            <div class="col-md-3 d-flex align-items-center"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="cotisation" value="1" checked><label class="form-check-label small">Cotis. OK</label></div></div>
            <div class="col-md-3"><button type="submit" class="btn btn-fage w-100">Ajouter</button></div>
        </form>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-6">
            <form method="get" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Rechercher..." value="<?= htmlspecialchars($recherche) ?>">
                <button class="btn btn-secondary" type="submit">🔍</button>
                <?php if($recherche): ?><a href="membres.php" class="btn btn-outline-danger ms-2">X</a><?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>Identité</th><th>Pôle</th><th>Contact</th><th>Cotisation</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach($liste as $b): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($b['nom'] ?? '') . ' ' . htmlspecialchars($b['prenom'] ?? '') ?><div class="small text-muted fw-normal"><?= htmlspecialchars($b['fonction'] ?? '') ?></div></td>
                    <td><span class="badge bg-secondary"><?= htmlspecialchars($b['pole'] ?? '-') ?></span></td>
                    <td class="small"><div><?= htmlspecialchars($b['email'] ?? '') ?></div><div class="text-muted"><?= htmlspecialchars($b['telephone'] ?? '') ?></div></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="action" value="update_cotis"><input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="cotisation" value="1" <?= !empty($b['cotisation_a_jour']) ? 'checked' : '' ?> onchange="this.form.submit()"></div>
                        </form>
                    </td>
                    <td>
                        <a href="details_benevole.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-info text-white me-1">👤 Fiche</a>
                        <a href="?delete=<?= $b['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">X</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if(empty($liste)): ?><tr><td colspan="5" class="text-center py-4 text-muted">Aucun résultat.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>