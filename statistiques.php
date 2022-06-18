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
        <h2>Statistiques</h2>
        <?php
        include "pdo.php";
        //Évalués Global***********************************************************
        $countTotalEtudiant = $conn->prepare(
            "SELECT COUNT(*) FROM etudiant;"
        );
        $countTotalEtudiant->execute();
        $totalEtudiant = $countTotalEtudiant->fetch(PDO::FETCH_ASSOC);
        echo "<h4><span class='green'>" . $totalEtudiant['COUNT(*)'] . "</span> étudiants ont été évalués</h4>";

        //Réussite Global***********************************************************
        $countReussiteEtudiant = $conn->prepare(
            "SELECT COUNT(*) FROM etudiant WHERE moyenne >= 12;"
        );
        $countReussiteEtudiant->execute();
        $reussiteEtudiant = $countReussiteEtudiant->fetch(PDO::FETCH_ASSOC);

        echo "<h4><span class='green'>" . $reussiteEtudiant['COUNT(*)'] . "</span> étudiants ont réussi</h4>";

        //***********************************************************

        function tauxReussite($type) {
            include "pdo.php";

            $countTotal = $conn->prepare(
                "SELECT COUNT(*) FROM etudiant
        INNER JOIN groupe
        ON code = codeGroupe
        WHERE `type` = '$type';"
            );
            $countTotal->execute();
            $total = $countTotal->fetch(PDO::FETCH_ASSOC);

            $countReussite = $conn->prepare(
                "SELECT COUNT(*) FROM etudiant
        INNER JOIN groupe
        ON code = codeGroupe
        WHERE moyenne >= 12 AND `type` = '$type';"
            );
            $countReussite->execute();
            $Reussite = $countReussite->fetch(PDO::FETCH_ASSOC);
            $pourcentage = $Reussite['COUNT(*)'] / $total['COUNT(*)'] * 100;
            echo "<h4>Le taux de réussite <span class='green'>" . $type . "</span> est de <span class='green'>" . round($pourcentage, 2) . " %</span></h4>";
        }

        tauxReussite('En Ligne');
        tauxReussite('En Classe');
        tauxReussite('Hybride');
        ?>
        <h3>Revenir vers l'<a class="link" href="acceuil.php">acceuil</a></h3>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>