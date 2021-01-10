<?php
/* --- GenderWatchProtocole · watch_edit_save.php ------
Sauvegarde les modifications d'une personne dans un watch
---------------------------------------------*/

// Pour récupérer les cookies
session_start();

// Ouverture DB
include("db.php");

// Pour renvoyer avec les infos
function go_back (){
	$get = array(
	"msg" => "Modification impossible"
	);
	header("Location:watch_edit.php?" . http_build_query($get) );
}


// Vérification infos présentes
if ( isset( $_POST["nom"] )
AND isset( $_POST["genre"] )
AND isset( $_POST["person_id"] )
AND isset( $_POST["role"] )
AND $_POST["nom"] != ""
AND in_array($_POST["genre"] , array("F", "T", "H") )
AND in_array($_POST["role"] , array("", "M") )
AND (int)$_POST["person_id"] != 0 ){
	
	$nom = htmlspecialchars((string)$_POST["nom"]);
	$genre = htmlspecialchars((string)$_POST["genre"]);
	$role = htmlspecialchars((string)$_POST["role"]);
	$id = (int)htmlspecialchars((string)$_POST["person_id"]);
	
	
	try{
		// Créer l'entrée dans la table watch
		$add_watch = $database->prepare(
		"UPDATE personnes_watch
		SET nom = ?, genre = ?, role = ?
		WHERE id = ?");
		
		$add_watch->execute(array(
			$nom,
			$genre,
			$role,
			$id
			));
			
			// Redirection vers le menu principal
			header("Location:watch_edit.php");
	} catch (Exception $e) {
		go_back();
	}
	
} else {
	go_back();
}


?>
