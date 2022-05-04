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

	if(isset($_GET['IdDestination'])) {
		$i = $_GET['IdDestination'];
		$_SESSION['destinationsSelectionnes'][$i] = $_SESSION['destinations'][$i];

		$requeteNbVote = "SELECT nbVotes FROM Participation WHERE IdDestination=".$i." AND IdElection=" .$_SESSION['numElec'];
		$resultatNbVote = mysqli_query($connexion,$requeteNbVote);
		$row = mysqli_fetch_array($resultatNbVote);
		$valeur = $row['nbVotes'] +1;
		echo $valeur;
		$MAJvote = "UPDATE Participation SET nbVotes ='".$valeur."' WHERE IdDestination =".$i." AND IdElection=" .$_SESSION['numElec'];
		$resultatMAJvote = mysqli_query($connexion,$MAJvote);
		

		//ajouter un vote ici
		if(count($_SESSION['destinationsRestantes']) == 0 && count($_SESSION['destinationsSelectionnes']) == 1) {
			echo "<h1> Fin du vote </h1>";
			return;
		}
	}

	if(isset($_GET['IdElec'])) {

		$_SESSION['numElec'] = $_GET['IdElec'];
		$_SESSION['destinations'] = array();
		$_SESSION['destinationsRestantes'] = array();
		$_SESSION['destinationsSelectionnes'] = array();


		$requeteElection = "SELECT * FROM Election WHERE IdElection=".$_GET['IdElec']."";
		$resultatElection = mysqli_query($connexion,$requeteElection);
		if($resultatElection) {

			$ligneResultat = mysqli_fetch_array($resultatElection);
			$_SESSION['Intitule'] = $ligneResultat['Intitule'];
		}



		$requete = "SELECT * FROM Destination WHERE IdDestination IN(SELECT IdDestination FROM Participation WHERE IdElection=".$_GET['IdElec'].")";
		$resultatreq = mysqli_query($connexion,$requete);
	
		if($resultatreq) {

			while($ligneResultat = mysqli_fetch_array($resultatreq)) {
				$idDestination = $ligneResultat['IdDestination'];

				$_SESSION['destinations'][$idDestination] = $ligneResultat;
			}
			$_SESSION['destinationsRestantes'] = $_SESSION['destinations'];
		}
	}

	if (count($_SESSION['destinationsRestantes']) <= 1) {
		if (count($_SESSION['destinationsRestantes']) == 1) {
			// on recupère la dernière destination restante
			$idDestination = array_key_first($_SESSION['destinationsRestantes']);
			$derniere = $_SESSION['destinationsRestantes'][$idDestination];
			$_SESSION['destinationsRestantes'] = $_SESSION['destinationsSelectionnes'];
			$_SESSION['destinationsRestantes'][$idDestination] = $derniere;
		} else {
			$_SESSION['destinationsRestantes'] = $_SESSION['destinationsSelectionnes'];
		}
		$_SESSION['destinationsSelectionnes'] = array();
	}


	//selectionner 2 au hasard 
	$index = array_rand($_SESSION['destinationsRestantes'], 1);
	$_SESSION['dest1'] = $_SESSION['destinationsRestantes'][$index];
	unset($_SESSION['destinationsRestantes'][$index]);
	
	$index = array_rand($_SESSION['destinationsRestantes'], 1);
	$_SESSION['dest2'] = $_SESSION['destinationsRestantes'][$index];
	unset($_SESSION['destinationsRestantes'][$index]);


	  echo "destinations <br>";
	  foreach ($_SESSION['destinations'] as $value) {
      	echo $value['Nom']." / ";
	  }
	  echo "<br>";
	  echo "destinations restantes <br>";
	  foreach ($_SESSION['destinationsRestantes'] as $value) {
      	echo $value['Nom']." / ";
	  }
	  echo "<br>";
	  echo "destinations selectionnes <br>";
	  foreach ($_SESSION['destinationsSelectionnes'] as $value) {
      	echo $value['Nom']." / ";
	  }
	  echo "<br>";
?>


	<div style="text-align: center;"><br><h1 class="h1"> <?php echo $_SESSION["Intitule"] ?> </h1><br></div>

	<div class="card-group">
		<div class='card' style='text-align:center;'>
			<?php echo "<form method='post' action='participation.php?IdDestination=".$_SESSION['dest1']['IdDestination']."'>"; ?>
				<?php echo "<p>".$_SESSION['dest1']['Nom']."</p>"; ?>
				<p><input type='submit' name='participer' class='btn btn-dark' value='Voter pour cette destination'></p>
			</form>
		</div>

		<div class='card' style='text-align:center;'>
			<?php echo "<form method='post' action='participation.php?IdDestination=".$_SESSION['dest2']['IdDestination']."'>"; ?>
				<?php echo "<p>".$_SESSION['dest2']['Nom']."</p>"; ?>
				<p><input type='submit' name='participer' class='btn btn-dark' value='Voter pour cette destination'></p>
			</form>
		</div>
	</div>

</body>
</html>
