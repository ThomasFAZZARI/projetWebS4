<?php

	session_start(); 

	/* CONNEXION BASE DE DONNEES */

	if(isset($_POST["mail"]) && isset($_POST["mdp"]))
	{
		$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
		mysqli_select_db($connexion, "ProjetWebS4");

		$email = $_POST["mail"];
		$mdp = $_POST["mdp"];

		if($email !== "" && $mdp !== "")
		{
			// RÉCUPÉRER DONNÉES
					
			$requete = "SELECT * FROM Utilisateur WHERE `Mail`= '$email'";
			$execute = mysqli_query($connexion, $requete);
			$reponse = mysqli_fetch_array($execute);
			if(isset($reponse)) {
				$hashedPw = $reponse["MotDePasse"];
				$selmdp = $reponse["Sel"].$mdp;
				if(strcmp(hash("sha384", $selmdp), $hashedPw) == 0) {
					$inDB = true;
				} else {
					$inDB = false;
				}
			
			}
			
			if($inDB)
			{
				$_SESSION["mail"] = $email;
				$_SESSION["mdp"] = $mdp;
				$_SESSION["pseudo"] = $reponse[0];
				if($reponse[3]==1){
					header("Location:/ProjetWebS4/organisateur.php");
				}else{
					header("Location:/ProjetWebS4/electeur.php");
				}
			}
			else
			{
				header("Location:/ProjetWebS4/connexion.php?erreur=1");
			}
		}
		else
		{
			header("Location:/ProjetWebS4/connexion.php?erreur=2");
		}
	}
	else
	{
		header("Location:/ProjetWebS4/connexion.php");
	}
?>
