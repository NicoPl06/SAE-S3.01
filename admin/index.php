<?php
require_once 'auth.php';
$pdo = getPDO();

// --- 1. STATISTIQUES DE BASE ---
$nb_actus = $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();
$nb_users = $pdo->query("SELECT COUNT(*) FROM benevoles")->fetchColumn();
$nb_cotisants = $pdo->query("SELECT COUNT(*) FROM benevoles WHERE cotisation_a_jour = 1")->fetchColumn();
$nb_missions = $pdo->query("SELECT COUNT(*) FROM missions")->fetchColumn();
$nb_events = $pdo->query("SELECT COUNT(*) FROM evenements")->fetchColumn();

// Calcul du total des dons
try {
    $total_dons = $pdo->query("SELECT SUM(montant) FROM dons")->fetchColumn();
} catch (Exception $e) { $total_dons = 0; }

// --- 2. INDICATEURS AVANCÉS ---

// A. Âge Moyen
$dates = $pdo->query("SELECT date_naissance FROM benevoles WHERE date_naissance IS NOT NULL AND date_naissance != ''")->fetchAll(PDO::FETCH_COLUMN);
$age_moyen = "N/A";
if (count($dates) > 0) {
    $total_age = 0;
    $now = new DateTime();
    foreach($dates as $d) {
        $dob = new DateTime($d);
        $total_age += $now->diff($dob)->y;
    }
    $age_moyen = round($total_age / count($dates)) . " ans";
}

// B. Taux de Participation
try {
    $nb_actifs = $pdo->query("SELECT COUNT(DISTINCT benevole_id) FROM inscriptions")->fetchColumn();
} catch (Exception $e) { $nb_actifs = 0; }
$taux_participation = ($nb_users > 0) ? round(($nb_actifs / $nb_users) * 100) . "%" : "0%";

// C. Top Professions
$top_jobs = $pdo->query("SELECT profession, COUNT(*) as c FROM benevoles WHERE profession IS NOT NULL AND profession != '' GROUP BY profession ORDER BY c DESC LIMIT 3")->fetchAll();

