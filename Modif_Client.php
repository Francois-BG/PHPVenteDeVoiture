<?php
ob_start();
    session_start();
    if ($_SESSION['logged_in'] != true) {
      header('Location:login.php');
			exit;
    }
    include 'Data_connect.php';
    if (isset($_POST['Modifier'])) {
      $IDcli= str_replace("Cl","",$_POST['IDcli']);
      $Nom = $_POST['Nom'];
      $Contact = $_POST['Contact'];

      $sql = "UPDATE Client SET Nom = '$Nom' ,Contact = '$Contact' WHERE IDcli = $IDcli";
      $resultat = mysqli_query($connex,$sql);
      if ($resultat) {
          //echo "Modification avec success ! ";
          header('location:Affiche_Client.php');
      }else {
          die(mysqli_error($resultat));
      }
  }
?>

    