


<?php 

	session_start();

	$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");
	$requete = "UPDATE Election SET estTerminee = 1 WHERE IdElection =".$_GET['IdElec'];
	$execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));
	header("Location:/ProjetWebS4/organisateur.php");
	exit();

?>
