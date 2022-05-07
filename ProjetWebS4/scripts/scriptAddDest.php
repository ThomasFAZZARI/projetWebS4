<?php 
	session_start();

	$nom = $_POST["nom"];
	$pays = $_POST["pays"];
	$temp = $_POST["temp"];
	$desc = $_POST["desc"];

	$filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "/ProjetWebS4/img/".$filename;


	$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");
	$requete = "INSERT INTO Destination (nom,pays,tempmoyenne,description,image) VALUES ('$nom' , '$pays' , '$temp' , '$desc', '$folder')";
	$execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));
	header("Location:/ProjetWebS4/addDestination.php");
	exit();

?>
