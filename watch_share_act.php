<?php
/* --- GenderWatchProtocole · watch_share_act.php ------
Modifie les accès à un watch donné
Peut être un ajout ou une supression d'accès
---------------------------------------------*/

include("header.php");
include("data_watch.php");
// Ouverture DB
include("db.php");

// Pour renvoyer avec les infos
$stop = False;
function go_back (){
	global $stop;
	$stop = True;
	$get = array(
	"msg" => "Modification des accès impossible."
	);
	header("Location:watch_share.php?" . http_build_query($get) );
}
if ( $user_data["id"] != $watch_data["created_by"] ){ go_back(); }



// Vérification infos présentes
if ( ! isset($_POST["action"]) ){ go_back(); }
if ( $_POST["action"] == "remove" ){
	if ( ! isset($_POST["id"]) ){ go_back(); }
}
if ( $_POST["action"] == "add" ){
	if ( ! isset($_POST["name"]) ){ go_back(); }
}


// Ajout
try{
if ( $_POST["action"] == "add" ){
	$name = $_POST["name"];
	
	//Récupération de l'ID
	$getID = $database->prepare("SELECT id FROM authorized_user WHERE user = ?");
	$getID->execute(array( $name ));
	$id = $getID->fetch();
	$getID->closeCursor();
	$id = $id["id"];
	
	// Vérification id
	if ( !isset( $id ) OR $id == "" ){ go_back(); }
	
	// Récupération anciens droits
	$oldaccessQ = $database->query("SELECT user_access FROM watch WHERE id = ".$watch_data["id"] );
	$oldaccess = $oldaccessQ->fetch();
	$oldaccessQ->closeCursor();
	$oldaccess = $oldaccess["user_access"];
	
	//Ajout accès
	$newaccess = $oldaccess . $id . ",";
	
	if ( !$stop ){
		$database->exec("
		UPDATE watch SET user_access = '". $newaccess ."' WHERE id = ". $watch_data["id"] );
	}
	
	header("Location:watch_share.php");
}
} catch (Exception $e) {
	go_back();
}



// Suppression
try{
if ( $_POST["action"] == "remove" ){
	$id = $_POST["id"];
	
	// Récupération anciens droits
	$oldaccessQ = $database->query("SELECT user_access FROM watch WHERE id = ".$watch_data["id"] );
	$oldaccess = $oldaccessQ->fetch();
	$oldaccessQ->closeCursor();
	$oldaccess = $oldaccess["user_access"];
	
	//Suppression accès
	$newaccess = preg_replace ( "#". $id .",#" , "" , $oldaccess);
	
	if ( !$stop ){
		$database->exec("
		UPDATE watch SET user_access = '". $newaccess ."' WHERE id = ". $watch_data["id"] );
	}
	
	header("Location:watch_share.php");
}
} catch (Exception $e) {
	go_back();
}


?>
