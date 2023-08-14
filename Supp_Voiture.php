<?php
ob_start();
session_start();
require_once('DATA_connect.php');
if ($_SESSION['logged_in'] != true) {
  header('Location:login.php');
        exit;
}


    include 'DATA_connect.php';

    if (isset($_POST['IDvoit'])) {

        $IDvoit = str_replace("V"," ",$_POST['IDvoit']);
        $sql = "DELETE FROM Voiture WHERE IDvoit = $IDvoit";
        $resultat = mysqli_query($connex,$sql);

        if ($resultat) {
            header('location:Affiche_Voiture.php');
        }else {
            die(mysqli_error($resultat));
        }
    }
?>