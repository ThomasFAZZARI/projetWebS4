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
			<a class="navbar-brand" href="electeur.php">Accueil</a>
    		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      		<li class=s"nav-item active">
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

	session_start();

	$connexion = mysqli_connect("localhost", "root", "") or die("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");

	$requete = "SELECT * FROM Destination WHERE IdDestination IN(SELECT IdDestination FROM Participation WHERE IdElection=".$_GET['IdElec'].")";
	$resultatreq = mysqli_query($connexion,$requete);

	if($resultatreq)
		{
			while($ligneResultat = mysqli_fetch_array($resultatreq))
			{
	
				echo "<p>".$ligneResultat['Nom']."</p>";
		
				
			}
		}

?>


</body>
</html>
