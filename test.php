<?php
// Définition du content-type
header('Content-Type: image/png');

// Création de l'image
$im = imagecreatetruecolor(400, 30);

// Création de quelques couleurs
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 29, $white);

// Le texte à dessiner
$text = 'Test...';
// Remplacez le chemin par votre propre chemin de police
$font = realpath('lucon.ttf');

// Ajout d'ombres au texte
imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Ajout du texte
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Utiliser imagepng() donnera un texte plus claire,
// comparé à l'utilisation de la fonction imagejpeg()
imagepng($im);
imagedestroy($im);
?>