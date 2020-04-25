<?php
/*
Structure de base pour la cération de graphs pour les résultats du watch
Si les valleus $dataName et / ou $graphY ne sont pas définies, la taille de base est de 1980 x 1080
L'image fait toujours 1980 de large
Met le logo et le nom du watch en haut à gauche. Pour continuer le graph, commencer à 150 minimum

Met le tout dans $graph
*/


# Récupération taille graph ou set si rien donné
# De même, signifie qu'il faut renvoyer l'image et pas la laisser comme variable
$graphX = 1980;
if ( ! ( isset($graphY) AND isset($dataName) ) ){
	$graphY = 1080;
	$dataName = "Génération de test";
	$testMode = True;
	include("../db.php");
	include("../data_watch.php");
	header("Content-type: image/png");
} else {
	$testMode = False;}

# Crée l'image
$graph = imagecreate($graphX, $graphY);

# Couleurs
$blanc = imagecolorallocate($graph, 255, 255, 255);
$noir = imagecolorallocate($graph, 0, 0, 0);

# Font
$font = realpath("../graphic/lucon.ttf");

# Logo
$tailleLogo = array(150, 150);
$logo = imagecreatefrompng("../graphic/logoGraph.png");
$logoS = imagecreate($tailleLogo[0], $tailleLogo[1]);
$a = imagecolorallocate($logoS, 255, 255, 255);
imagecopyresampled($logoS, $logo, 0, 0, 0, 0, $tailleLogo[0], $tailleLogo[1], imagesx($logo), imagesy($logo));
imagecopymerge($graph, $logoS, 10, 10, 0, 0, imagesx($logoS), imagesy($logoS), 100);


# Titre
$txtT = 40;
$txtM = 10;
$txtMX = 25;
imagettftext($graph, $txtT, 0, $tailleLogo[0]+$txtMX, $txtT+$txtM, $noir, $font, "GenderWatch");
imagettftext($graph, $txtT, 0, $tailleLogo[0]+$txtMX, 2*($txtT+$txtM), $noir, $font, $watch_data["name"]);
imagettftext($graph, $txtT, 0, $tailleLogo[0]+$txtMX, 3*($txtT+$txtM), $noir, $font, $dataName);


# Renvoie l'image si en mode test
if ( $testMode ){ imagepng( $graph ); }
?>