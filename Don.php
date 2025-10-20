<?php
REQUIRE_ONCE 'header.php';
?>
<link rel="stylesheet" href="Styles/Style-Don.css">

<body id="Haut de page">

<!-- Bannière cookies RGPD -->
<div id="cookie-banner" class="cookie-banner">
    <div class="cookie-content">
        <h5>Gestion des cookies</h5>
        <p>
            Nous utilisons des cookies pour améliorer votre expérience, mesurer l'audience et proposer des contenus personnalisés.
            Vous pouvez accepter, refuser ou personnaliser vos choix.
        </p>
        <div class="cookie-buttons">
            <a href="#fermer" class="cookie-btn accept">Accepter tout</a>
            <a href="#fermer" class="cookie-btn refuse">Refuser tout</a>
            <a href="#cookie-settings" class="cookie-btn settings">Paramétrer</a>
        </div>
    </div>
</div>

<!-- Fenêtre de paramétrage des cookies -->
<div id="cookie-settings" class="cookie-modal">
    <div class="cookie-modal-content">
        <h4>Préférences des cookies</h4>
        <p class="small">Personnalisez vos préférences ci-dessous.</p>

        <form>
            <div class="cookie-option">
                <label>
                    <input type="checkbox" checked disabled>
                    <strong>Cookies essentiels</strong> (nécessaires au bon fonctionnement du site)
                </label>
            </div>

            <div class="cookie-option">
                <label>
                    <input type="checkbox">
                    Cookies analytiques (mesure d'audience)
                </label>
            </div>

            <div class="cookie-option">
                <label>
                    <input type="checkbox">
                    Cookies publicitaires (contenus personnalisés)
                </label>
            </div>

            <div class="cookie-option">
                <label>
                    <input type="checkbox">
                    Cookies de réseaux sociaux (partage et intégrations)
                </label>
            </div>

            <div class="cookie-modal-buttons">
                <a href="#fermer" class="cookie-btn refuse">Fermer</a>
                <a href="#fermer" class="cookie-btn settings">Enregistrer mes choix</a>
            </div>
        </form>

        <a href="#fermer" class="cookie-close">&times;</a>
    </div>
</div>
<!-- Lien factice pour fermer tout -->
<div id="fermer"></div>


<!-- Bannière avec formulaire de don -->
<section class="banniere position-relative">
    <img src="images/Don/Banniere.png" alt="Bannière DON" class="img-fluid w-100 banner-img">

    <!-- Conteneur pour le formulaire et le texte -->
    <div class="container position-absolute top-0 start-0 w-100 h-100">
        <div class="row h-100 align-items-center">
            <!-- Formulaire de don (gauche) -->
            <div class="col-md-6">
                <div class="don-form-container bg-light p-4 rounded shadow">
                    <h2 class="text-primary mb-4">Mon don</h2>

                    <!-- Choix du type de don -->
                    <div class="mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="donType" id="donOnce" checked>
                            <label class="form-check-label fw-bold" for="donOnce">Je donne une fois</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="donType" id="donMonthly">
                            <label class="form-check-label fw-bold" for="donMonthly">Je donne tous les mois</label>
                        </div>
                    </div>

                    <!-- Montants prédéfinis avec boutons radio cachés -->
                    <div class="mb-4">
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="radio" name="montantChoice" id="montant10" value="10" class="d-none">
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

                    <!-- Montant libre avec radio caché -->
                    <div class="mb-4">
                        <input type="radio" name="montantChoice" id="montantLibreRadio" value="libre" class="d-none">
                        <label for="montantLibreRadio" class="form-label fw-bold d-block">Montant libre</label>
                        <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="montantLibre"
                                   name="montantLibre"
                                   placeholder="0,00"
                                   step="0.01"
                                   min="0.01"
                                   max="10000">
                            <span class="input-group-text">€</span>
                        </div>
                        <div class="form-text text-muted">Utilisez le point (.) comme séparateur décimal</div>
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" class="btn btn-custom w-100 py-2 fw-bold">Faire un don</button>
                </div>
            </div>

            <!-- Texte explicatif (droite) -->
            <div class="col-md-6">
                <div class="don-text-container text-white p-4">
                    <h2 class="mb-4"><strong>Ensemble</strong>, facilitons le quotidien des étudiants et renforçons leur solidarité.</h2>
                    <p class="lead">Votre générosité permet d'acheter des denrées pour l'épicerie, d'équiper les AGORAé et de financer des activités essentielles.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="custom-hr">

<h1 class="text-black text-uppercase text-start fw-bold ms-5 my-5 fs-3 ">
    A quoi sert mon don ?
</h1>

<div class="container my-5">
    <!-- À quoi sert mon don -->
    <p class="ms-4 mb-2 fw-semibold">Vos dons sont attribués au projet AGORAE pour :</p>
    <ul class="ms-5">
        <li>acheter les denrées proposées par l'épicerie,</li>
        <li>équiper les AGORAé en matériel,</li>
        <li>financer les activités.</li>
    </ul>
    <p class="ms-4">Les dons sont équitablement répartis entre les AGORAé du réseau.</p>

    <hr class="custom-hr">

    <!-- Don régulier -->
    <h5 class="fw-bold ms-4">Le don régulier, une solution simple et efficace</h5>
    <ul class="ms-5 mt-3">
        <li><strong>Liberté :</strong> vous choisissez le montant que vous donnez chaque mois, vous pouvez à tout moment le modifier ou interrompre votre soutien.</li>
        <li><strong>Efficacité :</strong> vous nous offrez plus de visibilité sur nos ressources et nos actions dans la durée, tout en limitant les frais de gestion.</li>
        <li><strong>Simplicité :</strong> vous n'avez plus de chèque à envoyer, vous recevez un seul reçu fiscal en début d'année.</li>
    </ul>

    <hr class="custom-hr">

    <!-- Transparence financière -->
    <h5 class="fw-bold ms-4">TRANSPARENCE FINANCIÈRE</h5>
    <p class="ms-4 mt-2">
        La FAGE met à disposition du public son rapport d'activité annuel sur son site internet.
        Les comptes de l'association sont certifiés par un commissaire aux comptes chaque année.
    </p>
</div>

<!-- Bouton Retour en haut -->
<a href="#Haut de page" class="back-to-top" aria-label="Retour en haut de la page">
    ↑
</a>

<?php
require_once 'footer.php';

?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
