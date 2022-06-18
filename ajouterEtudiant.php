<?php
//Se connecter a la base de données
include "pdo.php";
//Si le formulaire a été rempli -- Si le bouton submit a été cliqué
if (isset($_POST["submit"])) {
    //Préparation des données
    $codePermanent = $_POST["codePermanent"];
    $nomComplet = $_POST["nomComplet"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $moyenne = $_POST["moyenne"];
    $codeGroupe = $_POST["codeGroupe"];

    //Création de la requete préparée
    $insertionEtudiant = $conn->prepare(
        "INSERT INTO etudiant(codePermanent, nomComplet, adresse, telephone, moyenne, codeGroupe)
        VALUES (:codePermanent, :nomComplet, :adresse, :telephone, :moyenne, :codeGroupe)"
    );
    //Liaison des valeurs avec les marqueurs
    $insertionEtudiant->bindParam(':codePermanent', $codePermanent);
    $insertionEtudiant->bindParam(':nomComplet', $nomComplet);
    $insertionEtudiant->bindParam(':adresse', $adresse);
    $insertionEtudiant->bindParam(':telephone', $telephone);
    $insertionEtudiant->bindParam(':moyenne', $moyenne);
    $insertionEtudiant->bindParam(':codeGroupe', $codeGroupe);
    //Éxécution de requete
    $insertionEtudiant->execute();
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

    <title>Ajouter un étudiant - Colnet Osullivan</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <h2>Ajouter un étudiant</h2>
        <?php
        if (isset($_POST["submit"])) {
        ?>
            <p>L'étudiant(e) <?php echo '<span class="green bold">' . $nomComplet . '</span>' ?> a été ajouté(e) avec succès</p>
        <?php } ?>
        <form method="post" action="ajouterEtudiant.php">
            <div class="champ">
                <label for="codePermanent">Code permanent:</label>
                <input type="text" id="codePermanent" name="codePermanent" placeholder="SMIJ220188" required="required">
            </div>
            <div class="champ">
                <label for="nomComplet">Nom complet:</label>
                <input type="text" id="nomComplet" name="nomComplet" placeholder="John Smith" required="required">
            </div>
            <div class="champ">
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" placeholder="123 rue du Programmeur" required="required">
            </div>
            <div class="champ">
                <label for="telephone">Téléphone:</label>
                <input type="text" id="telephone" name="telephone" placeholder="418-245-9995" required="required">
            </div>
            <div class="champ">
                <label for="moyenne">Moyenne:</label>
                <input type="number" step="0.01" id="moyenne" name="moyenne" min="0" max="20" placeholder="12" required="required">
            </div>
            <div class="champ">
                <label for='codeGroupe'>Choisir un groupe :</label>
                <select name='codeGroupe' id='codeGroupe' size='1'>
                    <option>Sélectionnez un groupe</option>
                    <?php include "fetchList.php";
                    fetchList("code", "groupe");
                    ?>
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