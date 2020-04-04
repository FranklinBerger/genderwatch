<?php
/* --- GenderWatchProtocole · header.php ------
Toutes les procédures d'initialisation de base
Actions:
- Vérifie la session
- Ouverture de la base do donnée sous $database
- Ajout de l'icone et du titre
- Importe le CSS

À ne pas utiliser pour page hors fonctionalité
---------------------------------------------*/

// Ouverture DB
try{
	$database = new PDO(
	"mysql:host=localhost;dbname=gender_watch;charset=utf8", "root", "",
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die("Error à l'ouverture de la DB : " . $e->getMessage());
}

// Ouverture session et vérification session validée
session_start();

if ( isset( $_SESSION["loged"] ) AND ( $_SESSION["loged"] == TRUE ) ){
	// Session validée, on extrait le nom
	// les infos de l'utiliat·eur·trice pour affichage général
	$user_data = (string)$_COOKIE["GW_user"];
	$db_prep_user = $database->prepare("
	SELECT * FROM authorized_user WHERE user = ?");
	$db_prep_user->execute(array($user_data));
	$user_data = $db_prep_user->fetch();
	$db_prep_user->closeCursor();
	
} else {
	// Session invalidée ou innexistante, on envoie au loggin
	header("Location:loggin.php");
}


// Divers outils html
include("html_module.php");
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="icone.png" />
	<title>GW - <?php echo $user_data["user"] ?></title>
	<link rel="stylesheet" href="css.css"/>
</head>