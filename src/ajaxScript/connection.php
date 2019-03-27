<?php

include('../../Modele/modele.php');

$msgErreurConnection = "";

if (isset($_GET['Username']) AND isset($_GET['Passwordconnection'])) { 
	$resultats = getUser($_GET['Username']);
	$resultats = $resultats->fetch();
	if(password_verify($_GET['Passwordconnection'], $resultats["Password"])){
		if (count($resultats)) {
			$res = getUser($_GET['Username']);
			while($row = $res->fetch()) {
				$_SESSION['id']=$row['id'];
				$_SESSION['name']=$row['name'];
				$_SESSION['age']=$row['age'];
				$_SESSION['sexe']=$row['sexe'];
				$_SESSION['statut']=$row['statut'];
				$_SESSION['creepypts']=$row['creepypts'];
				$_SESSION['jeuxpts']=$row['jeuxpts'];
				$_SESSION['videopts']=$row['videopts'];
				$_SESSION['chattime']=$row['chattime'];
				$_SESSION['avis']=$row['avis'];
			}
		}
		else {
			echo 'mot de passe erronée';
		}
	}else{
		echo 'mot de passe erronée';
	}
}