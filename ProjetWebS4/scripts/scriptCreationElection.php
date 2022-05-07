<?php 
    session_start(); 
    
	$nomElection = $_POST["titre"];
    $idOrga = $_SESSION["idUtilisateur"];
	$connexion = mysqli_connect("localhost" , "root" , "") or die ("Impossible de se connecter : " . mysqli_error($connexion));
	mysqli_select_db($connexion, "ProjetWebS4");

	$requete = "INSERT INTO election (intitule, estTerminee, IdOrga) VALUES ('$nomElection',0,'$idOrga')";
	$execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));

    $result = mysqli_query($connexion,"SELECT MAX(IdElection) AS max_election FROM Election");
    $row = mysqli_fetch_array($result);
    $electId = $row["max_election"];

    if($_POST["destination1"]!="NULL") {

        $dest1 = $_POST["destination1"];
        $requete = "INSERT INTO participation  (IdElection,IdDestination,nbVotes) VALUES ('$electId','$dest1',0)";
        $execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));

    }

    if($_POST["destination2"]!="NULL") {

        $dest2 = $_POST["destination2"];
        $requete = "INSERT INTO participation (IdElection,IdDestination,nbVotes) VALUES ('$electId','$dest2',0)";
        $execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));

    }

    if($_POST["destination3"]!="NULL") {

        $dest3 = $_POST["destination3"];
        $requete = "INSERT INTO participation (IdElection,IdDestination,nbVotes) VALUES ('$electId','$dest3',0)";
        $execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));

    }

    if($_POST["destination4"]!="NULL") {

        $dest4 = $_POST["destination4"];
        $requete = "INSERT INTO participation (IdElection,IdDestination,nbVotes) VALUES ('$electId','$dest4',0)";
        $execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));

    }


    if($_POST["destination5"]!="NULL") {

        $dest5 = $_POST["destination5"];
        $requete = "INSERT INTO participation (IdElection,IdDestination,nbVotes) VALUES ('$electId','$dest5',0)";
        $execute = mysqli_query($connexion, $requete) or die(mysqli_error($connexion));

    }

	header("Location:/ProjetWebS4/organisateur.php");
	exit();

?>
