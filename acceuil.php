<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" />
    <script src="https://kit.fontawesome.com/517a16f6dc.js" crossorigin="anonymous"></script>
    <title>Acceuil - Colnet Osullivan</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <h2>Acceuil</h2>
        <h3 class="green">Veuillez faire un choix</h3>
        <div class="acceuil-flex">
            <a href="ajouterGroupe.php">
                <i class="green fa-solid fa-users-line fa-2x"></i>
                <div class="btn-acceuil">Ajouter un groupe</div>
            </a>
            <a href="ajouterEtudiant.php">
                <i class="green fa-solid fa-user-plus fa-2x"></i>
                <div class="btn-acceuil">Ajouter un étudiant</div>
            </a>
            <a href="afficherDonnees.php">
                <i class="green fa-solid fa-list fa-2x"></i>
                <div class="btn-acceuil">Afficher les données</div>
            </a>
            <a href="statistiques.php">
                <i class="green fa-solid fa-chart-simple fa-2x"></i>
                <div class="btn-acceuil">Compiler les statistiques</div>
            </a>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>