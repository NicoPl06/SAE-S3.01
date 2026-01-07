<?php
require_once 'auth.php'; // Ta gestion de sécurité
$pdo = getPDO(); // Ta connexion BDD

// Initialisation
$total_benevoles = 0;
$total_dons = 0;
$missions_terminees = 0;
$derniers_dons = [];

try {
    // 1. Nombre de bénévoles (Table 'benevoles' et non 'adherents')
    $resAdh = $pdo->query("SELECT COUNT(*) FROM benevoles");
    $total_benevoles = $resAdh ? $resAdh->fetchColumn() : 0;

    // 2. Somme des dons (Table 'dons' qu'on vient de créer)
    $resDons = $pdo->query("SELECT SUM(montant) FROM dons");
    $total_dons = $resDons ? $resDons->fetchColumn() : 0;

    // 3. Missions terminées (On compare la date de fin à aujourd'hui)
    // "Une mission est finie si sa date_fin est passée"
    $resMiss = $pdo->query("SELECT COUNT(*) FROM missions WHERE date_fin < DATE('now')");
    $missions_terminees = $resMiss ? $resMiss->fetchColumn() : 0;

    // 4. Les 5 derniers dons
    $resList = $pdo->query("SELECT * FROM dons ORDER BY date_don DESC LIMIT 5");
    $derniers_dons = $resList->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    $error = "Erreur SQL : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Finances & Stats</title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .bg-fage { background-color: #4c8c8c !important; }
        .text-fage { color: #4c8c8c !important; }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
        .card-stat { border: none; border-radius: 15px; transition: transform 0.2s; }
        .card-stat:hover { transform: translateY(-5px); }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 mb-4 shadow-sm">
    <a class="navbar-brand" href="index.php">← Retour Dashboard</a>
    <span class="navbar-text text-white">
            <?= htmlspecialchars($_SESSION['admin_user'] ?? '') ?>
        </span>
</nav>

<div class="container pb-5">

    <?php if(isset($error)): ?>
        <div class="alert alert-warning"><?= $error ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary fw-bold">Statistiques & Finances</h2>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-printer"></i> Imprimer
        </button>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card card-stat shadow-sm text-white h-100" style="background-color: #4c8c8c;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small fw-bold opacity-75">Bénévoles</h6>
                        <h2 class="display-5 fw-bold"><?= (int)$total_benevoles ?></h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat shadow-sm bg-success text-white h-100">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small fw-bold opacity-75">Dons Récoltés</h6>
                        <h2 class="display-5 fw-bold"><?= number_format((float)$total_dons, 0, ',', ' ') ?> €</h2>
                    </div>
                    <i class="bi bi-piggy-bank fs-1 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat shadow-sm bg-info text-white h-100">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small fw-bold opacity-75">Missions Finies</h6>
                        <h2 class="display-5 fw-bold"><?= (int)$missions_terminees ?></h2>
                    </div>
                    <i class="bi bi-check-circle fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold py-3 text-fage">
                    <i class="bi bi-list-stars me-2"></i>Derniers dons reçus
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Donateur</th>
                            <th>Montant</th>
                            <th>Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($derniers_dons)): ?>
                            <?php foreach ($derniers_dons as $don): ?>
                                <tr>
                                    <td class="small"><?= date('d/m/Y', strtotime($don['date_don'])) ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($don['donateur']) ?></td>
                                    <td class="text-success fw-bold"><?= number_format($don['montant'], 2, ',', ' ') ?> €</td>
                                    <td>
                                        <?php if(($don['type'] ?? '') == 'mensuel'): ?>
                                            <span class="badge bg-info text-dark">Mensuel</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Unique</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">Aucun don enregistré pour le moment.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>