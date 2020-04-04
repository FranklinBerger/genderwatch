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

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="icone.png" />
	<title>GenderWatch</title>
	<link rel="stylesheet" href="css.css"/>
</head>
<body>
	
	<h1>Gender Watch</br>Protocole</h1>
	
	<image src = "logo.png" align="middle" class = "logo_index">
	
	</br>
	</br>
	</br>
	</br>
	
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
	
	
	
	<?php
	include("footer.php");
	?>
</body>
</html>