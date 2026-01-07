<?php
// --------------------------
// Données de la boutique
// --------------------------
$heroProduct = [
        "titre"      => "Formation Civique et Citoyenne",
        "sous_titre" => "36e Congrès national de la FAGE",
        "cta"        => "Commander"
];

$produits = [
        [
                "nom"     => "Tote Bag FAGE",
                "image"   => "images/Boutique/Totebag.png"
        ],
        [
                "nom"     => "T-shirt FAGE",
                "image"   => "images/Boutique/T-Shirt.png"
        ]
];

require_once "header.html";
?>
<link rel="stylesheet" href="Styles.css">
<script src="js/Retour_haut.js"></script>

<main class="boutique-container">
    <!-- Intro boutique -->
    <section class="boutique-page-intro">
        <h1>La boutique de la FAGE</h1>
        <p class="boutique-subtitle">Le matériel officiel proposé par la FAGE</p>
    </section>

    <!-- Produit mis en avant -->
    <section class="boutique-hero-card">
        <div class="boutique-hero-logo">
            <img src="images/Boutique/Logo FCC.png" alt="Logo FCC">
        </div>
        <div class="boutique-hero-content">
            <p class="boutique-hero-subtitle"><?php echo $heroProduct["sous_titre"]; ?></p>
            <h2 class="boutique-hero-title"><?php echo $heroProduct["titre"]; ?></h2>
            <button class="boutique-btn-primary"><?php echo $heroProduct["cta"]; ?></button>
        </div>
    </section>

    <!-- Produits -->
    <section class="boutique-products">
        <h2 class="boutique-section-title">Découvrez aussi tous nos produits FAGE</h2>

        <div class="boutique-product-grid">
            <?php
            foreach ($produits as $produit) {
                echo '
                <article class="boutique-product-card">
                    <div class="boutique-product-logo">FAGE</div>
                    <h3 class="boutique-product-name">' . $produit["nom"] . '</h3>
                    <div class="boutique-product-image">
                        <img src="' . $produit["image"] . '" alt="' . $produit["nom"] . '">
                    </div>
                    <button class="boutique-btn-secondary">Commander</button>
                </article>
                ';
            }
            ?>
        </div>
    </section>
</main>

<?php
require_once 'footer.html';
?>
