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
    
    
if(isset($_GET['numFacture'])){
    if($_GET['numFacture'] != ""){
        //Mettre la variable de session ligneFacture à 0 :
        $_SESSION['ligneFacture'] = [];
        
        include '../../bdd/cnx.php';

        //Recuperation de la date de facturation :
        $sqlInfosFacture = $cnx->prepare("SELECT facture.date_facture FROM facture WHERE facture.num_facture = ?;");
        $sqlInfosFacture->bindValue(1,$_GET['numFacture']);
        $sqlInfosFacture->execute();
        $infosFacture = $sqlInfosFacture->fetchAll(PDO::FETCH_ASSOC);

        //Stockage des données en session :
        $_SESSION['dateFacture'] = $infosFacture[0]['date_facture'];
        $_SESSION['numFacture'] = $_GET['numFacture'];

        //Recuperation des données des lignes de la facture :
        $sqlLigneFacture = $cnx->prepare("SELECT ligne_facture.desc_code, ligne_facture.description, ligne_facture.quantite, ligne_facture.prix_unitaire_ht FROM ligne_facture WHERE num_facture = ?;");
        $sqlLigneFacture->bindValue(1,$_GET['numFacture']);
        $sqlLigneFacture->execute();
        $ligneFacture = $sqlLigneFacture->fetchAll(PDO::FETCH_ASSOC);

        //Parcour les lignes :
        foreach ($ligneFacture as $laLigne){
            $laLigne = [
                "code" => $laLigne['desc_code'],
                "desc" => $laLigne['description'],
                "qte" => $laLigne['quantite'],
                "prix" => $laLigne['prix_unitaire_ht'],
            ];
            //Stockage des données en session :
            $_SESSION['ligneFacture'][] = $laLigne;
        }
        
        //Redirection une fois tous fini : 
        //header('Location:../creation/viewOnly.php');
        ?>
        <script>window.location.replace("../creation/viewOnly.php");</script>
        <?php
    }else{
        //Redirection en cas de numero de facture manquant :
        //header('Location:../newFacture/clearSessionFacture.php');
        ?>
        <script>window.location.replace("../newFacture/clearSessionFacture.php");</script>
        <?php
    }
}else{
    //Redirection en cas de numero de facture manquant :
    //header('Location:../newFacture/clearSessionFacture.php');
    ?>
    <script>window.location.replace("");</script>
    <?php
}


?>