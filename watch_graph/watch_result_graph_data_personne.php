<?php
header("Content-type: image/png");
session_start();
include("../data_watch.php");


/*
Graphique montrant les informations de chaque personne, soit le temps parlé,
le nombre d'interventions courtes et le nombre d'interventions longue
*/
// Paramètres
$graphX = 1980;
$marge_haut = 200;
$marge_cote = 20;
$marge_bas = 20;
$haut_ligne = 66;	//Multiple de 3
$larg_bande_nom = 350;
$epp_ligne_nom = 3;
$taille_char_nom = 30;
$marge_ligne = 20;
$min_long_bar_txt_up = 0;


$larg_barre = $haut_ligne / 3;
$max_longueure_barre = $graphX - ($marge_cote * 2) - $larg_bande_nom - ($epp_ligne_nom + 1);


// Récupération de toutes les personnes du watch
$list_pers = $_SESSION["data_watch_result"];

//Calcul de la taille 
$graphY = $marge_haut + ($nombre_total_personnes * ($haut_ligne + $marge_ligne)) - $marge_ligne + $marge_bas;
$dataName = "Informations Par Personne";
include("watch_result_graph_brut.php");

// Définition valleurs max
$max_temps_parlé = max_of_list_list($list_pers, "temps_parlé");
$max_parole_courte = max_of_list_list($list_pers, "parole_courte");
$max_parole_longue = max_of_list_list($list_pers, "parole_longue");
$max_parole = max( $max_parole_courte, $max_parole_longue );

// Ligne verticale début barres
$x1 = $marge_cote + $larg_bande_nom;
$y1 = $marge_haut;
$x2 = $marge_cote + $larg_bande_nom + $epp_ligne_nom;
$y2 = $graphY - $marge_bas;
imagefilledrectangle($graph, $x1, $y1, $x2, $y2, $noir);


//Couleur barre en fonction du paramètre
if ( isset($_GET["max"]) ){
	$bckgcol = 220;
	$fgrdcol = 100;
	$col_temps_parlé = imagecolorallocate($graph, $bckgcol, $bckgcol, $bckgcol);
	$col_parole_courte = imagecolorallocate($graph, $bckgcol, $bckgcol, $bckgcol);
	$col_parole_longue = imagecolorallocate($graph, $bckgcol, $bckgcol, $bckgcol);
	
	switch ( $_GET["max"] ){
		case "tp":
			$col_temps_parlé = imagecolorallocate($graph, $fgrdcol, $fgrdcol, $fgrdcol);
			break;
		case "pc":
			$col_parole_courte = imagecolorallocate($graph, $fgrdcol, $fgrdcol, $fgrdcol);
			break;
		case "pl":
			$col_parole_longue = imagecolorallocate($graph, $fgrdcol, $fgrdcol, $fgrdcol);
			break;
		case "pcpl":
			$col_parole_courte = imagecolorallocate($graph, $fgrdcol, $fgrdcol, $fgrdcol);
			$col_parole_longue = imagecolorallocate($graph, $fgrdcol+50, $fgrdcol+50, $fgrdcol+50);
			break;
		default:
			break;
	}
} else {
	$col_temps_parlé = imagecolorallocate($graph, 100, 100, 100);
	$col_parole_courte = imagecolorallocate($graph, 150, 150, 150);
	$col_parole_longue = imagecolorallocate($graph, 200, 200, 200);
}



//Valleur pour chaque personne
$y = $marge_haut;
$x = $marge_cote;
foreach ( $list_pers as $pers ){
	//Ecrit le nom
	$dyC = $x + ($haut_ligne / 2) - ($taille_char_nom / 2);
	imagettftext($graph, $taille_char_nom, 0, $x, $y + $dyC, $noir, $font, substr($pers["nom"], 0, 14) );
	
	// Barre Temps parlé
	$x1 = $x + $larg_bande_nom + ($epp_ligne_nom + 1);
	$y1 = $y;
	$x2 = $x1 + ($pers["temps_parlé"] / $max_temps_parlé) * $max_longueure_barre;
	$y2 = $y1 + $larg_barre;
	imagefilledrectangle($graph, $x1, $y1, $x2, $y2, $col_temps_parlé );
	if ( ($x2 - $x1) < $min_long_bar_txt_up ){$x1 = $x2;}
	imagettftext($graph, $larg_barre - 6, 0, $x1 + 3, $y2 - 3, $noir, $font, $pers["temps_parlé"] );
	
	// Barre parolle courte
	$x1 = $x + $larg_bande_nom + ($epp_ligne_nom + 1);
	$y1 = $y + $larg_barre;
	$x2 = $x1 + ($pers["parole_courte"] / $max_parole) * $max_longueure_barre;
	$y2 = $y1 + $larg_barre;
	imagefilledrectangle($graph, $x1, $y1, $x2, $y2, $col_parole_courte );
	if ( ($x2 - $x1) < $min_long_bar_txt_up ){$x1 = $x2;}
	imagettftext($graph, $larg_barre - 6, 0, $x1 + 5, $y2 - 3, $noir, $font, $pers["parole_courte"] );
	
	// Barre parolle longue
	$x1 = $x + $larg_bande_nom + ($epp_ligne_nom + 1);
	$y1 = $y + $larg_barre*2;
	$x2 = $x1 + ($pers["parole_longue"] / $max_parole) * $max_longueure_barre;
	$y2 = $y1 + $larg_barre;
	imagefilledrectangle($graph, $x1, $y1, $x2, $y2, $col_parole_longue );
	if ( ($x2 - $x1) < $min_long_bar_txt_up ){$x1 = $x2;}
	imagettftext($graph, $larg_barre - 6, 0, $x1 + 3, $y2 - 3, $noir, $font, $pers["parole_longue"] );
	
	
	
	//Prochaine ligne
	$y += $haut_ligne + $marge_ligne;
}



//-------------------------------------- Explication -------------------------------
$larg_rec = 450;
$haut_rec = 30;
$pad_txt = 10;
$x_start = $graphX - $marge_cote - $larg_rec;
$x_end = $graphX - $marge_cote;
$y = $marge_cote;

//temps parlé
imagefilledrectangle($graph, $x_start, $y, $x_end, $y + $haut_rec, $col_temps_parlé );
imagettftext( $graph, $haut_rec - $pad_txt, 0, $x_start + ($pad_txt / 2), $y + $haut_rec - ($pad_txt / 2), $noir, $font, "Temps parlé" );
$y += $haut_rec;

//parole courte
imagefilledrectangle($graph, $x_start, $y, $x_end, $y + $haut_rec, $col_parole_courte );
imagettftext( $graph, $haut_rec - $pad_txt, 0, $x_start + ($pad_txt / 2), $y + $haut_rec - ($pad_txt / 2), $noir, $font, "Parole Courte" );
$y += $haut_rec;

//parole longue
imagefilledrectangle($graph, $x_start, $y, $x_end, $y + $haut_rec, $col_parole_longue );
imagettftext( $graph, $haut_rec - $pad_txt, 0, $x_start + ($pad_txt / 2), $y + $haut_rec - ($pad_txt / 2), $noir, $font, "Parole Longue" );
$y += $haut_rec;








# Renvoie l'image si en mode test
imagepng( $graph );
?>