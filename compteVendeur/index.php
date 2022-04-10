<?php
session_start();
//verrifcation de la connexion ainsi que le type d'utilisateur :
if(isset($_SESSION['user'])){
    if($_SESSION['user']['statut'] != "vendeur"){
      //si l'utilisateur n'est pas un vendeur :
      //header('Location:../');
    ?>
    <script>window.location.replace("../");</script>
    <?php
    }
}
else{
    //Si l'utilisateur n'existe pas :
    //header('Location:../');
    ?>
    <script>window.location.replace("../");</script>
    <?php
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Facture</title>
  </head>
  <body style="background-color: #1B2631; color: white;">
    <div class="text-end">
      <a href="../deconnexion.php" type="button" class="btn btn-outline-danger" style="margin-top: 20px; margin-right:20px;">Deconnexion</a>
    </div>

    <div class="container text-center">
      <br>
      <h1>Créer un pdf</h1>

      <div style="margin-top: 30vh;">
        <a href="newFacture/index.php" type="button" class="btn btn-outline-success" style="margin-top: 20px;">Créer une nouvelle facture</a>
        <a href="allFactures/index.php" type="button" class="btn btn-outline-light"style="margin-top: 20px;" >Consulter vos enciennes factures</a>
      </div>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>