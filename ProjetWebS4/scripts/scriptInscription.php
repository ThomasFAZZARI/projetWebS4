<?php 

	$Pseudo = $_POST["nom"];
	$Mail = $_POST["mail"];
	$MotDePasse = $_POST["mdp"];
	if(isset($_POST['organisateur'])){
		$EstOrganisateur = 1;
	}else{
		$EstOrganisateur = 0;
	}

	$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error());
	mysqli_select_db($connexion, "ProjetWebS4");
	$requete = "INSERT INTO Utilisateur VALUES ('$Pseudo' , '$Mail' , '$MotDePasse' , '$EstOrganisateur')";
	$execute = mysqli_query($connexion, $requete) or die(mysqli_error());
	header("Location:/ProjetWebS4/index.php");
	exit();

?>
