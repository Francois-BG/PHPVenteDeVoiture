<?php
ob_start();
session_start();
require_once('DATA_connect.php');
if ($_SESSION['logged_in'] != true) {
  header('Location:login.php');
        exit;
}

include("connection.php");

$requete = $bdd->query("SELECT * FROM Client");
$total = 0;

if(isset($_POST["selectionner"]))
{
    $nom = $_POST["selection"];
    $date = $_POST["date_achat"];
    $requete2 = $bdd->query("SELECT Client.IDcli,Client.Nom,Voiture.Prix,Voiture.Design,Voiture.IDvoit,Achat.Qte,(Voiture.Prix*Achat.Qte) as montant 
                            FROM Client,Voiture,Achat 
                            WHERE (Client.IDcli=Achat.IDCli) AND (Achat.IDvoit=Voiture.IDvoit) AND (Achat.IDCli = '$nom') /*AND (Achat.Date='$date')*/ ");
    $donne2 = $requete2->fetchAll();

}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <link rel="stylesheet" href="BOOTSTRAP/bootstrap-offline-docs-5.1/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
   <script src="BOOTSTRAP/js/bootstrap.min.js" ></script>
    <script src="BOOTSTRAP/bootstrap-offline-docs-5.1/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="Gestion bg-dark text-white ">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="Gest nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <span class="fs-4 mt-1"><p class="Titre h1 " >GESTION DE VENTE DE VOITURE</p></span>
        </ul>

        
        <form class=" col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 "  method="GET">
          <!-- <label class="col-sm-4 form-label"  for="RECHERCHE"><h6>RECHERCHE :</h6></label> -->
          <div class="recherche" >
          <input class="form-control" type="search" placeholder="" name="Tapez_Ici" >
          
          <div class="actualiser" >
          <button class="Supp btn btn-primary icon-search " type = "submit" name = "recherche" ></button>
          <button id="actualiser" class="actualiser  btn btn-dark icon-refresh " type = "submit" name = "actualiser" ></button>
          </div>
          </div>  
        </form>
        </div>


      </div>
</div>

<main>
  <div class="NAV d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li><img src="Images/logo.png" class="GestionLogo rounded rounded-circle img-fluid " alt="Client" width="200" height="200"></li>
      <li >
        <a href="Dashboard.php" class="nav-link text-white " aria-current="page">
          <svg class="bi me-2 " width="16" height="16"><use xlink:href="#home"></use></svg>
          <span class="icon-bar-chart" ></span><span class="Titre" >    STATISTIQUE</span> 
        </a>
      </li>
      <li class="nav-item " >
        <a href="Affiche_Client.php" class="nav-link text-white ">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          <span class="icon-group"></span><span class="Titre" >    CLIENTS</span> 
        </a>
      </li>
      <li>
        <a href="Affiche_Voiture.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          <span class="icon-truck"></span><span class="Titre" >    VOITURES</span> 
        </a>
      </li>
      <li>
        <a href="Affiche_Achat.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          <span class="icon-shopping-cart"></span><span class="Titre" >    ACHATS</span> 
        </a>
      </li>
      <li>
        <a href="#" class="nav-link active">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          <span class="icon icon-list-alt"></span><span class="Titre" >    FACTURES</span> 
        </a>
      </li>
    </ul>
    <hr>
    <div class="btn">
      <a href="logout.php" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1" >
        <strong><span class="icon icon-signout" ></span class="Titre" >        Deconnexion</strong>
      </a>
      </div>
  </div>
  <div class="ListeClient">
 
  <div class="facture">
  <div>
  <h1 id="edition" >Editionner une facture</h1>
  </div>
    <div class="container-fluid">
            <div class="col-lg-10">
                <form id="form" action="" method="post">
                <div class="row mb-20">
                  <label class="col-sm-3 col form-label" for="selection"><h5>CLIENT:</h5></label>
                  <div class="col-sm-5" > 
                    <select id="selection" name="selection" class="form-control">
                      <?php while($donne = $requete->fetch()) : ?>
                      <option value="<?php echo $donne["IDcli"]; ?>"><?php echo "Cl ".$donne['IDcli']."-".$donne['Nom']; ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-20" >
                  <!-- <label class="col-sm-3 col form-label" for="date_achat"><h5>Date Achat :</h5></label> -->
                  <div class="col-sm-5" >
                    <input id="date_achat" class="form-control" type="hidden" name="date_achat" >
                  </div>
                </div>
                <br>
                <button type="submit" class="Aperçu btn btn-dark" name="selectionner" onclick="submitForm()" data-bs-toggle="modal" data-bs-target="#facture" >Afficher l'aperçu</button>
              </form>
            </div>        
        </div>
        
      </div>
    </div>
<!-------------------------------------------------Modal_Facture-------------------------------------------->
<?php if (isset($_POST['selectionner'])) {
  
echo '
<div class="modal fade" id="facture" tabindex="-1" aria-labelledby="factureLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-dialog">
      <div class="MODAL modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="factureLabel">Aperçu de la Facture</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> 
        <div class="modal-body">
        <div class="">
                <table  class="table table-striped table-hover " style ="width:100%;" >
                    <thead>
                        <tr class="table-dark" >
                            <th>ID voiture</th>
                            <th>Design</th>
                            <th>PU (Ar)</th>
                            <th>QTE</th>
                            <th>Montant (Ar)</th>
                        </tr>
                    </thead>'
?>
                    <?php if(isset($donne2)) : ?>
                        <?php foreach ($donne2 as $val) : 
                        
                        ?>
                            <tr>
                                <td><?php echo $val["IDvoit"]; ?></td>
                                <td><?php echo $val["Design"]; ?></td>
                                <td><?php echo number_format($val["Prix"],2); ?></td>
                                <td><?php echo $val["Qte"]; ?></td>
                                <td><?php echo number_format($val["montant"],2); ?></td>
                            </tr>
                        <?php
                                $total += intval($val["montant"]); endforeach; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>TOTAL</strong></td>
                            <td><?php echo $total; ?></td>
                        </tr>

                        
                    <?php endif; ?>
                </table>
                <?php if(isset($donne2)) : ?>
                  <div class="modal-footer">
                  <a class="Print btn btn-primary icon-print" href="Versionpdf.php?id=<?php echo $nom ?>" target="_blank"></a>
                  </div>
                <?php endif; ?>             
          <?php echo '  </div>
        </div>
      </div>
    </div>
  </div>
</div> ';
} 

?>
<!---------------------------------------------------------------------------------------------------------->
</main>
<script>
function submitForm() {
  document.querySelector('form').submit();
}

// Code pour afficher le modal une fois que la page est chargée
window.addEventListener('load', function() {
  var myModal = new bootstrap.Modal(document.getElementById('facture'));
  myModal.show();
});
</script>

</body>
</html>