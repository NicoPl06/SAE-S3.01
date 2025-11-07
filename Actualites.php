<?php
require_once 'header.html';
?>

<link rel="stylesheet" href="Styles.css">
<script src="js/Retour_haut.js"></script>

<?php
// ===== Données =====
$articles = [
        ['title'=>'Indicateur du coût de la rentrée étudiante 2025','link'=>'https://www.fage.org/news/actualites-fage-federations/2025-09-03,DP-FAGE-ICDR-2025.htm','date'=>'03/09/2025','image'=>'/images/Actualites/actu1.png','excerpt'=>'Cette nouvelle rentrée se présente comme un coup de massue supplémentaire pour le public étudiant…'],
        ['title'=>'Résultats des élections CNESER 2025','link'=>'https://www.fage.org/news/actualites-fage-federations/2025-06-06,resultats-cneser-2025.htm','date'=>'06/06/2025','image'=>'/images/Actualites/actu2.png','excerpt'=>'Pour le 5e scrutin consécutif, la FAGE confirme largement sa place de 1ère ORE de France…'],
        ['title'=>'Baromètre de la précarité étudiante','link'=>'https://www.fage.org/news/actualites-fage-federations/2025-02-19,barometre_de_la_precarite_etudiante_fage.htm','date'=>'19/02/2025','image'=>'/images/Actualites/actu3.png','excerpt'=>'Analyse des situations de précarité chez les étudiant·es…'],
        ['title'=>"Un arrondi en caisse pour des milliers de repas",'link'=>'https://www.fage.org/news/actualites-fage-federations/2024-09-27,arrondi-en-caisse-2024.htm','date'=>'27/07/2024','image'=>'/images/Actualites/Actu4.png','excerpt'=>"Auchan et Picard soutiennent nos épiceries sociales et solidaires par une opération d'arrondi en caisse."],
        ['title'=>"20 ans après le 21 avril, les étudiant·e·s restent mobilisé·e·s contre l'extrême droite",'link'=>'https://www.fage.org/news/actualites-fage-federations/2024-07-01,FAGE_barrage_extreme_droite.htm','date'=>'01/07/2024','image'=>'/images/Actualites/Actu5.jpeg','excerpt'=>"Il y 20 ans, l'extrême droite arrivait pour la 1ère fois au 2nd tour de la présidentielle. 20 ans après, les étudiant·e·s restent mobilisé·e·s contre l'extrême droite La FAGE..."],
        ['title'=>"FEEL Festival - 2 juin 2024",'link'=>'https://www.fage.org/news/actualites-fage-federations/2024-05-24,feel-festival-2024.htm','date'=>'24/05/2024','image'=>'/images/Actualites/Actu6.png','excerpt'=>"Une semaine avant les élections européennes de 2024, plusieurs organisations se rassemblent au sein d'une mobilisation positive à Paris afin de sensibiliser aux enjeux de ces élections."],
];

// ===== Recherche =====
$q = trim((string) ($_GET['q'] ?? ''));
$filtered = $articles;

if ($q !== '') {
    $needle = strtolower($q);
    $filtered = array_values(array_filter($articles, function($it) use ($needle) {
        $hay = strtolower(($it['title'] ?? '') . ' ' . ($it['excerpt'] ?? ''));
        return strpos($hay, $needle) !== false;
    }));
}
?>

<!-- Barre de recherche -->
<form class="container my-4" method="get" role="search" aria-label="Recherche d’actualités">
    <div class="input-group">
        <input type="search"
               class="form-control"
               name="q"
               value="<?= htmlspecialchars($q) ?>"
               placeholder="Rechercher une actualité…"
               aria-label="Rechercher une actualité">
        <button class="btn btn-info search-btn" type="submit"><i class="bi bi-search"></i></button>
    </div>
</form>

<section class="container my-5">
    <h2 class="text-uppercase text-center fw-bold" style="color: #4c8c8c;">Actualités</h2>

    <?php if ($q !== ''): ?>
        <p class="text-muted">Résultats pour « <?= htmlspecialchars($q) ?> » : <?= count($filtered) ?> trouvé(s)</p>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($filtered as $it): ?>
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
                                  datetime="<?= htmlspecialchars($it['date']) ?>"> <!-- format ISO recommandé [web:220] -->
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

<?php require_once 'footer.html'; ?>
