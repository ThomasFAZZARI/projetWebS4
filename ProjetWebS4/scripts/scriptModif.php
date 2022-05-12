<!DOCTYPE html>
<html>
<head>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<title></title>
</head>
<body>


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
		echo "
				<script type='text/javascript'>
				Swal.fire(
				'Modification réussie',
				'Vos modifications ont été prises en compte.',
				'success'
				).then(function() {
					window.location = '/ProjetWebS4/organisateur.php';
					});
					</script>
		";
		exit();
	}else{
		echo "
				<script type='text/javascript'>
				Swal.fire(
				'Modification réussie',
				'Vos modifications ont été prises en compte.',
				'success'
				).then(function() {
					window.location = '/ProjetWebS4/electeur.php';
					});
					</script>
		";
		exit();
	}

?>

</body>
</html>


