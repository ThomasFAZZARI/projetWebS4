<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Organiser une nouvelle élection</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="organisateur.php">Accueil</a>
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
<?php




$destinations = array();

$connexion = mysqli_connect("localhost", "root", "") or die("Impossible de se connecter : " . mysqli_error($connexion));
mysqli_select_db($connexion, "ProjetWebS4");
$requete = "SELECT * FROM destinationstest";
$results = mysqli_query($connexion, $requete);
//create a multi dimensional array with names per category


$destination_combobox_php = "";
$name_combo_boxes_html = "";
//create category combo_box
$destination_combobox_php .= '<option value="NULL"> Choix </option>';
while ($row = mysqli_fetch_object($results)) {
    $destination_combobox_php .= '<option value="' . $row->id . '">' . $row->name . '</option>';
}

?>

<body>
    <form class="form-horizontal"  onsubmit="return verifier()"  method="POST" name="formulaire" action="scripts/scriptCreationElection.php" style="width:100%;margin:auto;">
        <div class="form-group">
            <label for="titre" class="col-sm-2 control-label">Titre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required id="titre" name="titre" placeholder="Nom de l'élection">
            </div>
        </div>
        <div class="form-group">
            <label for="destination1" class="col-sm-2 control-label">Destination 1</label>
            <div class="col-sm-10">
                <select name="destination1" class="form-control" required id="destination1">
                    <?php echo $destination_combobox_php; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="destination2" class="col-sm-2 control-label">Destination 2</label>
            <div class="col-sm-10">
                <select name="destination2" class="form-control" required id="destination2">
                    <?php echo $destination_combobox_php; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="destination3" class="col-sm-2 control-label">Destination 3</label>
            <div class="col-sm-10">
                <select name="destination3" class="form-control" id="destination3">
                    <?php echo $destination_combobox_php; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="destination4" class="col-sm-2 control-label">Destination 4</label>
            <div class="col-sm-10">
                <select name="destination4" class="form-control" id="destination4">
                    <?php echo $destination_combobox_php; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="destination5" class="col-sm-2 control-label">Destination 5</label>
            <div class="col-sm-10">
                <select name="destination5" class="form-control" id="destination5">
                    <?php echo $destination_combobox_php; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="submit" class="btn btn-dark" value="Créer mon élection">
            </div>
        </div>
    </form>
</body>

<script>

    function verifier() {
        const form = document.formulaire;

        if (form.destination1.value === "NULL") {
            alert("destination 1 obligatoire");
            return false;
        }
        if (form.destination2.value === "NULL") {
            alert("destination 2 obligatoire");
            return false;
        }
        if (hasDoublons()) {
            alert("Doublons");
            return false;
        }

        return true;

    }

    function hasDoublons() {
        //Créer tableau avec tous les select
        const selects = document.querySelectorAll('select');
        const valeurs = [];
        Array.from(selects).forEach((select) => {
            if (select.value !== "NULL") {
                valeurs.push(select.value);
            }
            
        });
        return (new Set(valeurs)).size !== valeurs.length;
    }
</script>