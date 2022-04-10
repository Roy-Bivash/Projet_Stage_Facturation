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




if (isset($_GET['ligne'])){
    $i = $_GET['ligne'];
    // $lesLignes = $_SESSION['ligneFacture'];
    // unset($_SESSION['ligneFacture'][$i]);
    array_splice($_SESSION['ligneFacture'], $i, 1);
    //header('Location:detailsFacture.php');
    ?>
      <script>window.location.replace("../.php");</script>
      <?php
}
?>