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
  <body style="background-color:#1B2631; color:white;">

    <div class="container text-center">
        <br>
        <h3>Veuillez saisir les informations demandé</h3>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="shadow-none p-3 mb-5 rounded" style="background-color:#212F3C">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Numero de facture</label>
                            <input name="numFacture" type="text" class="form-control" Required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de facture</label>
                            <input name="dateFacture" type="date" class="form-control"Required>
                        </div>
                        <a href="../index.php" type="button" class="btn btn-outline-danger">Annuler</a>
                        <button type="submit" class="btn btn-outline-success">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

<?php
if(isset($_POST['numFacture']) && $_POST['dateFacture']){

    include '../../bdd/cnx.php';
    //verifier si le numero de facture existe deja dans la base de données
    $sql = $cnx->prepare("SELECT facture.id FROM facture WHERE facture.num_facture = ?;");
    $sql->bindValue(1,$_POST['numFacture']);
    $sql->execute();
    $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    //Si le numero de facture existe :
    if(!$resultat){
        $_SESSION['numFacture'] = $_POST['numFacture'];
        $_SESSION['dateFacture'] = $_POST['dateFacture'];
        $_SESSION['ligneFacture'] = [];

        //Redirection
        //header('Location:detailsFacture.php');
        ?>
      <script>window.location.replace("detailsFacture.php");</script>
      <?php
    }
    //Si le numero de facture n'existe pas :
    else{
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Le numero de facture "<?php echo $_POST['numFacture']; ?>" existe déja, veuillez en saisir un autre
            </div>
        </div>
        <?php
    }
}



?>