// D. Top Origines (Villes)
$top_villes = $pdo->query("SELECT ville, COUNT(*) as c FROM benevoles WHERE ville IS NOT NULL AND ville != '' GROUP BY ville ORDER BY c DESC LIMIT 3")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard FAGE</title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root { --bs-primary: #4c8c8c; }
        .bg-fage { background-color: #4c8c8c !important; }
        .text-fage { color: #4c8c8c !important; }
        .card-stat { border-left: 5px solid #4c8c8c; transition: transform 0.2s; }
        .card-stat:hover { transform: translateY(-5px); }
        .stat-number { font-size: 2rem; font-weight: bold; color: #4c8c8c; }
        .btn-card { width: 100%; margin-top: 10px; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-fage px-3 shadow-sm">
    <span class="navbar-brand mb-0 h1 fw-bold">Administration FAGE</span>
    <div>
            <span class="text-white me-3 d-none d-md-inline">
                Bonjour, <?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin') ?>
            </span>
        <a href="logout.php" class="btn btn-light btn-sm text-fage fw-bold">Déconnexion</a>
    </div>
</nav>

<div class="container mt-4 pb-5">

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_GET['type'] ?? 'info') ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_GET['msg']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2 class="mb-4 text-secondary">Tableau de bord</h2>

    <div class="row mb-4">
        <div class="col"><div class="card card-stat p-3 shadow-sm"><small class="text-muted">ADHÉRENTS</small><div class="stat-number"><?= $nb_users ?></div></div></div>
        <div class="col"><div class="card card-stat p-3 shadow-sm"><small class="text-muted">COTISANTS</small><div class="stat-number"><?= $nb_cotisants ?></div></div></div>
        <div class="col"><div class="card card-stat p-3 shadow-sm"><small class="text-muted">MISSIONS</small><div class="stat-number"><?= $nb_missions ?></div></div></div>
        <div class="col"><div class="card card-stat p-3 shadow-sm"><small class="text-muted">ÉVÉNEMENTS</small><div class="stat-number"><?= $nb_events ?></div></div></div>
    </div>

    <h5 class="text-secondary mb-3">Analyse & Performance</h5>
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div><small class="text-muted text-uppercase fw-bold">Âge Moyen</small><h3 class="text-fage fw-bold mb-0"><?= $age_moyen ?></h3></div>
                    <i class="bi bi-cake2 fs-1 text-black-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div><small class="text-muted text-uppercase fw-bold">Participation</small><h3 class="text-success fw-bold mb-0"><?= $taux_participation ?></h3><small class="text-muted" style="font-size: 0.8em;"><?= $nb_actifs ?> actifs</small></div>
                    <i class="bi bi-activity fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3 h-100">
                <small class="text-muted text-uppercase fw-bold">Top Professions</small>
                <ul class="list-unstyled mb-0 mt-2">
                    <?php foreach($top_jobs as $j): ?>
                        <li class="d-flex justify-content-between mb-1"><span><?= htmlspecialchars($j['profession']) ?></span><span class="badge bg-secondary rounded-pill"><?= $j['c'] ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3 h-100">
                <small class="text-muted text-uppercase fw-bold">Top Origines</small>
                <ul class="list-unstyled mb-0 mt-2">
                    <?php foreach($top_villes as $v): ?>
                        <li class="d-flex justify-content-between mb-1"><span><?= htmlspecialchars($v['ville']) ?></span><span class="badge bg-info text-dark rounded-pill"><?= $v['c'] ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <h4 class="mb-3 text-secondary">Modules de gestion</h4>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 p-3 text-center">
                <h4 class="text-fage"><i class="bi bi-newspaper me-2"></i>Actualités</h4>
                <p class="small text-muted">Articles et News</p>
                <a href="gestion_actus.php" class="btn btn-outline-secondary btn-card">Gérer</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 p-3 text-center">
                <h4 class="text-success"><i class="bi bi-people me-2"></i>Adhérents</h4>
                <p class="small text-muted">Annuaire & Fiches</p>
                <a href="membres.php" class="btn btn-outline-success btn-card">Gérer</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 p-3 text-center">
                <h4 class="text-primary"><i class="bi bi-building me-2"></i>Partenaires</h4>
                <p class="small text-muted">Sponsors et assos</p>
                <a href="partenaires.php" class="btn btn-outline-primary btn-card">Gérer</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 p-3 text-center">
                <h4 class="text-warning"><i class="bi bi-briefcase me-2"></i>Missions</h4>
                <p class="small text-muted">Offres et Inscriptions</p>
                <a href="missions.php" class="btn btn-outline-warning btn-card">Gérer</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 p-3 text-center">
                <h4 class="text-danger"><i class="bi bi-calendar-event me-2"></i>Événements</h4>
                <p class="small text-muted">Agenda et soirées</p>
                <a href="evenements.php" class="btn btn-outline-danger btn-card">Gérer</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 p-3 text-center">
                <h4 class="text-success"><i class="bi bi-cash-coin me-2"></i>Finances</h4>
                <h3 class="fw-bold my-2 text-dark"><?= number_format((float)$total_dons, 0, ',', ' ') ?> €</h3>
                <p class="small text-muted">Total des dons récoltés</p>
                <a href="finances.php" class="btn btn-outline-success btn-card">Détails</a>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm border-0 h-100 p-3 text-center bg-dark text-white">
                <h4><i class="bi bi-hdd-network me-2"></i>Sauvegarde Système</h4>
                <p class="small text-white-50">Copie de sécurité (data.sqlite)</p>
                <a href="sauvegarder.php" class="btn btn-light fw-bold" onclick="return confirm('Créer une sauvegarde ?')">
                    <i class="bi bi-save me-1"></i> Sauvegarder maintenant
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>