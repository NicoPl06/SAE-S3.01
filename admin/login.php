<?php
session_start();
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db_path = __DIR__ . '/../back/data.sqlite';
        $pdo = new PDO("sqlite:$db_path");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // On accepte 'admin' OU 'responsable'
            if ($user['role'] === 'admin' || $user['role'] === 'responsable') {
                $_SESSION['admin_user'] = $user['nom'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_pole'] = $user['pole_affecte'];
                header('Location: index.php');
                exit();
            } else {
                $msg = "Accès refusé : rôle insuffisant.";
            }
        } else {
            $msg = "Identifiants incorrects.";
        }
    } catch (Exception $e) {
        $msg = "Erreur système.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Administration</title>
    <link rel="icon" type="image/png" href="../images/Commun/LOGO_finale.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #4c8c8c; } /* Couleur FAGE */
        .card { border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .btn-fage { background-color: #4c8c8c; color: white; border: none; }
        .btn-fage:hover { background-color: #3b7272; color: white; }
        .text-fage { color: #4c8c8c; }

        /* Lien retour visible (gris puis vert au survol) */
        .link-retour { color: #6c757d; text-decoration: none; font-size: 0.9em; transition: 0.3s; }
        .link-retour:hover { color: #4c8c8c; text-decoration: underline; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
<div class="card p-4" style="width: 400px; border-radius: 15px;">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-fage">Espace Bureau</h3>
    </div>

    <?php if($msg): ?><div class="alert alert-danger text-center"><?= $msg ?></div><?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label text-muted">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label text-muted">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-fage w-100 py-2 fw-bold">Se connecter</button>
    </form>

    <div class="text-center mt-4">
        <a href="../Accueil.php" class="link-retour">← Retour au site public</a>
    </div>
</div>
</body>
</html>