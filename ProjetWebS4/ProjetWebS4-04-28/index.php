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
			<a class="navbar-brand" href="index.php">Accueil</a>
    		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      		<li class="nav-item active">
        		<a class="nav-link" href="inscription.php">S'inscrire</a>
      		</li>
      		<li class="nav-item active">
        		<a class="nav-link" href="connexion.php">Se connecter</a>
      		</li>
  		</div>
	</nav>
</header>
<body>


	<div style="text-align: center;"><br><h1 class="h1">√ČLECTIONS EN COURS :</h1><br></div>

	<div class="card-group">

			<?php
				$connexion = mysqli_connect("localhost", "root", "") or die("Impossible de se connecter : " . mysqli_error($connexion));
				mysqli_select_db($connexion, "ProjetWebS4");
				$requete = "SELECT * FROM Election";
				$resultatreq = mysqli_query($connexion,$requete);

				if($resultatreq)
				{
					while($ligneResultat = mysqli_fetch_array($resultatreq))
					{
						if($ligneResultat['estTerminee']==0){
							echo "<div class='card' style='text-align:center;'>";
							echo "<p>".$ligneResultat['Intitule']."</p>";
							echo "</div>";
						}
					}
				}
				else
				{
					echo "Impossible de charger les elections en cours";
				}
			?>
	</div>

</body>
</html>