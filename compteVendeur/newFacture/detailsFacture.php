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
  $lesLignes = $_SESSION['ligneFacture'];
  // echo count($lesLignes);
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
        <h3>Saisir votre facture</h3>
        <br>
        <div class="shadow-none p-3 mb-5 rounded" style="background-color:#212F3C">
        <?php
        for($i = 0; $i < count($lesLignes); $i++){
          ?>
          <div class="shadow-none p-3 mb-5 rounded" style="background-color:#34495E">
            <div class="row">
              <div class="col-sm-3">
                <p><?php echo $lesLignes[$i]['code']; ?></p>
                <hr>
              </div>
              <div class="col-sm-3">
                <p><?php echo $lesLignes[$i]['desc']; ?></p>
                <hr>
              </div>
              <div class="col-sm-3">
                <p><?php echo $lesLignes[$i]['qte']; ?></p>
                <hr>
              </div>
              <div class="col-sm-3">
                <p><?php echo $lesLignes[$i]['prix']; ?> €</p>
                <hr>
              </div>
            </div>
            <div class="text-center">
                <!-- Button trigger modal -->
                <a type="button" href="supprimerLigne.php?ligne=<?php echo $i; ?>"class="btn btn-outline-warning">Supprimer la ligne</a>
            </div>
          </div>
        
          <?php
        }
        ?>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutLigne">Ajouter une ligne</button>
        <a href="../creation/newFacture.php" type="button" class="btn btn-success" >Valider</a>
        <a href="../index.php" type="button" class="btn btn-outline-danger">Annuler</a>
        <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#annuler">Annuler</button> -->

        <!-- Modal -->
        <div class="modal fade" id="ajoutLigne" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Veuillez saisire les informations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="ajoutLigne.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" Required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="desc" class="form-control" Required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantité</label>
                        <input type="number" name="qte" class="form-control" Required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix Hunitaire</label>
                        <input type="number" step="0.01" name="prix" class="form-control" Required>
                    </div>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>
        
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>



