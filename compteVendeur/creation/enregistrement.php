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


if(!isset($_SESSION['dateFacture']) && !isset($_SESSION['numFacture'])){
  echo '<script>window.alert("Une erreur de passage de données est survenue")</script>';
}else{
  include '../../bdd/cnx.php';

  $sql = $cnx->prepare("INSERT INTO `facture`(`id`, `num_facture`, `num_destinataire`, `date_facture`, `total_ttc`) VALUES (null,?,'1',?,?);");
  $sql->bindValue(1,$_SESSION['numFacture']);
  $sql->bindValue(2,$_SESSION['dateFacture']);
  $sql->bindValue(3,$_SESSION['prixFactureTTC']);
  $sql->execute();




  $lesLignes = $_SESSION['ligneFacture'];
  $prixTotalHT = 0;
  foreach ($lesLignes as $laLigne){
    $prixHT = $laLigne['qte']*$laLigne['prix'];
    $prixTotalHT = $prixTotalHT + $prixHT;
    //var_dump($laLigne);
    $sql = $cnx->prepare("INSERT INTO `ligne_facture`(`id_ligne`, `num_facture`, `desc_code`, `description`, `quantite`, `prix_unitaire_ht`) VALUES (null,?,?,?,?,?);");
    $sql->bindValue(1,$_SESSION['numFacture']);
    $sql->bindValue(2, $laLigne['code']);
    $sql->bindValue(3, $laLigne['desc']);
    $sql->bindValue(4, $laLigne['qte']);
    $sql->bindValue(5, $laLigne['prix']);
    $sql->execute();
  }
}
//Une fois l'enregistrement terminer
//Redirection vers la page de consultation des factures
//header('Location:../newFacture/clearSessionFacture.php');
?>
<script>window.location.replace("../newFacture/clearSessionFacture.php");</script>
<?php


?>
