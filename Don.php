<?php
require_once 'header.php';
?>


<link rel="stylesheet" href="Styles.css">
<script src="js/Retour_haut.js"></script>

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
                        <div class="form-check form-check">
                            <input class="d-none" type="radio" name="donType" id="donOnce" checked>
                            <label class="btn btn-outline-custom w-100 py-2 montant-label" for="donOnce">Je donne une fois</label>
                        </div>
                        <div class="form-check form-check">
                            <input class="d-none" type="radio" name="donType" id="donMonthly">
                            <label class="btn btn-outline-custom w-100 py-2 montant-label" for="donMonthly">Je donne tous les mois</label>
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
                            <label for="montantLibre"></label><input type="number"
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

<?php
require_once 'footer.php';

?>
