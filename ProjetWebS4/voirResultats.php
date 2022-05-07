<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<title>Accueil</title>
</head>
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<?php 
				session_start();
				if($_SESSION['estOrg'] == 1){

					echo "<a class='navbar-brand' href='organisateur.php'>Accueil</a>";

				}else{

					echo "<a class='navbar-brand' href='electeur.php'>Accueil</a>";
				}

			 ?>
			
    		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      		<li class="nav-item active">
        		<a class="nav-link" href="scripts/scriptDeconnexion.php">Se déconnecter</a>
      		</li>
      		<li class="nav-item active">
        		<a class="nav-link" href="modifierCompte.php">Modifier son compte</a>
      		</li>
  		</div>
	</nav>
</header>
<body>

<?php 

	
	$connexion = mysqli_connect("localhost", "root", "") or die("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");

	if(isset($_GET['IdElec'])) {

		$requete = "SELECT IdDestination FROM Participation WHERE nbVotes IN (SELECT MAX(nbVotes) FROM Participation WHERE IdElection='".$_GET['IdElec']."')"; 
		$execute = mysqli_query($connexion, $requete);
		$reponse = mysqli_fetch_array($execute);
		$gagnant = $reponse[0];

		$requete = "SELECT * FROM Destination WHERE IdDestination = '".$gagnant."'"; 
		$execute = mysqli_query($connexion, $requete);
		$reponse = mysqli_fetch_array($execute);

		echo "<div style='text-align:center;'><h1 class='h1'>VAINQUEUR : </h1>";
		echo "<div class='card' style='text-align:center;'></p>";
		echo "<p><h2>".$reponse[1]." (".$reponse[2].")</h2></p>"; 
		echo "<p><h4>Température moyenne : ".$reponse[3]." degrés</h4></p>"; 
		echo "<p><img src='".$reponse[5]."'class='img-fluid'  style='width:500px;height:500px;'></p>";
		echo "<p>".$reponse[4]."</p>"; 
		echo "</div>";

	}


?>
</body>
</html>
