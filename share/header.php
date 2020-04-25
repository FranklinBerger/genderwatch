<?php
/* --- GenderWatchProtocole · header.php ------
Toutes les procédures d'initialisation de base
Actions:
- Vérifie la session
- Ouverture de la base do donnée sous $database
- Ajout de l'icone et du titre
- Importe le CSS

À ne pas utiliser pour page hors fonctionalité
---------------------------------------------*/

//Ouverture db
include("db.php");

# Démare la session si c'est pas fait
if ( ! isset( $_SESSION ) ){ session_start(); }


// Divers outils html
include("html_module.php");
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="graphic/icone.png" />
	<title>GW - <?php echo $watch_data["name"] ?></title>
	<link rel="stylesheet" href="graphic/css.css" />
</head>