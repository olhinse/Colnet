<?php
//Connexion a la base de données
include "pdo.php";
// Filtre db utilisateur pour vérifier username
if (isset($_POST["submit"])) {
    //Récupération des données
    $username = $_POST["username"];
    $motDePasse = $_POST["motDePasse"];

    //Préparation de la requête
    $usernameCheck = $conn->prepare("SELECT * FROM utilisateur WHERE username = :username");
    //Liaison des valeurs avec les marqueurs
    $usernameCheck->bindParam(':username', $username);
    $usernameCheck->execute();
    $usernameResult = $usernameCheck->fetch(PDO::FETCH_ASSOC);

    $msg = "<p>Crédentiels invalides, vérifiez vos informations ou créez un compte</p>";

    if (!empty($usernameResult) and (password_verify($motDePasse, $usernameResult['motDePasse']))) {
        $msg = "<p>Crédentiels valides, vous pouvez accéder à l'<a class='link' href='acceuil.php'>acceuil</a></p>";
    }
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

    <title>Connexion - Colnet Osullivan</title>
</head>

<body>

    <?php
    include "header.php";
    ?>

    <div class="container">
        <h2>Page de connexion</h2>
        <form method="post" action="connexion.php">
            <div class="formList">
                <div class="champ">
                    <label for="username">utilisateur :</label>
                    <input type="text" id="username" name="username" placeholder="JohnSmith" required="required">
                </div>
                <div class="champ">
                    <label for="motDePasse">Mot de passe :</label>
                    <input type="password" id="motDePasse" name="motDePasse" placeholder="********" required="required">
                </div>
            </div>
            <input type="submit" name="submit" value="Se connecter">
            <?php
            //Message de connection
            if (isset($_POST["submit"])) {
                echo $msg;
            } ?>

            <input type="button" onclick="location.href='creerCompte.php'" value="Créer un compte">
        </form>
    </div>

    <?php
    include "footer.php";
    ?>


</body>

</html>