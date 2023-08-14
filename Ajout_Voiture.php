<?php
ob_start();
 session_start();
 if ($_SESSION['logged_in'] != true) {
   header('Location:login.php');
         exit;
 }

        include 'DATA_connect.php';

        if (isset($_POST['Ajouter'])) {
            $Design = $_POST['Design'];
            $Prix = $_POST['Prix'];
            $Nombre = $_POST['Nombre'];

            if (!empty($Design) || !empty($Prix) || !empty($Nombre)) {

                $sql = "INSERT INTO Voiture VALUES('','$Design','$Prix','$Nombre')";
                $resultat = mysqli_query($connex,$sql);

                if ($resultat) {
                //echo "Ajouter avec success !";
                header('location:Affiche_Voiture.php');
                }else {
                    die(mysqli_error($resultat));
                }
            }

            
        }

?>
