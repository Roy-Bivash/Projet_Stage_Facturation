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
  $prixTotalHT = 0;
}



?>

<!DOCTYPE html>
<html>
<head>
	 
	<title>Facture</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="This ">

	<meta name="author" content="Code With Mark">
	<meta name="authorUrl" content="http://codewithmark.com">

	<!--[CSS/JS Files - Start]-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>

 

	<script type="text/javascript">
	$(document).ready(function($) 
	{ 

		$(document).on('click', '.btn_print', function(event) 
		{
			event.preventDefault();

			//credit : https://ekoopmans.github.io/html2pdf.js
			
			var element = document.getElementById('container_content'); 

			//easy
			html2pdf().from(element).save();

			//custom file name
			//html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


			//more custom settings
			// var opt = 
			// {
			//   margin:       1,
			//   filename:     'facture_'+js.AutoCode()+'.pdf',
			//   image:        { type: 'jpeg', quality: 0.98 },
			//   html2canvas:  { scale: 2 },
			//   jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			// };
			// // New Promise-based usage:
			// html2pdf().set(opt).from(element).save();

		});
	});
	</script>

	 

</head>
<body>

<div class="text-center" style="padding:20px;">
	<input type="button" value="Télécharger" class="btn btn-outline-primary btn_print">
    <a href="../newFacture/detailsFacture.php" type="button" class="btn btn-outline-danger">Modifier</a>
    <a href="enregistrement.php" type="button" class="btn btn-outline-dark">Enregistrer et quitter</a>
</div>


<div class="container shadow-lg p-3 mb-5 bg-body rounded" id="container_content">
		
    <div class="row">
      <div class="col-6">
        <div style="margin-top:30px;margin-left:30px">
          <h1>Laxmi</h1>
          <p>83 rue des cités<br>93300 Aubervilliers<br>TVA Intra : FR51881573067</p>
        </div>
      </div>
      <div class="col-6 text-end">
      <h1>Facture</h1>
        <h6>Date: <?php echo $_SESSION['dateFacture'] ?><br>N° : <?php echo $_SESSION['numFacture'] ?></h6>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-5">
        <h5>Halogene</h5>
        <p>74 rue des Faubourg Saint Denis<br>75010 Paris<br>TVA Intra : FR09383119153</p>
      </div>
    </div>
    <br><br>
    <table class="table">
      <thead>
        <tr  class="table-dark">
          <th scope="col">CODE</th>
          <th scope="col">DÉSCRIPTION</th>
          <th scope="col" class="text-end">Qté</th>
          <th scope="col" class="text-end">PRIX H.T</th>
          <th scope="col" class="text-end">TOTAL</th>
        </tr>
      </thead>
      <tbody>

        <?php
            foreach ($lesLignes as $laLigne){
                // var_dump($laLigne);
                $prixHT = $laLigne['qte']*$laLigne['prix'];
                $prixTotalHT = $prixTotalHT + $prixHT;
                ?>
                <tr>
                    <td><?php echo $laLigne['code'];?></td>
                    <td><?php echo $laLigne['desc'];?></td>
                    <td class="text-end"><?php echo $laLigne['qte'];?></td>
                    <td class="text-end"><?php echo $laLigne['prix'];?> €</td>
                    <td class="text-end"><?php echo $prixHT; ?> €</td>
                </tr>
                <?php
            }
            $tvaTotal = round($prixTotalHT*0.2, 2);
            $prixTTC = round($prixTotalHT*1.2, 2);
            //Enregistrement du prix facture dans la session pour l'enreistrement dans la base de données dans la page enregistrement.php
            $_SESSION['prixFactureTTC'] = $prixTTC;
        ?>
      </tbody>
    </table>
    <br>
    <div class="row justify-content-end">
      <div class="col-5">
        <table class="table">
      <thead>
        <tr  class="table-dark">
          <th scope="col">TOTAL H.T</th>
          <th scope="col">TVA - 20%</th>
          <th scope="col">TOTAL TTC</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-end"><?php echo $prixTotalHT ; ?> €</td>
          <td class="text-end"><?php echo $tvaTotal; ?> €</td>
          <td class="text-end"><?php echo $prixTTC; ?> €</td>
        </tr>
      </tbody>
    </table>
      </div>
    </div>
</div>



</body>
</html>