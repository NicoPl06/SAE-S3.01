# FAGE : back-office d'une association étudiante

Projet de SAÉ 3.01 (BUT 2 Informatique, IUT de Paris - Rives de Seine) : transformer le site vitrine statique d'une association étudiante en une plateforme dynamique avec espace d'administration sécurisé.

> Projet pédagogique, sans lien officiel avec la FAGE.

## Fonctionnalités

- **Accès sécurisés** : un administrateur global (accès total) et des responsables de pôle (accès limité à leur pôle). Mots de passe hachés (`password_verify`), droits stockés en session.
- **Tableau de bord** : nombre d'adhérents, trésorerie, volume d'activités, âge moyen, taux de participation.
- **Gestion des adhérents** : annuaire avec recherche, fiche détaillée avec historique des missions, bascule rapide de l'état de la cotisation.
- **Gestion des missions** : création d'offres de bénévolat, affectation automatique au pôle du créateur, inscriptions des bénévoles (relation N-N).
- **Sauvegarde** : copie manuelle de la base avec horodatage avant une opération critique.
- **Côté public** : accueil, actualités, boutique, page de dons, inscription et connexion.

## Technologies

| Rôle | Outil |
|---|---|
| Langage serveur | PHP, avec PDO et requêtes préparées |
| Base de données | SQLite (`data.sqlite`) |
| Interface | HTML, CSS, JavaScript, Bootstrap et Bootstrap Icons (back-office) |
| Outils | PhpStorm, Git / GitHub, Discord |

## Structure du projet

```
SAE-WEB-BACK/
├── admin/          # back-office (actualités, adhérents, missions, statistiques, auth.php)
├── back/
│   ├── backups/    # sauvegardes de la base
│   └── data.sqlite # base de données
├── images/
├── js/
├── Accueil.php, Actualites.php, Boutique.php, Don.php
├── Connexion.php, Deconnexion.php, inscription.php
├── header.html, footer.html
└── Styles.css
```

## Lancer le projet

Prérequis : PHP avec l'extension `pdo_sqlite` ([À compléter : version de PHP testée]).

```bash
git clone [À compléter : URL du dépôt]
cd SAE-WEB-BACK
php -S localhost:8000
```

Puis ouvrir `http://localhost:8000/Accueil.php`.

Compte administrateur de test : [À compléter : identifiants de démonstration, jamais de vrais mots de passe]

## Équipe

Projet réalisé à 4 :

- Nicolas Plaisance : page d'accueil, page de dons, contribution au back-office
- Apollinaire Dumez : boutique
- Yacoub Cherief : page d'actualités, back-office
- Ismail Fourra : inscription, connexion, dons

## Améliorations envisagées

- Tests automatisés
- Optimisation des performances
- Interface d'administration plus ergonomique
