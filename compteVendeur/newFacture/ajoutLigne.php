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

if(isset($_POST['code'])&&isset($_POST['desc'])&&isset($_POST['qte'])&&isset($_POST['prix']) ){

    // echo $_POST['code'];
    // echo $_POST['desc'];
    // echo $_POST['qte'];
    // echo $_POST['prix'];

    $laLigne = [
        "code" => $_POST['code'],
        "desc" => $_POST['desc'],
        "qte" => $_POST['qte'],
        "prix" => $_POST['prix'],
    ];

    $_SESSION['ligneFacture'][] = $laLigne;
    //header('Location:detailsFacture.php');
      ?>
      <script>window.location.replace("detailsFacture.php");</script>
      <?php


}else{
    echo '<p>Une erreur technique est survenue, veuillez relancer la page</p>';
}

?>