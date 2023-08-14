<?php
ob_start();
    session_start();
    if ($_SESSION['logged_in'] != true) {
      header('Location:login.php');
			exit;
    }
    include 'Data_connect.php';
    if (isset($_POST['Modifier'])) {
      $IDvoit = str_replace("V"," ",$_POST['IDvoit']);
      $Design = $_POST['Design'];
      $Prix = str_replace(",","",$_POST['Prix']);
      $Prix = str_replace(".","",$_POST['Prix']);
      $Nombre = $_POST['Nombre'];

      $sql = "UPDATE Voiture SET Design = '$Design' ,Prix = '$Prix',Nombre = '$Nombre' WHERE IDvoit = $IDvoit";
      $resultat = mysqli_query($connex,$sql);

      if ($resultat) {
          //echo "Modification avec success ! ";
          header('location:Affiche_Voiture.php');
      }else {
          die(mysqli_error($resultat));
      }
  }
?>
