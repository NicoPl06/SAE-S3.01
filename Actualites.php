<?php
require_once 'header.html';
?>

    <link rel="stylesheet" href="Styles.css">
    <script src="js/Retour_haut.js"></script>

<?php
// ==========================================
// 1. CONNEXION À LA BASE DE DONNÉES (SQLite)
// ==========================================
$articles = [];
$q = trim((string) ($_GET['q'] ?? ''));

try {
    // IMPORTANT : Assurez-vous que votre fichier s'appelle bien 'actus.sqlite'
    // et qu'il est dans le même dossier que ce fichier PHP.
    $db_path = __DIR__ . '/back/data.sqlite';

    // Création de la connexion PDO
    $pdo = new PDO("sqlite:$db_path");

    // Configuration des erreurs et du mode de récupération
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // ==========================================
    // 2. PRÉPARATION ET EXÉCUTION DE LA REQUÊTE
    // ==========================================
    if ($q !== '') {
        // CAS RECHERCHE : On filtre sur le titre OU le résumé
        // On utilise une requête préparée pour la sécurité (anti-injection SQL)
        $sql = "SELECT * FROM articles 
                WHERE title LIKE :search OR excerpt LIKE :search 
                ORDER BY date_pub DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':search' => '%' . $q . '%']);
    } else {
        // CAS PAR DÉFAUT : On prend tout, trié par date la plus récente
        $sql = "SELECT * FROM articles ORDER BY date_pub DESC";
        $stmt = $pdo->query($sql);
    }

    // On récupère tous les résultats dans un tableau
    $articles = $stmt->fetchAll();

} catch (PDOException $e) {
    // En cas d'erreur (fichier introuvable ou table inexistante)
    echo "<div class='alert alert-danger m-5'>Erreur de base de données : " . htmlspecialchars($e->getMessage()) . "</div>";
    die(); // On arrête le chargement de la page
}
?>

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
            <p class="text-muted">Résultats pour « <?= htmlspecialchars($q) ?> » : <?= count($articles) ?> trouvé(s)</p>
        <?php endif; ?>

        <?php if (empty($articles)): ?>
            <div class="alert alert-warning text-center mt-4">
                Aucune actualité ne correspond à votre recherche.
            </div>
        <?php endif; ?>

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

                            <?php
                            // Formatage de la date (YYYY-MM-DD -> DD/MM/YYYY)
                            $display_date = '';
                            if (!empty($it['date_pub'])) {
                                $display_date = date('d/m/Y', strtotime($it['date_pub']));
                            }
                            ?>

                            <?php if (!empty($display_date)): ?>
                                <time class="text-muted small d-block mb-2"
                                      datetime="<?= htmlspecialchars($it['date_pub']) ?>">
                                    <?= htmlspecialchars($display_date) ?>
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