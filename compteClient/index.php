<?php
session_start();

//verrifcation de la connexion ainsi que le type d'utilisateur :
  if(isset($_SESSION['user'])){
    if($_SESSION['user']['statut'] != "client"){
      //si l'utilisateur n'est pas un client :
      header('Location:../');
    }
}
else{
    //Si l'utilisateur n'existe pas :
    header('Location:../');
}


include '../bdd/cnx.php';
$sql = $cnx->prepare("SELECT facture.num_facture, facture.date_facture, facture.total_ttc, destinataire.raison_social FROM facture INNER JOIN destinataire ON facture.num_destinataire = destinataire.id_destinataire;");
$sql->execute();
$lesFactures = $sql->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="text-end">
      <a href="../deconnexion.php" type="button" class="btn btn-outline-danger" style="margin-top: 20px; margin-right:20px;">Deconnexion</a>
    </div>
    <div class="container text-center">
        <br>
        
        <h3>Toutes les factures</h3>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="shadow-none p-3 mb-5 rounded" style="background-color:#212F3C">
                <br>
                <?php
                foreach ($lesFactures as $uneFacture){
                    ?>
                    <div class="shadow-none p-3 mb-5 rounded" style="background-color:#34495E">
                        <div class="row">
                            <div class="col-sm-3">
                            <p>N° <?php echo $uneFacture['num_facture']; ?></p>
                            <hr>
                            </div>
                            <div class="col-sm-3">
                            <p><?php echo date("d/m/Y", strtotime($uneFacture['date_facture']));  ?></p>
                            <hr>
                            </div>
                            <div class="col-sm-3">
                            <p><?php echo $uneFacture['raison_social']; ?></p>
                            <hr>
                            </div>
                            <div class="col-sm-3">
                            <p><?php echo $uneFacture['total_ttc']; ?> € TTC</p>
                            <hr>
                            </div>
                        </div>
                        <div class="text-center">
                            <!-- Button trigger modal -->
                            <a href="consulter.php?numFacture=<?php echo $uneFacture['num_facture'];?>"type="button" class="btn btn-outline-success">Consulter</a>
                        </div>
                        
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>


        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
