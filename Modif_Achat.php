<?php
ob_start();

    include 'DATA_connect.php';

            if (isset($_POST['Modifier'])) {

                $NumAchat = str_replace("A","",$_POST['NumAchat']);
                $IDCli = str_replace("Cl","",$_POST['IDCli']);
                $IDvoit = str_replace("V","",$_POST['IDvoit']);
                $Date = $_POST['Date'];
                $Qte = $_POST['Qte'];

                if (!empty($IDCli) || !empty($IDvoit) || !empty($Date) || !empty($Qte)) {

                    $sql = "SELECT Nombre FROM Voiture WHERE IDvoit = $IDvoit";
                    $resultat = mysqli_query($connex,$sql);
                    $NBvoit= mysqli_fetch_assoc($resultat);
        
                    if ($NBvoit['Nombre'] < $Qte) {
                        $sql = "SELECT Design FROM Voiture WHERE IDvoit = $IDvoit";
                        $result = mysqli_query($connex, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $design = $row['Design'];
                        header('location:Affiche_Achat.php?message=Quantité trop elevé il reste '.$NBvoit['Nombre'].'-'.$design.' dans le stock !');
                        exit();
                    }else {

                        $sql2 = "SELECT Qte FROM Achat WHERE NumAchat = $NumAchat";
                        $resultat2 = mysqli_query($connex,$sql2);
                        $ligne = mysqli_fetch_assoc($resultat2);
                        $qte = $ligne['Qte'];
                        
                    
                        $sql = "UPDATE Voiture v JOIN Achat a ON v.IDvoit = a.IDvoit 
                                SET a.IDCli = $IDCli ,a.IDvoit = $IDvoit,a.Date = '$Date',a.Qte = $Qte,v.Nombre = v.Nombre + $qte 
                                WHERE a.IDvoit = $IDvoit AND a.NumAchat = $NumAchat";
                        $resultat = mysqli_query($connex,$sql);
                        $sql2 = "UPDATE Voiture SET Nombre = Nombre - $Qte WHERE IDvoit = $IDvoit";
                        $resultat2 = mysqli_query($connex,$sql2);

                        if (!$resultat) {
                            die(mysqli_error($resultat));
                        }else {
                            // echo "Modification avec success ! <br><br> ";

                            // echo '<a class="btn btn-dark icon-reply " href="Affiche_Achat.php"></a>';
                            header('location:Affiche_Achat.php');
                        }
                    }
                    
                }elseif (empty($Qte)) {
                    header('location:Affiche_Achat.php?message=Veillez remplir tout le formulaire ! ');
                    exit();
                }

            }
?>