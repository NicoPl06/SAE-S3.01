<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - FAGE</title>
    <link rel="icon" href="images/Connexion/Logo_FAGE.svg%201.png" type="image/png">

    <!-- Icônes Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Feuille de style -->
    <link rel="stylesheet" href="Styles.css">
</head>
<body class="page-connexion">


<header>
    <img src="images/Connexion/Logo_FAGE.svg%201.png" alt="Logo FAGE" class="logo">
</header>

<main>
    <section class="carte-connexion">
        <h1>Se connecter</h1>
        <p>Nouveau sur ce site ? <a href="#">S’inscrire</a></p>

        <form>
            <div class="champ">
                <i class="bi bi-person"></i>
                <input type="text" placeholder="Identifiant ou E-mail *" required>
            </div>

            <div class="champ">
                <i class="bi bi-lock"></i>
                <input type="password" placeholder="Mot de passe *" required>
            </div>

            <a href="#" class="lien-mdp">Mot de passe oublié ?</a>

            <button type="submit" class="bouton">Connexion</button>
        </form>
    </section>
</main>

</body>
</html>
