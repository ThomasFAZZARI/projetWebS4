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
			$requete = "SELECT * FROM utilisateur WHERE mail='".$email."' and motdepasse='".$mdp."'";
			$execute = mysqli_query($connexion, $requete);
			$reponse = mysqli_fetch_array($execute);

			if(isset($reponse))
			{
				$_SESSION["mail"] = $email;
				$_SESSION["mdp"] = $mdp;
				$_SESSION["pseudo"] = $reponse[0];
				// le champ à l'indice 3 correspond au booléen "estOrganisateur"
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
