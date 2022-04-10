<?php
//Cette page ne detruit pas la session mais efface la varriable de session appler $_SESSION['ligneFacture'],
//se qui a pour but d'effacer la facture enregistrer
session_start();
if(!isset($_SESSION['dateFacture']) && !isset($_SESSION['numFacture'])){
  echo '<script>window.alert("Une erreur de passage de données est survenue")</script>';
}else{
  $_SESSION['ligneFacture'] = [];
//   var_dump($_SESSION['ligneFacture']);
  //header('Location:../index.php');
      ?>
      <script>window.location.replace("../index.php");</script>
      <?php
  
}



?>