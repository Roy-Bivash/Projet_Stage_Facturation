<?php
session_start();
?>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Facture</title>
  </head>
  <body style="background-color: #1B2631; color: white;">

    <div class="container text-center">
      <br>
      <br>
      <h1>Connecter vous pour accéder aux factures</h1>
      <hr>

      <div style="margin-top: 21vh;">
        <div class="row justify-content-center">
          <div class="col-md-5">
              <div class="shadow-none p-3 mb-5 rounded" style="background-color:#212F3C">
                <form action="" method="POST">
                  <div class="mb-3">
                    <label class="form-label">Identifiant</label>
                    <input name="id" type="text" class="form-control" autocomplete="off" Required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mots de passe</label>
                    <input name="mdp" type="password" class="form-control" Required>
                  </div>
                  <button type="submit" class="btn btn-outline-success">Connexion</button>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
<?php
//Si l'utilisateur est deja connecter ou une session avec l'utilisateur existe deja :
if(isset($_SESSION['user'])){
  if($_SESSION['user']['statut'] == "vendeur"){
    //si l'utilisateur est un vendeur :
    //header("Status:compteVendeur/index.php");
    ?>
    <script>window.location.replace("compteVendeur/index.php");</script>
    <?php
  }
  else{
    if($_SESSION['user']['statut'] == "client"){
      //si l'utilisateur est un client :
      //header('Location:compteClient/index.php');
      ?>
      <script>window.location.replace("compteClient/index.php");</script>
      <?php
    }
  }
}

//Si l'utilisateur n'est pas encore connecter et essaie de se connecter grace au formulaire de la page :
if(isset($_POST['id']) && $_POST['mdp']){
  include 'bdd/cnx.php';
  //verification dans la base de données :
  $sql = $cnx->prepare("SELECT user.statut FROM user WHERE user.identifiant = ? AND user.mdp = ?;");
  $sql->bindValue(1,$_POST['id']);
  $sql->bindValue(2,$_POST['mdp']);
  $sql->execute();
  $resultat = $sql->fetch(PDO::FETCH_ASSOC);
  if($resultat){
    $_SESSION['user'] = array(
      "connexion" => true,
      "statut" => $resultat['statut'],
    );
    if($resultat['statut'] == "vendeur"){
      //si l'utilisateur est un vendeur :
      //header('Location:compteVendeur/index.php');
      ?>
      <script>window.location.replace("compteVendeur/index.php");</script>
      <?php
    }
    else{
      if($resultat['statut'] == "client"){
        //si l'utilisateur est un client :
        //header('Location:compteClient/index.php');
        ?>
      <script>window.location.replace("compteClient/index.php");</script>
      <?php
      }
    }
  }else{
    echo '<h5 class="text-center" style="color:red;">Les informations saisie sont incorrects</h5>';
  }
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

