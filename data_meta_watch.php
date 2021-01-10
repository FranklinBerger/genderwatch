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

include("db.php");
include("meta_result_tool.php");

# Démare la session si c'est pas fait
if ( ! isset( $_SESSION ) ){ session_start(); }

//Entrée dans le watch par post
if ( isset($_POST["watch_id"]) ){
	$watch_id = (int) $_POST["watch_id"];
}

// Session: enregistre le watch actuel si post présent
if ( isset($watch_id) ){
	$_SESSION["current_watch"] = $watch_id;
	
// Si aucun watch dans la session, renvoi à la liste
} elseif ( !(isset($_SESSION["current_watch"]))
  OR ($_SESSION["current_watch"] == NULL) ){
	header("Location:list_watch.php");
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
user_access,
share_key
FROM watch
WHERE user_access REGEXP '". $user_data["id"] .",'");
$prep_data_watch_info->execute( array( $_SESSION["current_watch"] ) );
$watch_data = $prep_data_watch_info->fetch();
$prep_data_watch_info->closeCursor();

// Extrais toutes les personnes du watch et met dans $data_watch_result
$prep_all_personnes = $database->prepare("
SELECT * FROM personnes_watch WHERE watch = ? ORDER BY nom");
$prep_all_personnes->execute( array( (int)$watch_data["id"] ));

$data_watch_result = array();
while ( $personne = $prep_all_personnes->fetch() ){
	$data_watch_result[] = $personne;
}
$_SESSION["data_watch_result"] = $data_watch_result;


// Claucl de divers autres infos
if ( isset( $_SESSION["data_watch_result"] ) ){
	$data_watch_result = $_SESSION["data_watch_result"];
	$nombre_total_personnes = count_data_with_value(
	"watch", $_SESSION["current_watch"], $data_watch_result);
	$temps_parlé_total = add_all_data_where_dataname_is_value("temps_parlé",
	"watch", $_SESSION["current_watch"], $data_watch_result);
	$nbr_interventions_courte = add_all_data_where_dataname_is_value("parole_courte",
	"watch", $_SESSION["current_watch"], $data_watch_result);
	$nbr_interventions_longue = add_all_data_where_dataname_is_value("parole_longue",
	"watch", $_SESSION["current_watch"], $data_watch_result);
	$nbr_interventions = $nbr_interventions_courte + $nbr_interventions_longue;
	
	// Si nbr personne = 0, nbr personne = 1
	$tot_personne_f = count_data_with_value(
	"genre", "F", $data_watch_result);
	$tot_personne_f = $tot_personne_f ? $tot_personne_f : 1;
	$tot_personne_a = count_data_with_value(
	"genre", "T", $data_watch_result);
	$tot_personne_a = $tot_personne_a ? $tot_personne_a : 1;
	$tot_personne_h = count_data_with_value(
	"genre", "H", $data_watch_result);
	$tot_personne_h = $tot_personne_h ? $tot_personne_h : 1;
}


?>