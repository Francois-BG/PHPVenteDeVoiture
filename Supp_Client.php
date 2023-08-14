<?php
ob_start();
    session_start();
    require_once('DATA_connect.php');
    if ($_SESSION['logged_in'] != true) {
      header('Location:login.php');
			exit;
    }

    include 'DATA_connect.php';
    if (isset($_POST['Supprimer'])) {
        $IDcli= str_replace("Cl","",$_POST['IDcli']);

        $sql = "DELETE Client  FROM Client WHERE IDcli = $IDcli ";
        $resultat = mysqli_query($connex,$sql);

        if (isset($resultat)) {
            $sql1 = "DELETE Achat  FROM Achat WHERE IDCli = $IDcli";
            $resultat1 = mysqli_query($connex,$sql1);
        }

        if ($resultat) {
            header('location:Affiche_Client.php');
        }else {
            die(mysqli_error($resultat));
        }
    }

?>