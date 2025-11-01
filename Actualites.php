<?php
require_once'header.html'

?>


<link rel="stylesheet" href="Styles.css">
<script src="js/Retour_haut.js"></script>



<?php
// 1) Déclare ici tes articles (images locales dans /images/actualites)
$articles = [
        [
                'title' => 'Indicateur du coût de la rentrée étudiante 2025',
                'link'  => 'https://www.fage.org/news/actualites-fage-federations/2025-09-03,DP-FAGE-ICDR-2025.htm', // mets l’URL interne de ta page article
                'date'  => '2025-09-03',
                'image' => '/images/Actualites/actu1.png',
                'excerpt'=> 'Cette nouvelle rentrée se présente comme un coup de massue supplémentaire pour le public étudiant…'
        ],
        [
                'title' => 'Résultats des élections CNESER 2025',
                'link'  => 'https://www.fage.org/news/actualites-fage-federations/2025-06-06,resultats-cneser-2025.htm',
                'date'  => '2025-06-06',
                'image' => '/images/Actualites/actu2.png',
                'excerpt'=> 'Pour le 5e scrutin consécutif, la FAGE confirme largement sa place de 1ère ORE de France…'
        ],
        [
                'title' => 'Baromètre de la précarité étudiante',
                'link'  => 'https://www.fage.org/news/actualites-fage-federations/2025-02-19,barometre_de_la_precarite_etudiante_fage.htm',
                'date'  => '2025-02-19',
                'image' => '/images/Actualites/actu3.png',
                'excerpt'=> 'Pour le 5e scrutin consécutif, la FAGE confirme largement sa place de 1ère ORE de France…'
        ],
    // Ajoute autant d’articles que tu veux…
];

// 2) Affichage (Bootstrap: grille + cards)
?>
<section class="container my-5">
    <h2 class="h3 mb-4">Actualités</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($articles as $it): ?>
            <article class="col">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($it['image'])): ?>
                        <img class="card-img-top"
                             src="<?= htmlspecialchars($it['image']) ?>"
                             alt="<?= htmlspecialchars($it['title'] ?? 'Actualité') ?>"
                             loading="lazy">
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h3 class="h5 card-title mb-2">
                            <a class="stretched-link text-decoration-none"
                               href="<?= htmlspecialchars($it['link'] ?? '#') ?>">
                                <?= htmlspecialchars($it['title'] ?? '') ?>
                            </a>
                        </h3>

                        <?php if (!empty($it['date'])): ?>
                            <time class="text-muted small d-block mb-2"
                                  datetime="<?= htmlspecialchars($it['date']) ?>">
                                <?= htmlspecialchars($it['date']) ?>
                            </time>
                        <?php endif; ?>

                        <?php if (!empty($it['excerpt'])): ?>
                            <p class="card-text mb-0"><?= htmlspecialchars($it['excerpt']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>


<?php
require_once 'footer.html';

?>
