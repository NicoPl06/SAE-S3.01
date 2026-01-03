<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Connexion à la base SQLite
        $db = new PDO('sqlite:back/data.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Récupération des données
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // 3. Hachage du mot de passe (SÉCURITÉ CRUCIALE)
        // On ne stocke jamais "1234", on stocke une empreinte cryptée
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 4. Insertion dans la table users
        $stmt = $db->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :pass)");
        $stmt->execute([
            'nom'   => $nom,
            'email' => $email,
            'pass'  => $hash
        ]);

        $message = "Inscription réussie ! <a href='Connexion.php'>Connectez-vous ici</a>";

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Code erreur pour "Email déjà existant"
            $message = "Erreur : cet email est déjà utilisé.";
        } else {
            $message = "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - FAGE</title>
    <link rel="stylesheet" href="Styles.css"> </head>
<body class="page-connexion">
<main>
    <section class="carte-connexion">
        <h1>S'inscrire</h1>

        <?php if($message): ?>
            <p style="padding:10px; background:#e1f5fe; border-radius:5px;"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="Inscription.php" method="POST">
            <div class="champ">
                <input type="text" name="nom" placeholder="Nom complet" required>
            </div>
            <div class="champ">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="champ">
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="bouton">Créer mon compte</button>
        </form>
        <p><a href="Connexion.php">Déjà inscrit ? Se connecter</a></p>
    </section>
</main>
</body>
</html>