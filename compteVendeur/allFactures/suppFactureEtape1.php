<?php
session_start();
//verrifcation de la connexion ainsi que le type d'utilisateur :
if(isset($_SESSION['user'])){
    if($_SESSION['user']['statut'] != "vendeur"){
        //si l'utilisateur n'est pas un vendeur :
        header('Location:../');
    }
}
else{
    //Si l'utilisateur n'existe pas :
    header('Location:../');
}

    
//Cette page est la premiere etape de suppression qui consiste a verrifier si l'tulisateur veut vraiment supprimer la facture

if(isset($_GET['numFacture'])){
    if($_GET['numFacture'] != ""){
        echo $_GET['numFacture'];
        ?>
        <script>
            if (confirm("Voulez vous vraiment supprimer la facture <?php echo $_GET['numFacture']; ?>") == true) {
                //Si l'ulisateur confirme la suppression :
                document.location.href="suppFactureEtape2.php?numFacture=<?php echo $_GET['numFacture']; ?>"; 
            } else {
                //Si l'utilisateur ne confirme pas la suppression : 
                document.location.href="../newFacture/clearSessionFacture.php"; 
            }

        </script>
        <?php
    }else{
        //header('Location:../newFacture/clearSessionFacture.php');
        ?>
        <script>window.location.replace("../newFacture/clearSessionFacture.php");</script>
        <?php
    }
}else{
    //header('Location:../newFacture/clearSessionFacture.php');
    ?>
    <script>window.location.replace("../newFacture/clearSessionFacture.php");</script>
    <?php
}

?>