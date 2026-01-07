<?php
$message = "";
$status = ""; // Pour savoir si c'est un succès ou une erreur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new PDO('sqlite:back/data.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :pass)");
        $stmt->execute([
                'nom'   => $nom,
                'email' => $email,
                'pass'  => $hash
        ]);

        $status = "success";
        $message = "Inscription réussie ! <a href='Connexion.php' style='color: #4c8c8c; font-weight: bold;'>Connectez-vous ici</a>";

    } catch (PDOException $e) {
        $status = "error";
        if ($e->getCode() == 23000) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - FAGE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="Styles.css">
    <style>
        /* Styles spécifiques pour les messages de retour */
        .msg-box {
            padding: 15px;
            border-radius: 20px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .msg-success {
            background-color: rgba(76, 140, 140, 0.1);
            color: #4c8c8c;
            border: 1px solid #4c8c8c;
        }
        .msg-error {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid #dc3545;
        }
        /* On s'assure que le lien dans le succès est bien visible */
        .msg-success a {
            text-decoration: underline;
        }
    </style>
</head>
<body class="page-connexion">

<header>
    <img src="images/Connexion/Logo_FAGE.svg%201.png" alt="Logo FAGE" class="logo">
</header>

<main>
    <section class="carte-connexion">
        <h1>S'inscrire</h1>
        <p>Rejoignez la fédération</p>

        <?php if($message): ?>
            <div class="msg-box <?php echo ($status === 'success') ? 'msg-success' : 'msg-error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="Inscription.php" method="POST">
            <div class="champ">
                <i class="fas fa-user"></i>
                <input type="text" name="nom" placeholder="Nom complet" required>
            </div>

            <div class="champ">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Adresse email" required>
            </div>

            <div class="champ">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="bouton">Créer mon compte</button>
        </form>

        <div style="margin-top: 25px; font-size: 14px;">
            <span style="color: #6b7280;">Déjà un compte ?</span>
            <a href="Connexion.php" style="color: #1d6fbf; font-weight: bold; text-decoration: none;">Se connecter</a>
        </div>
    </section>
</main>

</body>
</html>