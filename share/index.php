<?php
/* --- GenderWatchProtocole · index.php ------
Permet l'acceder à un watch partagé
---------------------------------------------*/

//Bouton lien
include( "html_module.php" );

//Redirection si lien court
if ( isset( $_GET["w"] ) ){
	header("Location:watch.php?watch_key=".$_GET["w"]);
}
?>


<?php
	session_start();
	$_SESSION["current_watch"] = NULL;
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="graphic/icone.png" />
	<title>GenderWatch</title>
	<link rel="stylesheet" href="graphic/css.css"/>
</head>
<body>
	
	<h1>Gender Watch</br>Protocole</h1>
	
	<image src = "graphic/logo.png" align="middle" class = "logo_index">
	
	</br>
	</br>
	</br>
	</br>
	<?php
	// Affichage d'un éventuel message d'erreur
	if ( isset($_GET["msg"]) ){
		echo "<p>".$_GET["msg"]."</p>";
	} else {
		NULL;
	}
	?>
	
	
	<form action = "watch.php" method = "get" class = "singin_index_input">
		<label for = "watch_key">Code du watch : </label>
		</br>
		<input type = "text" name = "watch_key" 
		class = "singin_index_input"/>
		</br></br>
		<button action = "submit">Voir</button>
	</form>
	<?php bouton_lien("Retour", ".."); ?>
	
	
	
	<?php
	include("footer.php");
	?>
</body>
</html>