<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<title>Inscription</title>
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
        		<a class="nav-link" href="Connexion.php">Se connecter</a>
      		</li>
  		</div>
	</nav>

</header>
<body>
	<?php 
		$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
		mysqli_select_db($connexion, "ProjetWebS4");
	 ?>
	 <br><br>
	 
	 <form class="form-horizontal" method="POST" action="scripts/scriptInscription.php" style="width:500px;margin:auto;">
 		<div class="form-group">
    		<label for="pseudo" class="col-sm-2 control-label">Pseudo</label>
    		<div class="col-sm-10">
     			<input type="text" class="form-control" required id="nom" name="nom" placeholder="Votre pseudo">
   			</div>
 		</div>
 		<div class="form-group">
    		<label for="mail" class="col-sm-2 control-label">E-mail</label>
    		<div class="col-sm-10">
     			<input type="email" class="form-control" required id="mail" name="mail" placeholder="Votre adresse mail">
   			</div>
 		</div>
 		<div class="form-group">
			<label for="mdp" class="col-sm-2 control-label"> Mot de passe </label>
			<div class="col-sm-10">
				<input type="password" required id="mdp" name="mdp" class="form-control" placeholder="Votre mot de passe">
			</div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
					<label>
						 <input type="checkbox" name="organisateur"> Êtes-vous organisateur ?
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" name="submit" class="btn btn-dark" value="Valider">
			</div>
		</div>
	</form> 
	
</body>
</html>