<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FAGE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/Accueil/Logo.png">
</head>
<body id="Haut de page">
<header>

    <!-- Barre du haut -->
    <nav class="navbar navbar-expand-lg" style="background-color: #4c8c8c;">
        <div class="container-fluid align-items-center">

            <!-- Logo -->
            <a class="navbar-brand" href="Accueil.php">
                <img src="images/Accueil/Logo.png" alt="FAGE" height="75">
            </a>

            <!-- Bouton Don -->
            <a class="btn btn-outline-dark rounded-pill me-3 fw-bold" href="Don.php" role="button">
                <span class="heart">💙</span> FAIRE UN DON
            </a>

            <!-- Recherche -->
            <form class="d-flex ms-auto me-3">
                <label>
                    <input class="form-control me-2" type="search" placeholder="Recherche">
                </label>
                <button class="btn btn-info">OK</button>
            </form>

            <!-- Icône Bouton utilisateur -->
            <button class="btn p-0 border-0 bg-transparent user-btn">
                <img src="images/Accueil/user.png" alt="Profil" class="rounded-circle user-icon">
            </button>
        </div>
    </nav>

    <!-- Barre de navigation avec menus déroulants -->
    <nav class="navbar navbar-expand bg-secondary">
        <ul class="nav nav-fill w-100">
            <!-- NOS IDÉES -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    NOS IDÉES
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">Élections CNESER</a></li>
                    <li><a class="dropdown-item" href="#">Enseignement supérieur</a></li>
                    <li><a class="dropdown-item" href="#">Élection présidentielle 2022</a></li>
                    <li><a class="dropdown-item" href="#">Social</a></li>
                    <li><a class="dropdown-item" href="#">Jeunesse</a></li>
                    <li><a class="dropdown-item" href="#">Transition Écologique</a></li>
                </ul>
            </li>

            <!-- INNOVATION SOCIALE -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    INNOVATION SOCIALE
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">Prévention par les pairs</a></li>
                    <li><a class="dropdown-item" href="#">Évènements responsables</a></li>
                    <li><a class="dropdown-item" href="#">S'engager dans la lutte contre les précarités</a></li>
                    <li><a class="dropdown-item" href="#">Action citoyenne</a></li>
                    <li><a class="dropdown-item" href="#">Vivre en bonne santé</a></li>
                    <li><a class="dropdown-item" href="#">Evoluer dans un environnement durable, inclusif et citoyen</a></li>
                </ul>
            </li>

            <!-- MES DROITS -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    MES DROITS
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">La défense des droits</a></li>
                    <li><a class="dropdown-item" href="#">Foire aux questions</a></li>
                    <li><a class="dropdown-item" href="#">Contacts</a></li>
                </ul>
            </li>

            <!-- ÉVÈNEMENTS -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    ÉVÈNEMENTS
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">Congrès national</a></li>
                    <li><a class="dropdown-item" href="#">Les Assoliades</a></li>
                    <li><a class="dropdown-item" href="#">Séminaire National</a></li>
                    <li><a class="dropdown-item" href="#">Journées Nationales de l'Innovation Sociale</a></li>
                    <li><a class="dropdown-item" href="#">États Généraux</a></li>
                </ul>
            </li>

            <!-- FORMATIONS -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    FORMATIONS
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">La formation à la FAGE</a></li>
                    <li><a class="dropdown-item" href="#">Le catalogue des formations</a></li>
                    <li><a class="dropdown-item" href="#">Organiser un week-end de formation avec la FAGE</a></li>
                    <li><a class="dropdown-item" href="#">Le Guide de l'élu</a></li>
                    <li><a class="dropdown-item" href="#">GRABE</a></li>
                    <li><a class="dropdown-item" href="#">Formation en Education Civique et Citoyenne avec la FAGE</a></li>
                </ul>
            </li>

            <!-- ACTUALITÉS -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    ACTUALITÉS
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">Actualités de la FAGE et de ses Fédérations</a></li>
                    <li><a class="dropdown-item" href="#">Le blog</a></li>
                    <li><a class="dropdown-item" href="#">Multimédia</a></li>
                </ul>
            </li>

            <!-- ESPACE PRESSE -->
            <li class="nav-item dropdown">
                <a class="nav-link text-dark fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    ESPACE PRESSE
                </a>
                <ul class="dropdown-menu custom-dropdown">
                    <li><a class="dropdown-item" href="#">CONTACT</a></li>
                    <li><a class="dropdown-item" href="#">CDP & DP</a></li>
                    <li><a class="dropdown-item" href="#">Revue de presse</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
</body>

