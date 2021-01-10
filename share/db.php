<?php
// Ouverture DB
try{
	require "../.const.php";   //get credentials
	$database = new PDO(
		"mysql:host=$dbhost;dbname=$dbname;charset=utf8", $username, $password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die("Error à l'ouverture de la DB : " . $e->getMessage());
}
?>