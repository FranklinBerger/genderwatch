<?php
$PAGE_AFTER_LOGGIN = "list_watch.php";

/* --- GenderWatchProtocole · loggin.php ------
Permet de tester tous les cas de loggin et
crée la session de validation

Cas 1: Loggin par post de index
=> Vérifie user et password puis valide ou non

Cas 2: Loggin automatique par cookie
=> Vérifie user et password crypté puis valide ou non

En entrée, détuit la session pour être au propre
Si session validée, session "loged" à True

À ne pas utiliser pour page hors fonctionalité
---------------------------------------------*/

// Netoyage session
session_start();
session_destroy();
session_start();

// Ouverture DB
try{
	$database = new PDO(
	"mysql:host=localhost;dbname=gender_watch;charset=utf8", "root", "",
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die("Error à l'ouverture de la DB : " . $e->getMessage());
}


// Vérification infos par rapport à la DB
function is_user_alowed ($database, $user, $pass_256){
	$db_verif = $database->prepare(
	"SELECT *
	FROM authorized_user
	WHERE user = ? AND password = ?");
	
	$db_verif->execute( array($user, $pass_256));
	$fetch = $db_verif->fetch();
	$db_verif->closeCursor();
	if ( $fetch ){
		//echo "True";
		return True;
	} else {
		//echo "False";
		return False;
	}
}

// Action si loggin validé
function alow_user ($database, $user, $pass_256){
	$_SESSION["loged"] = True;
	// Les cookies restent 90 jours, après il faut se re-loggin
	setcookie("GW_user", $user, time() + 7776000,
	null, null, false, true);
	setcookie("GW_password", $pass_256, time() + 7776000,
	null, null, false, true);
}


//Cas 1: Loggin par post de index.php
if ( isset( $_POST["index_input_user"] )
AND isset( $_POST["index_input_pass"] ) ){
	$post_user = (string) $_POST["index_input_user"];
	$post_password = (string) $_POST["index_input_pass"];
	
	//echo $post_user;
	//echo $post_password;
	//echo (string)is_user_alowed(
	//$database, $post_user, hash("sha256", $post_password));
	
	// Utilisat·eur·rice autorisé / connu?
	$post_password = hash("sha256", $post_password);
}


//Cas 2: Loggin par cookie
if ( isset( $_COOKIE["GW_user"] ) AND  isset( $_COOKIE["GW_password"] ) ){
	$post_user = (string) $_COOKIE["GW_user"];
	$post_password = (string) $_COOKIE["GW_password"];
}


// Procedure commune: vérifie les infos et init les sessions / cookies
// Utilisat·eur·rice autorisé?
if ( is_user_alowed($database, $post_user, $post_password) ){
	
	//Oui:
	// Valide la session
	$_SESSION["loged"] = True;
	// Init les cookies
	alow_user($database, $post_user, $post_password);
	// Fait continuer
	header("Location:" . $PAGE_AFTER_LOGGIN);
	
} else {
	
	//Non, on le renvoie à la page de loggin
	header("Location:index.php");
	
}





?>
