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
                "section" => "Section 1",
                "nom"     => "Tote Bag FAGE",
                "image"   => "images/Boutique/Totebag.png"
        ],
        [
                "section" => "Section 2",
                "nom"     => "T-shirt FAGE",
                "image"   => "images/Boutique/T-Shirt.png"
        ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique – FAGE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Styles.css">
</head>
<body class="boutique-page">

<header class="boutique-header">
    <div class="boutique-container boutique-header-inner">
        <div class="boutique-logo">
            <a href="Accueil.php">
                <img src="images/Boutique/Logo FAGE.png" alt="Logo FAGE" style="height:60px;">
            </a>
        </div>
        <nav class="boutique-nav">
            <a href="Accueil.php">Accueil</a>
            <a href="#">Nos idées</a>
            <a href="#">Événements</a>
            <a href="#">Formations</a>
            <a href="Actualites.php">Actualités</a>
        </nav>
    </div>
</header>

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
                    <div class="boutique-product-section">' . $produit["section"] . '</div>
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

<footer class="footer">
    <div class="footer-bottom">
        <div class="footer-left"></div>
        <div class="footer-center">
            <p>© 2025 FAGE – Maquette Boutique</p>
        </div>
        <div class="footer-right"></div>
    </div>
</footer>

</body>
</html>
