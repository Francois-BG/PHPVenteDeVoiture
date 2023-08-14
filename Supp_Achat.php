<?php
session_start();
require_once('DATA_connect.php');
if ($_SESSION['logged_in'] != true) {
  header('Location:login.php');
        exit;
}

    include 'DATA_connect.php';

    if (isset($_POST['Supprimer'])) {
    $NumAchat = str_replace("A","",$_POST['NumAchat']);

    $sql = "DELETE FROM Achat WHERE NumAchat = $NumAchat";
    $sql2 = "SELECT IDvoit,Qte FROM Achat WHERE NumAchat = $NumAchat";
    $resultat2= mysqli_query($connex,$sql2);
    $row = mysqli_fetch_assoc($resultat2);
    $Qte = $row['Qte'];
    $IDvoit = $row['IDvoit'];
    $sql1 = "UPDATE Voiture SET Nombre=Nombre+ $Qte WHERE IDvoit= $IDvoit";
    $resultat = mysqli_query($connex,$sql);
    $resultat1 = mysqli_query($connex,$sql1);

    if ($resultat) {
        header('location:Affiche_Achat.php');
    }else {
        die(mysqli_error($resultat));
    }
}

?>