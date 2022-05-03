<?php 

	$nomElection = $_POST["titre"];

	$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");



    if(isset($_POST["destination1"])) {
        $dest1 = $_POST["destination1"];
    }

    if(isset($_POST["destination2"])) {
        $dest2 = $_POST["destination2"];
    }

    if(isset($_POST["destination3"])) {
        $dest3 = $_POST["destination3"];
    }

    if(isset($_POST["destination4"])) {
        $dest4 = $_POST["destination4"];
    }

    if(isset($_POST["destination5"])) {
        $dest5 = $_POST["destination5"];
    }



	$requete = "INSERT INTO elections (nom, IDdestination1, IDdestination2, IDdestination3, IDdestination4, IDdestination5) VALUES ('$nomElection' , '$dest1' , '$dest2' , '$dest3', '$dest4', '$dest5')";
	$execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));
	header("Location:/ProjetWebS4/organisateur.php");
	exit();

?>
