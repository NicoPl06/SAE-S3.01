<?php
session_start();

// Configuration de la base de données
$db_file = 'back/data.sqlite';
$message_erreur = "";

// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Connexion à SQLite
        $db = new PDO("sqlite:$db_file");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Récupération et nettoyage des données
        $identifier = trim($_POST['identifier']);
        $password = $_POST['password'];

        if (!empty($identifier) && !empty($password)) {
            // 3. Requête préparée pour chercher l'utilisateur (par email ou nom)
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :id OR nom = :id");
            $stmt->execute(['id' => $identifier]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // ... (début du code identique)

            // 4. Vérification du mot de passe
            if ($user && password_verify($password, $user['password'])) {
                // Succès : on stocke les infos
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];

                // --- MODIFICATION ICI ---
                // Si l'utilisateur est un ADMIN, on lui donne le sésame pour le Back-Office
                // et on le redirige directement vers le tableau de bord.
                if (isset($user['role']) && $user['role'] === 'admin') {
                    $_SESSION['admin_user'] = $user['nom']; // La variable magique pour auth.php
                    header('Location: admin/index.php');    // Direction le Back-Office !
                    exit();
                }
                // ------------------------

                // Pour les autres (visiteurs, bénévoles lambda), direction l'accueil normal
                header('Location: Accueil.php');
                exit();
            } else {
                $message_erreur = "Identifiant ou mot de passe incorrect.";
            }

            // ... (fin du code identique)
        } else {
            $message_erreur = "Veuillez remplir tous les champs.";
        }
    } catch (PDOException $e) {
        $message_erreur = "Erreur de connexion à la base de données.";
        // En développement, tu peux afficher : $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - FAGE</title>
    <link rel="icon" href="images/Connexion/Logo_FAGE.svg%201.png" type="image/png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="Styles.css">
</head>
<body class="page-connexion">

<header>
    <img src="images/Connexion/Logo_FAGE.svg%201.png" alt="Logo FAGE" class="logo">
</header>

<main>
    <section class="carte-connexion">
        <h1>Se connecter</h1>
        <p>Nouveau sur ce site ? <a href="Inscription.php">S’inscrire</a></p>
        <?php if (!empty($message_erreur)): ?>
            <div style="background: #ffdbdb; color: #a30000; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.9em; text-align: center;">
                <i class="bi bi-exclamation-circle"></i> <?php echo $message_erreur; ?>
            </div>
        <?php endif; ?>

        <form action="Connexion.php" method="POST">
            <div class="champ">
                <i class="bi bi-person"></i>
                <input type="text" name="identifier" placeholder="Identifiant ou E-mail *" value="<?php echo isset($_POST['identifier']) ? htmlspecialchars($_POST['identifier']) : ''; ?>" required>
            </div>

            <div class="champ">
                <i class="bi bi-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe *" required>
            </div>

            <a href="#" class="lien-mdp">Mot de passe oublié ?</a>

            <button type="submit" class="bouton">Connexion</button>
        </form>
    </section>
</main>

</body>
</html>