<?php
    require_once'header.html'

?>

<link rel="stylesheet" href="Styles.css">
<script src="js/Retour_haut.js"></script>
<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="js/Map.js"></script>
<!-- Ajoute un modal dans ton HTML -->
<div id="popupModal" style="
    display:none;
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 20px rgba(0,0,0,0.5);
    max-width:500px;
    max-height:70%;
    overflow-y:auto;
    z-index:10000;
">
    <h3 id="modalTitle"></h3>
    <p id="modalText"></p>
    <button onclick="document.getElementById('popupModal').style.display='none'" style="margin-top:10px;">Fermer</button>
</div>




<!-- Bannière -->
<section class="banniere">
    <img src="images/Accueil/Banniere.png" alt="Bannière FAGE" class="img-fluid w-100 banner-img">
</section>

<!-- Titre -->
<h1 class="text-uppercase text-start fw-bolder ms-5 my-5 custom-title">
    Bienvenue sur la FAGE
</h1>

<!-- Texte d'introdution -->
<p class ="text-dark text-center fw-semibold mb-2 w-75 mx-auto fs-4 ">
    La Fédération des associations générales étudiantes – FAGE – est la première organisation étudiante
    représentative en France. Fondée en 1989, elle assoit son fonctionnement sur la démocratie participative.
    Elle regroupe près de 2 000 associations et syndicats, via des fédérations territoriales et de filière, soit
    environ <strong>300 000 jeunes</strong>.
</p>

<!-- ligne séparatrice -->
<hr class="custom-hr">


<!-- Section Carte des fédérations -->
<section class="federations-map my-5">
    <h2 class="text-uppercase text-center fw-bold mb-4" style="color: #4c8c8c;">
        Les fédérations de la FAGE
    </h2>

    <div id="map" style="height: 500px; border-radius: 15px; overflow: hidden;"></div>
</section>


<!-- ligne séparatrice -->
<hr class="custom-hr">


<!-- 2nd Titre -->
<h2 class="text-uppercase text-center fw-bold" style="color: #4c8c8c;">
    Actualités
</h2>

<div class="carousel-container mx-auto my-5" style="width: 65%;">
    <div id="carousel-Actualités" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="d-flex carousel-slide">
                    <div class="carousel-image">
                        <img src="images/Accueil/Actu1.png" alt="Slide 1">
                    </div>
                    <div class="carousel-text p-4">
                        <h3 class="fw-bold">Coût de la rentrée étudiante</h3>
                        <p class="fs-5">
                            Cette nouvelle rentrée se présente comme un coup de massue supplémentaire pour le public étudiant.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="d-flex carousel-slide">
                    <div class="carousel-image">
                        <img src="images/Accueil/Actu2.png" alt="Slide 2">
                    </div>
                    <div class="carousel-text p-4">
                        <h3 class="fw-bold">Engagement des jeunes</h3>
                        <p class="fs-5">
                            Près de 3000 jeunes se sont exprimés sur leur rapport à la démocratie et à l’engagement en France !
                        </p>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="d-flex carousel-slide">
                    <div class="carousel-image">
                        <img src="images/Accueil/Actu3.png" alt="Slide 3">
                    </div>
                    <div class="carousel-text p-4">
                        <h3 class="fw-bold">Baromètre de la précarité étudiante</h3>
                        <p class="fs-5">
                            Enquête réalisée auprès des bénéficiaires des AGORAé, épiceries sociales et solidaires étudiantes.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Flèches en bas à droite -->
        <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#carousel-Actualités" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#carousel-Actualités" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<!-- Bouton Actualités -->
<div class="text-center my-4">
    <button class="btn custom-btn fw-bold rounded-pill" onclick="window.location.href='Actualites.php'">
        Voir toutes les Actualités
    </button>
</div>

<!-- ligne séparatrice -->
<hr class="custom-hr">

<!-- Section Boutique -->
<section class="shop  py-5">
    <div class="container text-center">
        <h2 class="text-uppercase fw-bold mb-3" style="color: #4c8c8c;">Boutique de la FAGE</h2>
        <div class="row align-items-center justify-content-center g-4">
            <!-- Image du produit -->
            <div class="col-md-4 col-10">
                <img src="images/Accueil/Boutique.png" alt="36e Congrès National de la FAGE" class="img-fluid rounded shadow">
            </div>

            <!-- Texte et bouton -->
            <div class="col-md-5 col-10 text-center">
                <h3 class="fw-semibold mb-3">36e Congrès national de la FAGE</h3>
                <a class="btn btn-lg rounded-pill fw-bold shop-btn mb-3" onclick="window.location.href='Boutique.php'">
                    COMMANDER
                </a>
                <p class="shop-dates mb-0">
                    <strong>Date de début :</strong> 25/09/2025 <br>
                    <strong>Date de fin :</strong> 28/09/2025
                </p>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'footer.html';

?>


