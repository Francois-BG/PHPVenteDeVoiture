<?php
ob_start();
    session_start();
    if ($_SESSION['logged_in'] != true) {
      header('Location:login.php');
			exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listage_Client</title>
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
        <span class="fs-4 mt-1"><p id="myText" class="GEST Titre h1 " >GESTION DE VENTE DE VOITURE</p></span>
        </ul>
        <script>
          const textArray = ["GESTION DE VENTE DE VOITURE", "NOUVEAUX ARRIVAGES", "PROMOTIONS EXCEPTIONNELLES"];
          let i = 0;
          const myText = document.getElementById("myText");

          setInterval(function() {
            myText.innerHTML = textArray[i];
            i++;
            if (i >= textArray.length) {
              i = 0;
            }
          }, 5000); // change le texte toutes les 1000ms (1 seconde)

        </script>
        
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
      <li><img id="GestionLogo" src="Images/logo.png" class="GestionLogo rounded rounded-circle img-fluid " alt="Client" width="200" height="200"></li>
      <li >
        <a href="Dashboard.php" class="nav-link text-white " aria-current="page">
          <svg class="bi me-2 " width="16" height="16"><use xlink:href="#home"></use></svg>
          <span class="icon-bar-chart" ></span><span class="Titre" >    STATISTIQUE</span> 
        </a>
      </li>
      <li class="nav-item " >
        <a href="#" class="nav-link active ">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          <span class="icon icon-group"></span><span class="Titre" >    CLIENTS</span> 
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
        <a href="Facturation.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          <span class="icon-list-alt"></span><span class="Titre" >    FACTURES</span> 
        </a>
      </li>
    </ul>
    <hr>
    <div class="btn">
      <a href="logout.php" class="d-flex align-items-center text-white text-decoration-none " >
        <strong><span class="icon icon-signout" ></span class="Titre" >        Deconnexion</strong>
      </a>
      </div>
  </div>


    <div class="ListeClient  p-2 text-dark bg-opacity-10 ">
  
  <!-- <h2>Liste des CLIENTS :</h2>   -->

    <table class="table table-striped table-hover " style ="width:100%;" > 
        <tr class="table-dark" >
            <th>ID</th>
            <th></th><th></th><th></th><th></th>
            <th>Nom</th>
            <th></th><th></th><th></th>
            <th>Contact</th>
            <th></th>
            <th></th>
            <th></th>
            <th>Option</th>
            <th></th><th></th><th></th>
        </tr>
    <!-- Code PHP -->
            <?php
            include 'DATA_connect.php';
            include 'delete_voiture.php';

            $Client = "SELECT * FROM Client ORDER BY IDcli";
            $resultat = mysqli_query($connex,$Client);
  
            if (isset($_GET["Tapez_Ici"]) && !empty($_GET["Tapez_Ici"]) ) {

              $recherche = htmlspecialchars(str_replace("Cl","",$_GET["Tapez_Ici"]));
              $Client = "SELECT IDcli,Nom FROM Client WHERE Nom LIKE '%$recherche%'
                        OR IDcli LIKE '%$recherche%' ORDER BY IDcli ";
              $resultat = mysqli_query($connex,$Client);

              $num=mysqli_num_rows($resultat);
              $numeroPage=5;
              $totalPages=ceil($num/$numeroPage);

             //Bouton de Pagination

             for ($btn=1; $btn <= $totalPages ; $btn++ ) {
              echo '
              <a href="Affiche_Voiture.php?page='.$btn.'" class="text-white Pagination " >
              <button class="Supp btn btn-dark mx-1 my-3 ">'.$btn.'</button></a>';
            } 

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }else {
                 $page = 1;
            }
            
            $stratinglimit=($page-1)*$numeroPage;
            $sql = "SELECT * FROM Client WHERE Nom LIKE '%$recherche%' OR IDcli LIKE '%$recherche%' LIMIT " .$stratinglimit.
            ','.$numeroPage;
            $resultat = mysqli_query($connex,$sql);

            while($row = mysqli_fetch_assoc($resultat)){

                $IDcli = $row['IDcli'];
                $Nom = $row['Nom'];
                $Contact = $row['Contact'];

                echo "<tr>
                <td>Cl ".$IDcli."</td>
                <td></td><td></td><td></td><td></td>
                <td>".$Nom."</td>
                <td></td><td></td><td></td>
                <td>".$Contact."</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <button type='button' class='ModifCli btn btn-dark' data-bs-toggle='modal' data-bs-target='#ModifCli'>
                <span class='icon-edit'></span>
                </button>
                </td>";
              ?>
                <td>
                <button type="button" class="SuppCli btn btn-danger" data-bs-toggle="modal" data-bs-target="#SuppCli">
                  <span class="icon-trash"></span>
                  </button>    
                  </td>
                  <td></td><td></td>
                  </tr>
             <?php   
            }

            }else {
              $sql = "SELECT * FROM Client";
            $resultat = mysqli_query($connex,$sql);

            $num=mysqli_num_rows($resultat);
            $numeroPage=5;
            $totalPages=ceil($num/$numeroPage);

            //Bouton de Pagination

            for ($btn=1; $btn <= $totalPages ; $btn++ ) {
              echo '
              <a href="Affiche_Client.php?page='.$btn.'" class="text-white Pagination " >
              <button class="Supp btn btn-dark mx-1 my-3 ">'.$btn.'</button></a>';
            } 

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }else {
                 $page = 1;
            }
            
            $stratinglimit=($page-1)*$numeroPage;
            $sql = "SELECT * FROM Client LIMIT " .$stratinglimit.
            ','.$numeroPage;
            $resultat = mysqli_query($connex,$sql);

            while($row = mysqli_fetch_assoc($resultat)){

                $IDcli = $row['IDcli'];
                $Nom = $row['Nom'];
                $Contact = $row['Contact'];

                echo "<tr>
                <td>Cl ".$IDcli."</td>
                <td></td><td></td><td></td><td></td>
                <td>".$Nom."</td>
                <td></td><td></td><td></td>
                <td>".$Contact."</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <button type='button' class='ModifCli btn btn-dark' data-bs-toggle='modal' data-bs-target='#ModifCli'>
                <span class='icon-edit'></span>
                </button>
                </td>";
                ?>
                  <td>
                  <button type="button" class="SuppCli btn btn-danger" data-bs-toggle="modal" data-bs-target="#SuppCli">
                  <span class="icon-trash"></span>
                  </button>  
                  </td>
                  <td></td><td></td>
                  </tr>
              <?php
            }

            }


            
            ?>
    
        </table>
        <button type="button" class="Supp btn btn-dark" data-bs-toggle="modal" data-bs-target="#ajoutCli">
        <span class="icon-plus" ></span>
        </button>
        
    </div>
