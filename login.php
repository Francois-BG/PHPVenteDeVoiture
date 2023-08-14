<?php
	session_start();

	// Vérifier si le formulaire a été soumis
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		// Récupérer les informations de connexion
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Vérifier les informations de connexion
		if ($username == 'Admin' && $password == 'Admin') {
			// Authentification réussie
			$_SESSION['logged_in'] = true;
			header('Location:Dashboard.php');
			exit;
		} else {
			// Authentification échouée
			$error_message = 'Nom d\'utilisateur ou mot de passe incorrect';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="BOOTSTRAP/bootstrap-offline-docs-5.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main id = "login" class="login" >
	<div class="container mt-5">
	<p class="Titre_login" ><img src="Images/Client.png" class="rounded rounded-circle img-fluid " alt="Client" width="200" height="200"></p>
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="form_login card">
					<div class="card-header"><h3>LogIn</h3></div>
                    <div class="Erreur">
                        <?php 
                            
                            if (!empty($error_message)) {
                                echo "
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        <strong>$error_message</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
                                    </div>
                                ";
                                
                            }
                        
                        ?>
                    </div>
					<div class="card-body">
						<form  method="POST" action="login.php">
							<div class="form-group">
								<label for="username"><h6>Nom d'utilisateur:</h6></label>
								<input type="text" class="form-control" id="username" name="username" required>
							</div>
							<div class="form-group">
								<label for="password"><h6>Mot de passe:</h6></label>
								<input type="password" class="form-control" id="password" name="password" required>
							</div>
							<h6><button type="submit" class="Connexion btn btn-dark col-md-3 mt-2 ">Connexion</button></h6>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!---------------------------------------Modal_Bienvenu---------------------------------------------------------->
<div class="modal fade" id="Bienvenu" tabindex="-1" aria-labelledby="BienvenuLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-dialog">
    <div class="MODAL modal-content">
	<div class="modal-header">
	
	</div>
      <div class="modal-body">
      <h5 class="modal-title" id="BienvenuLabel">Bienvenue !</h5>
      </div>
      
    </div>
  </div>
</div>
</main>

</script>
</body>
</html>
