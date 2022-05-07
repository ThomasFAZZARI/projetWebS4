<?php 

	session_start();
	$Pseudo = $_POST["nom"];
	$Mail = $_POST["mail"];
	$MotDePasse = $_POST["mdp"];
	if(isset($_POST['organisateur'])){
		$EstOrganisateur = 1;
	}else{
		$EstOrganisateur = 0;
	}

	$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");
	$requete = "UPDATE Utilisateur SET Pseudo = '".$Pseudo."' , MotDePasse = '".$MotDePasse."' , EstOrganisateur = '".$EstOrganisateur."' WHERE Mail ='".$Mail."'";
	$execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));


	$_SESSION['pseudo']= $Pseudo;
	$_SESSION['mdp']= $MotDePasse;
	$_SESSION['estOrg']= $EstOrganisateur;

	if(isset($_POST['organisateur'])){
		header("Location:/ProjetWebS4/organisateur.php");
		exit();
	}else{
		header("Location:/ProjetWebS4/electeur.php");
		exit();
	}

?>
