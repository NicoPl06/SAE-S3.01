<?php
session_start();

// 1. On ne redirige plus ici, mais on vérifie l'état pour l'affichage
$is_connected = isset($_SESSION['user_id']);
$nom_utilisateur = $is_connected ? $_SESSION['user_nom'] : "Invité";

// 2. Gestion du message de succès (Pop-up)
$show_popup = false;
if (isset($_GET['success'])) {
    $show_popup = true;
    $montant_final = htmlspecialchars($_GET['m']);
    $type_don_texte = ($_GET['t'] === 'mensuel') ? "chaque mois" : "une seule fois";
}

// 3. Traitement du formulaire (SÉCURITÉ : on bloque si pas connecté)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$is_connected) {
        header('Location: Connexion.php');
        exit();
    }

    $montant = 0;
    if ($_POST['montantChoice'] === 'libre') {
        $montant = floatval($_POST['montantLibre']);
    } else {
        $montant = intval($_POST['montantChoice']);
    }

    if ($montant > 0) {
        $type = ($_POST['donType'] === 'mensuel') ? 'mensuel' : 'unique';
        header("Location: Don.php?success=1&m=$montant&t=$type");
        exit();
    }
}

require_once 'header.html';
?>

    <link rel="stylesheet" href="Styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<?php if ($show_popup): ?>
    <div class="popup-overlay" id="popupDon">
        <div class="popup-content">
            <i class="bi bi-heart-fill"></i>
            <h2>Merci pour votre soutien !</h2>
            <hr>
            <p>
                <strong><?php echo htmlspecialchars($nom_utilisateur); ?></strong>, <br>
                votre don de <strong><?php echo $montant_final; ?> €</strong>
                sera bien pris en compte <strong><?php echo $type_don_texte; ?></strong>.
            </p>
            <button class="btn-close-popup" onclick="window.location.href='Don.php'">Fermer</button>
        </div>
    </div>
<?php endif; ?>

    <section class="banniere banniere-don position-relative">
        <img src="images/Don/Banniere.png" alt="Bannière DON" class="img-fluid w-100 banner-img">

        <div class="container position-absolute top-0 start-0 w-100 h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-6">
                    <form action="Don.php" method="POST" class="don-form-container bg-light p-4 rounded shadow">
                        <h2 class="text-primary mb-4">Mon don</h2>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="d-none" type="radio" name="donType" id="donOnce" value="unique" checked>
                                <label class="btn btn-outline-custom w-100 py-2 montant-label" for="donOnce">Je donne une fois</label>
                            </div>
                            <div class="form-check">
                                <input class="d-none" type="radio" name="donType" id="donMonthly" value="mensuel">
                                <label class="btn btn-outline-custom w-100 py-2 montant-label" for="donMonthly">Je donne tous les mois</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" name="montantChoice" id="montant10" value="10" class="d-none" checked>
                                    <label for="montant10" class="btn btn-outline-custom w-100 py-2 montant-label">10 €</label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" name="montantChoice" id="montant50" value="50" class="d-none">
                                    <label for="montant50" class="btn btn-outline-custom w-100 py-2 montant-label">50 €</label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" name="montantChoice" id="montant100" value="100" class="d-none">
                                    <label for="montant100" class="btn btn-outline-custom w-100 py-2 montant-label">100 €</label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" name="montantChoice" id="montant200" value="200" class="d-none">
                                    <label for="montant200" class="btn btn-outline-custom w-100 py-2 montant-label">200 €</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <input type="radio" name="montantChoice" id="montantLibreRadio" value="libre" class="d-none">
                            <label for="montantLibreRadio" class="form-label fw-bold d-block">Montant libre</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="montantLibre" name="montantLibre" placeholder="0,00" step="0.01">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>

                        <?php if ($is_connected): ?>
                            <button type="submit" class="btn btn-custom w-100 py-2 fw-bold">Faire un don</button>
                        <?php else: ?>
                            <a href="Connexion.php" class="btn btn-warning w-100 py-2 fw-bold text-dark">
                                <i class="bi bi-box-arrow-in-right"></i> Connectez-vous pour donner
                            </a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="don-text-container text-white p-4">
                        <h2 class="mb-4"><strong>Ensemble</strong>, facilitons le quotidien des étudiants.</h2>
                        <?php if ($is_connected): ?>
                            <p class="lead">Heureux de vous revoir, <strong><?php echo htmlspecialchars($nom_utilisateur); ?></strong>.</p>
                        <?php else: ?>
                            <p class="lead">Rejoignez notre mouvement de solidarité.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="custom-hr">
    <h1 class="text-black text-uppercase text-start fw-bold ms-5 my-5 fs-3">A quoi sert mon don ?</h1>
    <div class="container my-5">
        <p class="ms-4 mb-2 fw-semibold fs-2">Vos dons sont attribués au projet AGORAE pour :</p>
        <ul class="ms-5 ">
            <li>Acheter les denrées proposées par l'épicerie,</li>
            <li>Équiper les AGORAé en matériel,</li>
            <li>Financer les activités.</li>
        </ul>
    </div>

<?php require_once 'footer.html'; ?>