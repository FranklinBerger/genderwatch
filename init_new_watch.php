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
function go_back($new_watch_name, $new_watch_description)
{
	$get = array(
		"new_watch_name" => $new_watch_name,
		"new_watch_description" => $new_watch_description,
		"msg" => "Impossible de créer le Watch"
	);
	header("Location:new_watch.php?" . http_build_query($get));
}

// Géneration de la clé de share
function generateRandomString($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


// Vérification infos présentes
if (isset($_POST["new_watch_name"])
	and isset($_POST["new_watch_description"])
	and $_POST["new_watch_name"] != ""
	and $_POST["new_watch_description"] != "") {
	
	$new_watch_name = htmlspecialchars((string)$_POST["new_watch_name"]);
	$new_watch_description = htmlspecialchars((string)$_POST["new_watch_description"]);
	
	
	// Récupère les infos du user
	$user_data = (string)$_COOKIE["GW_user"];
	$db_prep_user = $database->prepare("
	SELECT * FROM authorized_user WHERE user = ?");
	$db_prep_user->execute(array($user_data));
	$user_data = $db_prep_user->fetch();
	$db_prep_user->closeCursor();
	
	try {
		// Créer l'entrée dans la table watch
		$add_watch = $database->prepare(
			"INSERT INTO watch 
		(watch_name, watch_description, watch_date, created_by, user_access, share_key)
		VALUES
		(:watch_name, :watch_description, NOW(), :created_by, :user_access, :share_key)");
		
		//Génértion clé de partage
		$checkQ = $database->prepare("
		SELECT * FROM watch WHERE share_key = ?
		");
		$share_key = generateRandomString();
		$checkQ->execute(array($share_key));
		while ($checkQ->fetch()) {
			$checkQ->closeCursor();
			$share_key = generateRandomString();
			$checkQ->execute(array($share_key));
		}
		$checkQ->closeCursor();
		
		// Enregistre dans DB
		$add_watch->execute(array(
			"watch_name" => $new_watch_name,
			"watch_description" => $new_watch_description,
			"created_by" => $user_data["id"],
			"user_access" => (string)$user_data["id"] . ",1,",
			"share_key" => $share_key
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
