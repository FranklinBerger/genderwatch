<?php
/* --- GenderWatchProtocole · init_new_watch.php ------
Initialise un nouveau watch de new_watch.php
1: Vérifie que ce watch est valide
	=> Sinon, repost les infos et renvoie avec un méta
2: Initialise l'entrée dans table watch
---------------------------------------------*/

// Pour récupérer les cookies
session_start();

// Ouverture DB
include("db.php");

// Pour renvoyer avec les infos
function go_back ($new_watch_name , $new_watch_description){
	$get = array(
	"new_watch_name" => $new_watch_name ,
	"new_watch_description" => $new_watch_description,
	"msg" => "Impossible de créer le Watch"
	);
	header("Location:new_watch.php?" . http_build_query($get) );
}


// Vérification infos présentes
if ( isset( $_POST["new_watch_name"] )
AND isset( $_POST["new_watch_description"] )
AND $_POST["new_watch_name"] != ""
AND $_POST["new_watch_description"] != "" ){
	
	$new_watch_name = htmlspecialchars((string)$_POST["new_watch_name"]);
	$new_watch_description = htmlspecialchars((string)$_POST["new_watch_description"]);
	
	
		
	// Récupère les infos du user
	$user_data = (string)$_COOKIE["GW_user"];
	$db_prep_user = $database->prepare("
	SELECT * FROM authorized_user WHERE user = ?");
	$db_prep_user->execute(array($user_data));
	$user_data = $db_prep_user->fetch();
	$db_prep_user->closeCursor();
	
	try{
		// Créer l'entrée dans la table watch
		$add_watch = $database->prepare(
		"INSERT INTO watch 
		(watch_name, watch_description, watch_date, created_by, user_access)
		VALUES
		(:watch_name, :watch_description, NOW(), :created_by, :user_access)");
		
		$add_watch->execute(array(
			"watch_name" => $new_watch_name,
			"watch_description" => $new_watch_description,
			"created_by" => $user_data["id"],
			"user_access" => (string) $user_data["id"].",1,",
			));
			
			// Redirection vers le menu principal
			header("Location:list_watch.php");
	} catch (Exception $e) {
		go_back($_POST["new_watch_name"], $_POST["new_watch_description"]);
	}
	
} else {
	go_back($_POST["new_watch_name"], $_POST["new_watch_description"]);
}


?>
