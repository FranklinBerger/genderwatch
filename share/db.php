<?php
// Ouverture DB
try{
	$database = new PDO(
	"mysql:host=localhost;dbname=gender_watch;charset=utf8", "root", "",
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die("Error à l'ouverture de la DB : " . $e->getMessage());
}
?>