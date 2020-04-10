<?php
/* --- GenderWatchProtocole · watch_result_tool.php ------
Divers fonctions pour les résultats du watch.
Besoin d'avoir les données dans la dession sous data_watch_result

---------------------------------------------*/

//Récupération info dans session
if ( session_status() == PHP_SESSION_DISABLED ){
	session_start();
}
$data_watch_result = $_SESSION["data_watch_result"];

// ------------------ Fonctions de comptage-----------------------
//Compte toutes les personnes ayant X à la valleur Y
function count_data_with_value ($dataname, $value, $data_watch_result){
	$nbr = 0;
	foreach ($data_watch_result as $data){
		if ( $data[$dataname] == $value ){
			$nbr++;
		}
	}
	return $nbr;
}

//Liste toutes les personnes ayant X à la valleur Y
function list_data_with_value ($dataname, $value, $data_watch_result){
	$list = array();
	foreach ($data_watch_result as $data){
		if ( $data[$dataname] == $value ){
			$list[] = $data;
		}
	}
	return $list;
}

function add_all_data_where_dataname_is_value (
$dataadd, $dataname, $value, $data_watch_result){
	$nbr = 0;
	foreach ($data_watch_result as $data){
		if ( $data[$dataname] == $value ){
			$nbr += $data[$dataadd];
		}
	}
	return $nbr;
}

// -------------------Fonctions de max --------------------
function max_of_list_list ($array, $param){
	$list = array();
	foreach ( $array as $a ){
		$list[] = $a[$param];
	}
	return max( $list );
}



?>