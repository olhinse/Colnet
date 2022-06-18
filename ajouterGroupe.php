<?php
//Se connecter a la base de données
include "pdo.php";

//Si le formulaire a été rempli -- Si le bouton submit a été cliqué
if (isset($_POST["submit"])) {
    //Préparation des données
    $code = $_POST["code"];
    $nom = $_POST["nom"];
    $type = $_POST["type"];

    //Création de la requete préparée
    $insertionGroupe = $conn->prepare(
        "INSERT INTO groupe(code, nom, `type`)
        VALUES (?, ?, ?)"
    );

    //Liaison des valeurs avec les marqueurs
    $insertionGroupe->bindParam(1, $code);
    $insertionGroupe->bindParam(2, $nom);
    $insertionGroupe->bindParam(3, $type);

    //Éxécution de requete
    $insertionGroupe->execute();
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

    <title>Ajouter un groupe - Colnet Osullivan</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <h2>Ajouter un groupe</h2>
        <?php
        if (isset($_POST["submit"])) {
        ?>
            <p>Le groupe <?php echo '<span class="green bold">' . $code . '</span>' ?> a été ajouté avec succès</p>
        <?php } ?>
        <form method="post" action="ajouterGroupe.php">
            <div class="champ">
                <label for="code">Code :</label>
                <input type="text" id="code" name="code" placeholder="WEBH21C" required="required">
            </div>
            <div class="champ">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Techniques de développement Web" required="required">
            </div>
            <div class="champ">
                <label for="type">Choisir un type :</label>
                <select id="type" name="type" size="1">
                    <option value="En ligne">En ligne</option>
                    <option value="En classe">En classe</option>
                    <option value="Hybride">Hybride</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Ajouter">
        </form>

        <h3>Revenir vers l'<a class="link" href="acceuil.php">acceuil</a></h3>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>