<?php
ob_start();
    session_start();
    if ($_SESSION['logged_in'] != true) {
      header('Location:login.php');
			exit;
    }

        include 'DATA_connect.php';

        if (isset($_POST['Ajouter'])) {
            $Nom = $_POST['Nom'];
            $Contact = $_POST['Contact'];

            if (!empty($Nom) || !empty($Contact)) {

                $sql = "INSERT INTO Client VALUES('','$Nom','$Contact')";
                $resultat = mysqli_query($connex,$sql);

                if ($resultat) {
                //echo "Ajouter avec success !";
                header('location:Affiche_Client.php');
                }else {
                    die(mysqli_error($resultat));
                }
            }

            
        }

?>
