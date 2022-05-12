<?php
    session_start(); 
	require '../base.php';

	$valid = true;
	$message = "";
	
	$Pseudo = $_POST["nom"];
	$MotDePasse = $_POST["mdp"];
	$Mail = $_POST["mail"];
	if(isset($_POST['organisateur'])){
		$EstOrganisateur = 1;
	}else{
		$EstOrganisateur = 0;
	}

	// USERNAME CHECK
	if( empty($_POST["nom"]) || (strlen($Pseudo) < 4) ) {
		$message .= "<p class='error'>Erreur : Le nom d'utilisateur doit contenir au moins 4 caractères.</p>";
		$valid = false;
	}
	else{
		$userAvailable = checkUserName($connection, $Pseudo);
		if(!$userAvailable){
			$valid = false;
			$message .= "<p class='error'>Erreur : Le nom d'utilisateur n'est pas disponible.</p>";
		}
	}

	// PASSWORD CHECK
	if(empty($_POST["mdp"]) || strlen($MotDePasse) < 8) {
		$message .= "<p class='error'>Erreur : Le mot de passe doit avoir au moins 8 caractères.</p>";
		$valid = false;
	} else{
		$salt = createSalt(10);
		$selMdp = $salt.$MotDePasse;
		$cryptedPw = cryptPassword($selMdp);
	}

	// EMAIL CHECK
	if (!( isset($_POST["mail"]) && (count(explode('@', $Mail)) ==2) && (count(explode('.', $Mail)) ==2) ) ) {
		$message .= "<p class='error'>Erreur : L'adresse email doit contenir une seule occurrence des caractères \"@\" et \".\".</p>";
		$valid = false;
	} else {
		$mailAvailable = checkEmail($connection, $Mail);
		if(!$mailAvailable){
			$valid = false;
			$message .= "<p class='error'>Erreur : L'adresse mail n'est pas disponible.</p>";
		}
	}


	// ADD USER
	if($valid) {
		addUser($connection, $Pseudo, $Mail, $cryptedPw, $EstOrganisateur, $salt);
	}
	
	echo "<br>".$message;
	
function addUser($connection, $Pseudo, $Mail, $cryptedPw, $EstOrganisateur, $salt){
	$query = "INSERT INTO Utilisateur VALUES ('$Pseudo' , '$Mail' , '$cryptedPw', '$EstOrganisateur', '$salt')";
	$statement = $connection->prepare($query);
	try{
		$statement->execute();
		echo "<br>Votre compte a été créé.";
	} catch(PDOException $e) {
			echo "<br>".$e->getMessage();
	}
}

function checkEmail($connection, $Mail){
	$query = "SELECT COUNT(*) AS count FROM Utilisateur WHERE Mail LIKE :mail";
	$statement = $connection->prepare($query);
	$statement->bindValue(":mail", $Mail, PDO ::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	return $row["count"] == "0";
}

function checkUserName($connection, $Pseudo){
	$query = "SELECT COUNT(*) AS count FROM Utilisateur WHERE Pseudo LIKE :Pseudo";
	$statement = $connection->prepare($query);
	$statement->bindValue(":Pseudo", $Pseudo, PDO ::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	return $row["count"] == "0";
}

function createSalt($length){
	$salt = "";
	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789,.-;:_{}[]+*!?=(&%@";
	for ($i=0; $i < $length; $i++) {
		$randomInt = random_int(0,strlen($characters)-1);
		$salt .= $characters[$randomInt];
	}
	return $salt;
}

function cryptPassword($password){
	return hash("sha384", $password);
}

	exit();

?>
