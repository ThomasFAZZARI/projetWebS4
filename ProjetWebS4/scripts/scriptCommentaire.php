<?php


	if(isset($_POST["pseudo"]) && isset($_POST["idElec"]) && isset($_POST["message"]))
	{
		$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
		mysqli_select_db($connexion, "ProjetWebS4");

		$pseudo = $_POST["pseudo"];
		$idElec = $_POST["idElec"];
		$message = $_POST["message"];
		$date = date('d-m-Y H-i-s');

		

		$stmt = mysqli_prepare($connexion, "INSERT INTO commentaires(IdElection,pseudo,message,dateMsg) VALUES (?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, 'isss', $idElec,$pseudo,$message, $date); 
		mysqli_stmt_execute($stmt);
			


		header("Location:/ProjetWebS4/voirResultats.php?IdElec=".$idElec.""); }
?>
