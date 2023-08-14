<?php

try{

		$bdd=new PDO('mysql:host=localhost;dbname=Ventes','root','');
	}
	catch(exeption $e)
	{
		die('erreur'.$e->getMessage());
	}
?>