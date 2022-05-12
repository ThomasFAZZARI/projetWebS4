<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

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
	
	echo '<div style="text-align: center;"><br><h1 class="h1">'.$message.'</h1><br></div>';
	if($valid) {
		echo "<div style='text-align:center;'>
		<form  method='POST' name='connection' action='scriptConnexion.php' accept-charset='UTF-8'>
		<input type='hidden' name='mail' value='".$Mail."'> 
		<input type='hidden' name='mdp' value='".$MotDePasse."'>
		<p><input type='submit' name='submit' class='btn btn-dark' id='posterComm' value='Connexion'></input></p>
		</form>
		</div>";
	}
	
function addUser($connection, $Pseudo, $Mail, $cryptedPw, $EstOrganisateur, $salt){
	$query = "INSERT INTO Utilisateur(Pseudo,Mail,MotDePasse,EstOrganisateur,Sel) VALUES ('$Pseudo' , '$Mail' , '$cryptedPw', '$EstOrganisateur', '$salt')";
	$statement = $connection->prepare($query);
	try{
		$statement->execute();
		echo '<div style="text-align: center;"><br><h1 class="h1">Votre compte a été créé</h1><br></div>';
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

</body>
</html>
