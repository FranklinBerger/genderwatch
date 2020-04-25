<?php
/* --- GenderWatchProtocole · index.php ------
Permet le loggin des personnes
Vérifie si cookie présent => loggin automatique
---------------------------------------------*/

// Ouverture session et vérification session validée
session_start();
session_destroy();

if ( isset( $_COOKIE["GW_user"] ) AND isset( $_COOKIE["GW_password"] ) ){
	// Cookie de loggin automatique exitsant, on part au loggin
	header("Location:loggin.php");
} else {
	// Pas de loggin automatique, on fait rien
	NULL;
}

//Pour le bouton share
include( "html_module.php" );

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
	<?php
	if ( isset( $_GET["msg"] ) ){
		echo "<p>".$_GET["msg"]."</p>";
	} else {
		echo "</br>";
	}
	?>
	
	<form action = "loggin.php" method = "post" class = "singin_index_input">
		<label for = "index_input_user">Nom d'utilisat·eur·rice : </label>
		</br>
		<input type = "text" name = "index_input_user" 
		class = "singin_index_input"/>
		</br>
		</br>
		<label for = "index_input_pass">Mot de passe : </label>
		</br>
		<input type = "password" name = "index_input_pass" 
		class = "singin_index_input"/>
		</br>
		</br>
		<button action = "submit">Valider</button>
	</form>
	<?php bouton_lien("Voir un Watch partagé", "share"); ?>
	
	
	
	<?php
	include("footer.php");
	?>
</body>
</html>