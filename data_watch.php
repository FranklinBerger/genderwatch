<?php
/* --- GenderWatchProtocole · data_watch.php ------
Extrait dans $watch_data l'entrée de watch
Renome les valleurs à:
- id
- name
- description
- date
- created_by
- user_access
Fait les modifications en cas de post aussi
À executer après header.php
---------------------------------------------*/

//Vérifie le post
if ( isset($_POST["watch_id"]) ){
	$watch_id = (int) $_POST["watch_id"];
}

// Session: enregistre le watch actuel si post présent
if ( isset($watch_id) ){
	$_SESSION["current_watch"] = $watch_id;
	
// Si aucun watch dans la session, renvoi à la liste
} elseif ( !(isset($_SESSION["current_watch"]))
  OR ($_SESSION["current_watch"] == NULL) ){
	header("Location:liste_watch.php");
}
// watch_id présent dans la session

//Extrait les infos
$prep_data_watch_info = $database->prepare(
"SELECT
id AS id,
watch_name AS name,
watch_description AS description,
DATE_FORMAT(watch_date, '%d/%m/%Y %H:%i') AS date,
created_by,
user_access
FROM watch WHERE id = ?");
$prep_data_watch_info->execute( array( $_SESSION["current_watch"] ) );
$watch_data = $prep_data_watch_info->fetch();
$prep_data_watch_info->closeCursor();

?>