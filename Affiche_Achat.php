<?php
ob_start();
		session_start();
		require_once('DATA_connect.php');
		if ($_SESSION['logged_in'] != true) {
			header('Location:login.php');
			exit;
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Affiche_Client</title>
		<link rel="stylesheet" href="BOOTSTRAP/bootstrap-offline-docs-5.1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
		<script src="jquery-3.6.0.min.js"></script>
		<script src="BOOTSTRAP/js/bootstrap.min.js"></script>
		<script src="BOOTSTRAP/bootstrap-offline-docs-5.1/dist/js/bootstrap.bundle.min.js"></script>
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
				<a href="Affiche_Achat.php" class="nav-link active">
					<svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
					<span class="icon icon-shopping-cart"></span><span class="Titre" >    ACHATS</span> 
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
      <a href="logout.php" class="d-flex align-items-center text-white text-decoration-none ">
        <strong><span class="icon icon-signout" ></span class="Titre" >        Deconnexion</strong>
      </a>
      </div>
	</div>

	<div class="ListeClient  p-2 text-dark bg-opacity-10 ">

	<!-- <h2>Liste des ACHATS :</h2> -->
	<form class="" method="GET">
			<label class="col-sm-1 form-label"  for="RECHERCHE"><h6>Du :</h6></label>
			<div class="recherche" >
			<input class="form-control" type="date" name="Date_debut" >
			</div>
			<label class="col-sm-1 form-label"  for="RECHERCHE"><h6>Au :</h6></label>
			<div class="recherche" >
			<input class="form-control" type="date" name="Date_fin" >
			</div>
			<div class="actualiser" >
			<button class="actualiser Supp  btn btn-secondary icon-ok " type = "submit" name = "Entrer" ></button>
			</div>
			
			
		</form>

		<table class="table table-striped table-hover " style ="width:100%;" > 
				<tr class="table-dark" >
						<th>N° Achat</th>
						<th></th>
						<th>IDclient</th>
						<th></th>
						<th>IDvoiture</th>
						<th>Date</th>
						<th></th><th></th>
						<th>Qte</th>
						<th></th><th></th><th></th><th></th><th></th>
						<th>Option</th>
						<th></th><th></th><th></th>
				</tr>
		<!-- Code PHP -->



						<?php 
						include 'DATA_connect.php';

						$Client = "SELECT * FROM Achat ORDER BY NumAchat";
						$resultat = mysqli_query($connex,$Client);
	
						if (isset($_GET["Tapez_Ici"]) && !empty($_GET["Tapez_Ici"]) ) {

							$recherche = htmlspecialchars(str_replace("A","",$_GET["Tapez_Ici"]));
							$Client = "SELECT NumAchat,IDCli FROM Achat WHERE NumAchat LIKE '%$recherche%' ORDER BY NumAchat ";
							$resultat = mysqli_query($connex,$Client);

							$num=mysqli_num_rows($resultat);
							$numeroPage=5;
							$totalPages=ceil($num/$numeroPage);

						 //Bouton de Pagination

						 for ($btn=1; $btn <= $totalPages ; $btn++ ) {
							echo '
							<a href="Affiche_Achat.php?page='.$btn.'" class="text-white Pagination " >
							<button class="Supp btn btn-dark mx-1 my-3 ">'.$btn.'</button></a>';
						} 

						if (isset($_GET['page'])) {
								$page = $_GET['page'];
						}else {
								 $page = 1;
						}
						
						$stratinglimit=($page-1)*$numeroPage;
						$sql = "SELECT * FROM Achat WHERE NumAchat LIKE '%$recherche%' LIMIT " .$stratinglimit.
						','.$numeroPage;
						$resultat = mysqli_query($connex,$sql);

						while($row = mysqli_fetch_assoc($resultat)){

							$NumAchat = $row['NumAchat'];
							$IDcli = $row['IDCli'];
							$IDvoit = $row['IDvoit'];
							$Date = $row['Date'];
							$Qte = $row['Qte'];

							echo "<tr>
							<td>A ".$NumAchat."</td>
							<td></td>
							<td>Cl ".$IDcli."</td><td></td>
							<td>V ".$IDvoit."</td>
							<td>".$Date."</td>
							<td></td><td></td>
							<td>".$Qte."</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
							<button type='button' class='Modif btn btn-dark icon-edit' data-bs-toggle='modal' data-bs-target='#Modif'>
									</td>";
									?>
										<td>
										<button type="button" class="Supp btn btn-danger" data-bs-toggle="modal" data-bs-target="#Supp">
												<span class="icon-trash"></span>
											</button>
											</td>
											<td></td><td></td>
											</tr>
								 <?php 
					}

					}elseif (isset($_GET['Entrer'])) {

						$date_debut = $_GET['Date_debut'];
						$date_fin = $_GET['Date_fin'];

						$date_debut = mysqli_real_escape_string($connex, $date_debut);
						$date_fin = mysqli_real_escape_string($connex, $date_fin);

						$achat = "SELECT * FROM Achat WHERE Date BETWEEN '$date_debut' AND '$date_fin' order by Date";

						$resultat = mysqli_query($connex,$achat);

						$num=mysqli_num_rows($resultat);
						$numeroPage=5;
						$totalPages=ceil($num/$numeroPage);

					 //Bouton de Pagination

					 for ($btn=1; $btn <= $totalPages ; $btn++ ) {
						echo '
						<a href="Affiche_Achat.php?page='.$btn.'" class="text-white Pagination " >
						<button class="Supp btn btn-dark mx-1 my-3 ">'.$btn.'</button></a>';
					} 

					if (isset($_GET['page'])) {
							$page = $_GET['page'];
					}else {
							 $page = 1;
					}
					
					$stratinglimit=($page-1)*$numeroPage;
					$sql = "SELECT * FROM Achat WHERE Date BETWEEN '$date_debut' AND '$date_fin' order by Date LIMIT " .$stratinglimit.
					','.$numeroPage;
					$resultat = mysqli_query($connex,$sql);

					while($row = mysqli_fetch_assoc($resultat)){

						$NumAchat = $row['NumAchat'];
						$IDcli = $row['IDCli'];
						$IDvoit = $row['IDvoit'];
						$Date = $row['Date'];
						$Qte = $row['Qte'];

						echo "<tr>
						<td>A ".$NumAchat."</td>
						<td></td>
						<td>Cl ".$IDcli."</td><td></td>
						<td>V ".$IDvoit."</td>
						<td>".$Date."</td>
						<td></td><td></td>
						<td>".$Qte."</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
						<button type='button' class='Modif btn btn-dark icon-edit' data-bs-toggle='modal' data-bs-target='#Modif'>
								</td>";
								?>
									<td>
									<button type="button" class="Supp btn btn-danger" data-bs-toggle="modal" data-bs-target="#Supp">
												<span class="icon-trash"></span>
											</button>
										</td>
										<td></td><td></td>
										</tr>
							 <?php
				}

				}else {
						$sql = "SELECT * FROM Achat";
						$resultat = mysqli_query($connex,$sql);

						$num=mysqli_num_rows($resultat);
						$numeroPage=5;
						$totalPages=ceil($num/$numeroPage);

						//Bouton de Pagination

						for ($btn=1; $btn <= $totalPages ; $btn++ ) {
								echo '
								<a href="Affiche_Achat.php?page='.$btn.'" class="text-white Pagination " >
								<button class="Supp btn btn-dark mx-1 my-3 ">'.$btn.'</button></a>';
						} 

						if (isset($_GET['page'])) {
								$page = $_GET['page'];
						}else {
								 $page = 1;
						}
						
						$stratinglimit=($page-1)*$numeroPage;
						$sql = "SELECT * FROM Achat LIMIT " .$stratinglimit.
						','.$numeroPage;
						$resultat = mysqli_query($connex,$sql);

						while($row = mysqli_fetch_assoc($resultat)){

								$NumAchat = $row['NumAchat'];
								$IDcli = $row['IDCli'];
								$IDvoit = $row['IDvoit'];
								$Date = $row['Date'];
								$Qte = $row['Qte'];

								echo "<tr>
								<td>A ".$NumAchat."</td>
								<td></td>
								<td>Cl ".$IDcli."</td><td></td>
								<td>V ".$IDvoit."</td>
								<td>".$Date."</td>
								<td></td><td></td>
								<td>".$Qte."</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
								<button type='button' class='Modif btn btn-dark icon-edit' data-bs-toggle='modal' data-bs-target='#Modif'>
								</td>";
										?>
											<td>
											<button type="button" class="Supp btn btn-danger" data-bs-toggle="modal" data-bs-target="#Supp">
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
				
				<button type="button" class="Supp btn btn-dark" data-bs-toggle="modal" data-bs-target="#ajout">
				<span class="icon-plus" ></span>
				</button>
								
		</div>
		
<!------------------------------------------------------------------------->
<?php
	
	if (isset($_GET['message'])){
	echo '
	<div class="modal fade" id="message" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-dialog">
			<div class="MODAL modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="messageLabel">'.$_GET['message'].'</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				    
			</div>
		</div>
	</div>
	</div>
	';
	}
?>
<script>
// Code pour afficher le modal une fois que la page est chargée
window.addEventListener('load', function() {
  var myModal = new bootstrap.Modal(document.getElementById('message'));
  myModal.show();
});
</script>
<!--------------------------------------------------------------------------------------------------->
<?php
	
	if (isset($_GET['messageOK'])){
	echo '
	<div class="modal fade" id="messageOK" tabindex="-1" aria-labelledby="messageOKLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-dialog">
			<div class="MODAL modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="messageOKLabel">'.$_GET['messageOK'].'</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				    
			</div>
		</div>
	</div>
	</div>
	';
	}
?>
<script>
// Code pour afficher le modal une fois que la page est chargée
window.addEventListener('load', function() {
  var myModal = new bootstrap.Modal(document.getElementById('messageOK'));
  myModal.show();
});
</script>

<!--------------------------------------------------------Modal_Ajout_Achat-------------------------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="ajout" tabindex="-1" aria-labelledby="ajoutLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-dialog">
		<div class="MODAL modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ajoutLabel">Nouvel ACHAT  :</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<div class="modal">
					<div class="modal-content">
							<span class="close">&times;</span>
							<div id="error-message"></div>
					</div>
			</div>
			<form class="row g-3  rounded float-start"  action="Ajout_Achat.php" method="POST" id="FormAjout" >
			<div class="row mb-3">
			
			</div>
			
						<div class="row mb-3">
										<label class="col-sm-3 col form-label">Client :</label>
												<div class="col-sm-6">
														<?php
														
																$sql = "SELECT * FROM Client";
																$resultat = mysqli_query($connex,$sql);
																echo "<select class='form-control' name = IDCli>";
																while ($row = mysqli_fetch_assoc($resultat)) {
																		echo "<option value = '".$row["IDcli"]."'>" ."Cl ".$row['IDcli']."-".$row["Nom"]."</option>";
																}
																echo "</select>";

														?>
												</div>
						</div>
						<div class="row mb-3">
										<label class="col-sm-3 col form-label">Voiture:</label>
												<div class="col-sm-6">
														<?php
														
																$sql = "SELECT * FROM Voiture";
																$resultat = mysqli_query($connex,$sql);
																echo "<select class='form-control' name = IDvoit>";
																while ($row = mysqli_fetch_assoc($resultat)) {
																		echo "<option value = '".$row["IDvoit"]."'>"."V " . $row['IDvoit']."-".$row["Design"]."</option>";
																}
																echo "</select>";

														?>
												</div>
						</div>
						<div class="row mb-3">
										<label class="col-sm-3 col form-label">Date:</label>
												<div class="col-sm-6">
														<input type="date" class="form-control" name="Date" require >
												</div>
						</div>
						<div class="row mb-3">
										<label class="col-sm-3 col form-label">Quantité:</label>
												<div class="col-sm-6">
														<input type="number" class="form-control" name="Qte" require >
												</div>
						</div>
						<div class="modal-footer">
								<button type="submit" class="btn btn-dark" value = "Ajouter" name="Ajouter" >Ajouter</button>
								<a class="btn btn-danger" href="Affiche_Achat.php" role="button" data-bs-dismiss="modal">Annuler</a>
						</div>
								
				</form>
			</div>
						
		</div>
	</div>
</div>
	
</div>

<!----------------------------------------------------------------Modal_Modif_Achat----------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="Modif" tabindex="-1" aria-labelledby="ModifLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-dialog">
		<div class="MODAL modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModifLabel">Modification</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<form action="Modif_Achat.php" method="POST">
				<input id="NumAchat" type="hidden" name="NumAchat">
				<div class="erreur">
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
										<label class="col-sm-3 col form-label">Client :</label>
												<div class="col-sm-6">
												<select id='IDCli' class='form-control' name = IDCli>
												<?php
														
																$sql = "SELECT * FROM Client";
																$resultat = mysqli_query($connex,$sql);
																
																while ($row = mysqli_fetch_assoc($resultat)) {
															
															 echo "<option value ='Cl $row[IDcli]'>"."Cl ".$row['IDcli']."-".$row["Nom"]."</option>";
																
																}

												?>
												</select>
												</div>
								</div>
								<div class="row mb-3">
										<label class="col-sm-3 col form-label">Voiture:</label>
												<div class="col-sm-6">
												<select id='IDvoit' class='form-control' name = IDvoit>
												<?php
														
																$sql = "SELECT * FROM Voiture";
																$resultat = mysqli_query($connex,$sql);
															
																while ($row = mysqli_fetch_assoc($resultat)) {
																		echo "<option value = 'V $row[IDvoit]'>"."V ". $row['IDvoit']."-".$row["Design"]."</option>";
																}
																
														?>
												</select>
												</div>
								</div>
								<div class="row mb-3">
										<label class="col-sm-3 col form-label">Date:</label>
												<div class="col-sm-6">
												<input id="Date" class="form-control" type="Date" name = "Date" value = "" require >
												</div>
								</div>
								<div class="row mb-3">
										<label class="col-sm-3 col form-label">Quantité:</label>
												<div class="col-sm-6">
												<input id="Qte" class="form-control" type="number" name = "Qte" value = "" require >
												</div>
								</div>
								<div class="modal-footer">
								<input class="btn btn-dark " type="submit" value = "Modifier" name="Modifier">
								<a class="btn btn-danger" href="Affiche_Achat.php" role="button" data-bs-dismiss="modal">Annuler</a>
								</div>
				</form>
			</div>
		</div>
	</div>
</div>
	
</div>

<!------------------------------------Modal_Supp_Achat-------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="Supp" tabindex="-1" aria-labelledby="SuppLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-dialog">
		<div class="MODAL modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="SuppLabel">Voulez-vous supprimer cet achat ?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="Supp_Achat.php" method="POST">
								<input id="NumAchat" type="hidden" name="NumAchat" value="">
								<div class="modal-footer">
								<input class="btn btn-danger " type="submit" value = "Supprimer" name="Supprimer">
								<a class="btn btn-secondary" href="Affiche_Client.php" role="button" data-bs-dismiss="modal">Annuler</a>
								</div>
			</form>      
		</div>
	</div>
</div>
</div>

<!--------------------------------------------------Modal_error-message-------------------------------------------------------------------->
<div class="modal fade" id="myModalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabelError">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabelError">Erreur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="errorMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------------------------------------------------->

		<script>
			$(document).ready(function(){
				$('.Modif').on('click',function(){
					$tr=$(this).closest('tr');
					var data = $tr.children("td").map(function(){
							return $(this).text();
					}).get();

					console.log(data);

					$('#Modif #NumAchat').val(data[0]);
					$('#Modif #IDCli').val(data[2]);
					$('#Modif #IDvoit').val(data[4]);
					$('#Modif #Date').val(data[5]);
					$('#Modif #Qte').val(data[8]);     


				});
			});

			$(document).ready(function(){
				$('.Supp').on('click',function(){
					$tr=$(this).closest('tr');
					var data = $tr.children("td").map(function(){
							return $(this).text();
					}).get();

					console.log(data);

					$('#Supp #NumAchat').val(data[0]);

				});
			});



		</script>
		<?php 
include 'Modif_Achat.php';
		if (isset($Erreur)) { ?>
			<script>
				$(document).ready(function() {
					$('#errorMessage').text('<?php echo $Erreur; ?>');
					$('#myModalError').modal('show');
					$('#ajout').modal('hide');
				});
			</script>
		<?php } ?>
		

</main>


</body>
</html>