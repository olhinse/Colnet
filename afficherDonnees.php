<?php

if (isset($_POST["submit"])) {
    //Préparation des données
    $codeGroupe = $_POST["codeGroupe"];
    $triMoyenne = $_POST["triMoyenne"];

    function statement($codeGroupe, $triMoyenne) {
        include "pdo.php";
        if ($triMoyenne == "Descendant") {
            $stmt = $conn->prepare(
                "SELECT * FROM etudiant WHERE CodeGroupe = :codeGroupe ORDER BY moyenne desc"
            );
            return $stmt;
        }
        if ($triMoyenne == "Ascendant") {
            $stmt = $conn->prepare(
                "SELECT * FROM etudiant WHERE CodeGroupe = :codeGroupe ORDER BY moyenne"
            );
            return $stmt;
        }
        if ($triMoyenne == "Aucun") {
            $stmt = $conn->prepare("SELECT * FROM etudiant WHERE CodeGroupe = :codeGroupe");
            return $stmt;
        }
    }

    $stmt = statement($codeGroupe, $triMoyenne);
    $stmt->bindParam(':codeGroupe', $codeGroupe);
    $stmt->execute();
    $List = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" />
    <script src="https://kit.fontawesome.com/517a16f6dc.js" crossorigin="anonymous"></script>

    <title>Afficher les Données - Colnet Osullivan</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <h2>Afficher les données</h2>
        <?php
        if (isset($_POST["submit"])) {
            if (!empty($List)) { ?>
                <h3 class="green bold">Résultat</h3>
                <table>
                    <thead>
                        <tr>
                            <th>codePermanent</th>
                            <th>nomComplet</th>
                            <th>adresse</th>
                            <th>telephone</th>
                            <th>moyenne</th>
                            <th>codeGroupe</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($List as $ligne) { ?>
                            <tr>
                                <td><?php echo $ligne['codePermanent']; ?></td>
                                <td><?php echo $ligne['nomComplet']; ?></td>
                                <td><?php echo $ligne['adresse']; ?></td>
                                <td><?php echo $ligne['telephone']; ?></td>
                                <td><?php echo $ligne['moyenne']; ?></td>
                                <td><?php echo $ligne['codeGroupe']; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <p class="green bold">Aucun étudiant dans ce groupe</p>
                <?php }
                } ?>
                    </tbody>
                </table>
                <form method="post" action="afficherDonnees.php">
                    <div class="champ">
                        <label for='codeGroupe'>Choisir un groupe :</label>
                        <select name='codeGroupe' id='codeGroupe' size='1'>
                            <option>Sélectionnez un groupe</option>
                            <?php
                            include "fetchList.php";
                            fetchList("code", "groupe");
                            ?>
                        </select>
                    </div>
                    <div class="champ">
                        <label for="triMoyenne">Tri sur la moyenne :</label>
                        <select id="triMoyenne" name="triMoyenne" size="1">
                            <option value="Aucun">Aucun</option>
                            <option value="Descendant">Descendant</option>
                            <option value="Ascendant">Ascendant</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Afficher les résultats">
                </form>
                <h3>Revenir vers l'<a class="link" href="acceuil.php">acceuil</a></h3>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>