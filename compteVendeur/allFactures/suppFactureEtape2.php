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
    
    
//Ceci est la deuxieme pas de suppression
//Cette page supprime la facture et ces lignes
include '../../bdd/cnx.php';
if(isset($_GET['numFacture'])){
    if($_GET['numFacture'] != ""){ 
        echo $_GET['numFacture'];       
        //Suppression de des Lignes de la facture grace à la premiere requette, puis suppression de la facture grace à la deuxieme requette
        //La suppression doit imperativement etre faite dans cette ordre : 1. Suppression des lignes, 2. Suppression de la facture
        $sql = $cnx->prepare("DELETE FROM `ligne_facture` WHERE ligne_facture.num_facture = ? ;DELETE FROM `facture` WHERE facture.num_facture = ? ;");
        $sql->bindValue(1,$_GET['numFacture']);
        $sql->bindValue(2,$_GET['numFacture']);
        $sql->execute();
        //Redirection :
        //header('Location:../allFactures/index.php');
        ?>
        <script>window.location.replace("../allFactures/index.php");</script>
        <?php
    }else{
        //header('Location:../allFactures/index.php');
        ?>
        <script>window.location.replace("../allFactures/index.php");</script>
        <?php
    }
}else{
    //header('Location:../allFactures/index.php');
    ?>
    <script>window.location.replace("../allFactures/index.php");</script>
    <?php
}


?>