<!--------------------------------------------------------Modal_Ajout_Client-------------------------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="ajoutCli" tabindex="-1" aria-labelledby="ajoutCliLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-dialog">
    <div class="MODAL modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ajoutCliLabel">Nouveau CLIENT  :</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  class="row g-3  rounded float-start " action="Ajout_Client.php" method="POST">
            <div class="row mb-3">
                        <?php 
                            
                            if (!empty($Erreur)) {
                                echo "
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        <strong>$Erreur</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
                                    </div>
                                ";
                                
                            }
                        
                        ?>
                </div>
                <div class="row mb-3">
                        <label class="col-sm-3 col form-label">NOM :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="Nom" require >
                            </div>
                </div>
                <div class="row mb-3">
                        <label class="col-sm-3 col form-label">CONTACT:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="Contact" require>
                            </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-dark" value = "Ajouter" name="Ajouter" >Ajouter</button>
                <a class="btn btn-danger" href="Affiche_Client.php" role="button" data-bs-dismiss="modal">Annuler</a>
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div>
  
</div>

<!----------------------------------------------------------------Modal_Modif_Client----------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="ModifCli" tabindex="-1" aria-labelledby="ModifClilLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-dialog">
    <div class="MODAL modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModifCliLabel">Modification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="Modif_Client.php" method="POST">
                <input id="IDCli" type="hidden" name="IDcli" value="">
                  <div class="row mb-3">
                          <label class="col-sm-3 col form-label">NOM :</label>
                              <div class="col-sm-6">
                              <input id="NomCli" class="form-control" type="text" name = "Nom" value = "" require >
                              </div>
                      </div>
                      <div class="row mb-3">
                          <label class="col-sm-3 col form-label">CONTACT:</label>
                              <div class="col-sm-6">
                              <input id="ContactCli" class="form-control" type="text" name = "Contact" value = "" require >
                              </div>
                      </div>
                      <div class="modal-footer">
                      <input class="btn btn-dark " type="submit" value = "Modifier" name="Modifier">
                      <a class="btn btn-danger" href="Affiche_Client.php" role="button" data-bs-dismiss="modal">Annuler</a>
                      </div>  
                      

      </form>
      </div>
    </div>
  </div>
</div>
  
</div>

<!------------------------------------Modal_Supp_Client-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="SuppCli" tabindex="-1" aria-labelledby="SuppCliLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-dialog">
    <div class="MODAL modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SuppCliLabel">Voulez-vous supprimer ce client ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="Supp_Client.php" method="POST">
                <input id="IDCli" type="hidden" name="IDcli" value="">
                <div class="modal-footer">
                <input class="btn btn-danger " type="submit" value = "Supprimer" name="Supprimer">
                <a class="btn btn-secondary" href="Affiche_Client.php" role="button" data-bs-dismiss="modal">Annuler</a>
                </div>
      </form>      
    </div>
  </div>
</div>
  
</div>

<!---------------------------------------------------------------------------------------------------------------------->

    <script>
      $(document).ready(function(){
        $('.ModifCli').on('click',function(){
          $tr=$(this).closest('tr');
          var data = $tr.children("td").map(function(){
              return $(this).text();
          }).get();

          console.log(data);

          $('#ModifCli #IDCli').val(data[0]);
          $('#ModifCli #NomCli').val(data[5]);
          $('#ModifCli #ContactCli').val(data[9]);

        });
      });

      $(document).ready(function(){
        $('.SuppCli').on('click',function(){
          $tr=$(this).closest('tr');
          var data = $tr.children("td").map(function(){
              return $(this).text();
          }).get();

          console.log(data);

          $('#SuppCli #IDCli').val(data[0]);

        });
      });
      



    </script>


</main>

</body>
</html>