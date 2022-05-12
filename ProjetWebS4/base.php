<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>base</title>
</head>
<body>
	<?php 
		//echo "<br>rentré dans base.php";
		$dbhost = "localhost";
		$dbname = "ProjetWebS4";
		$dbuser = "root";
		$dbpassword = "password";

		try{
			$connection = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser);
			
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	?>
</body>
</html>