<?php
//Se connecter a la base de données
include "pdo.php";

//Si le formulaire a été rempli -- Si le bouton submit a été cliqué
if (isset($_POST["submit"])) {
    //Préparation des données
    $nomComplet = $_POST["nomComplet"];
    $username = $_POST["username"];
    $codePostal = $_POST["codePostal"];
    $email = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];
    $hash_motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);

    //Création de la requete préparée
    $insertionUtilisateur = $conn->prepare(
        "INSERT INTO utilisateur (nomComplet, username, codePostal, email, motDePasse)
        VALUES (:nomComplet, :username, :codePostal, :email, :motDePasse)"
    );

    //Liaison des valeurs avec les marqueurs
    $insertionUtilisateur->bindParam(':nomComplet', $nomComplet);
    $insertionUtilisateur->bindParam(':username', $username);
    $insertionUtilisateur->bindParam(':codePostal', $codePostal);
    $insertionUtilisateur->bindParam(':email', $email);
    $insertionUtilisateur->bindParam(':motDePasse', $hash_motDePasse);

    //Éxécution de requete
    $insertionUtilisateur->execute();
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

    <title>Créer un compte - Colnet O'sullivan</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <h2>Créer un compte</h2>
        <form method="post" action="creerCompte.php">
            <div class="champ">
                <label for="nomComplet">Nom complet :</label>
                <input type="text" id="nomComplet" name="nomComplet" placeholder="John Smith" required="required">
            </div>
            <div class="champ">
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" placeholder="JoSmit" required="required">
            </div>
            <div class="champ">
                <label for="codePostal">Code Postal :</label>
                <input type="text" id="codePostal" name="codePostal" placeholder="A1B 2C3" required="required">
            </div>
            <div class="champ">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="josmith@gmail.com" required="required">
            </div>
            <div class="champ">
                <label for="motDePasse">Mot de passe :</label>
                <input type="password" id="motDePasse" name="motDePasse" placeholder="********" required="required">
            </div>
            <input type="submit" name="submit" value="S'enregistrer">
        </form>

        <?php
        if (isset($_POST["submit"])) {
        ?>
            <p>Votre compte a été créé avec succès, vous pouvez vous <a class="link" href="connexion.php">connecter</a></p>
        <?php } ?>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>