<?php
header("Content-type: image/png");
session_start();
include("../data_watch.php");
//Définition du graph 
$graphX = 1980;
$graphY = 1080;
$dataName = "Information Moyenne Par Personne";
include("watch_result_graph_brut.php");


/*
Graphique montrant les informations moyene par personne et par genre,
soit le temps de parole, les prises de parole courte et prise de parole longue
*/

// Paramétrage fenêtre
$marge_cote = 75;
$marge_haut = 200;
$marge_bas = 50;
$haut_ligne_horiz = 50;
$epp_ligne_horiz = 3;
$marge_col = 50;
$taille_txt_ref = 30;
$taille_txt_val = 20;
$haut_txt_val = 10;


$larg_col = ($graphX - (2 * $marge_cote) - (3 * $marge_col)) / 4;
$larg_barre = $larg_col / 3;
$haut_max_barre = $graphY - ( $marge_haut + $marge_bas + $haut_ligne_horiz );


// Récupération de toutes les personnes du watch
$list_pers = $_SESSION["data_watch_result"];


// Ligne horizontale
$x1 = $marge_cote;
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz);
$x2 = $graphX - $marge_cote;
$y2 = $y1 - $epp_ligne_horiz;
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $noir );


//Calul des informations à afficher
//Temps moyen parlé par personne (par genre) = temps total parlé (par genre) / nombre total personnes (par genre)
$tpmpg_m = (int)($temps_parlé_total / $nombre_total_personnes);
$tppg_f = add_all_data_where_dataname_is_value("temps_parlé", "genre", "F", $data_watch_result);
$tpmpg_f = (int)($tppg_f / $tot_personne_f);
$tppg_a = add_all_data_where_dataname_is_value("temps_parlé", "genre", "T", $data_watch_result);
$tpmpg_a = (int)($tppg_a / $tot_personne_a);
$tppg_h = add_all_data_where_dataname_is_value("temps_parlé", "genre", "H", $data_watch_result);
$tpmpg_h = (int)($tppg_h / $tot_personne_h);

//Nombre moyen d'interventions courte par personne (par genre) = nombre d'interventiosn courte (par genre) / nombre total personnes (par genre)
$nint_c_m = (int)($nbr_interventions_courte / $nombre_total_personnes);
$totnint_c_f = add_all_data_where_dataname_is_value("parole_courte", "genre", "F", $data_watch_result);
$nint_c_f = (int)($totnint_c_f / $tot_personne_f);
$totnint_c_a = add_all_data_where_dataname_is_value("parole_courte", "genre", "T", $data_watch_result);
$nint_c_a = (int)($totnint_c_a / $tot_personne_a);
$totnint_c_h = add_all_data_where_dataname_is_value("parole_courte", "genre", "H", $data_watch_result);
$nint_c_h = (int)($totnint_c_h / $tot_personne_h);

//Nombre moyen d'interventions longue par personne (par genre) = nombre d'interventiosn longue (par genre) / nombre total personnes (par genre)
$nint_l_m = (int)($nbr_interventions_longue / $nombre_total_personnes);
$totnint_l_f = add_all_data_where_dataname_is_value("parole_longue", "genre", "F", $data_watch_result);
$nint_l_f = (int)($totnint_l_f / $tot_personne_f);
$totnint_l_a = add_all_data_where_dataname_is_value("parole_longue", "genre", "T", $data_watch_result);
$nint_l_a = (int)($totnint_l_a / $tot_personne_a);
$totnint_l_h = add_all_data_where_dataname_is_value("parole_longue", "genre", "H", $data_watch_result);
$nint_l_h = (int)($totnint_l_h / $tot_personne_h);

// Défintiion valleur max barre
$val_max_tpmpg = max($tpmpg_m, $tpmpg_f, $tpmpg_a, $tpmpg_h);
$val_max_nint_c = max($nint_c_m, $nint_c_f, $nint_c_a, $nint_c_h);
$val_max_nint_l = max($nint_l_m, $nint_l_f, $nint_l_a, $nint_l_h);
$val_max_nint = max($val_max_nint_c, $val_max_nint_l );




//Couleur barre en fonction du paramètre
if ( isset($_GET["max"]) ){
	$bckgcol = 240;
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


//-----------------Dessin des barres
//Pour na pas bouffer la barre horizontale d'1px
$epp_ligne_horiz += 1;
//-------------Moyenne
$x = $marge_cote;
$y = $graphY - ($marge_bas + $haut_ligne_horiz);
// Titre centré
$box = imagettfbbox( $taille_txt_ref, 0, $font, "Moyenne" );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x + ($larg_col / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_ref, 0, $x1, $graphY - $marge_bas, $noir, $font, "Moyenne" );
//Barre temps parlé
$x1 = $x;
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($tpmpg_m / $val_max_tpmpg) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_temps_parlé );
$box = imagettfbbox( $taille_txt_val, 0, $font, $tpmpg_m );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $tpmpg_m );
//Barre parolle_courte
$x1 = $x + (1 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_c_m / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_courte );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_c_m );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_c_m );
//Barre parolle_longue
$x1 = $x + (2 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_l_m / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_longue );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_l_m );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_l_m );



//-------------Femme
$x = $marge_cote + $larg_col + $marge_col;
$y = $graphY - ($marge_bas + $haut_ligne_horiz);
// Titre centré
$box = imagettfbbox( $taille_txt_ref, 0, $font, "Femme Cisgenre" );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x + ($larg_col / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_ref, 0, $x1, $graphY - $marge_bas, $noir, $font, "Femme Cisgenre" );
//Barre temps parlé
$x1 = $x;
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($tpmpg_f / $val_max_tpmpg) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_temps_parlé );
$box = imagettfbbox( $taille_txt_val, 0, $font, $tpmpg_f );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $tpmpg_f );
//Barre parolle_courte
$x1 = $x + (1 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_c_f / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_courte );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_c_f );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_c_f );
//Barre parolle_longue
$x1 = $x + (2 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_l_f / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_longue );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_l_f );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_l_f );



//-------------Trans / NB
$x = $marge_cote + (2*($larg_col + $marge_col));
$y = $graphY - ($marge_bas + $haut_ligne_horiz);
// Titre centré
$box = imagettfbbox( $taille_txt_ref, 0, $font, "Trans / Non-Binaire" );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x + ($larg_col / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_ref, 0, $x1, $graphY - $marge_bas, $noir, $font, "Trans / Non-Binaire" );
//Barre temps parlé
$x1 = $x;
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($tpmpg_a / $val_max_tpmpg) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_temps_parlé );
$box = imagettfbbox( $taille_txt_val, 0, $font, $tpmpg_a );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $tpmpg_a );
//Barre parolle_courte
$x1 = $x + (1 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_c_a / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_courte );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_c_a );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_c_a );
//Barre parolle_longue
$x1 = $x + (2 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_l_a / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_longue );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_l_a );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_l_a );



//-------------Homme
$x = $marge_cote + (3*($larg_col + $marge_col));
$y = $graphY - ($marge_bas + $haut_ligne_horiz);
// Titre centré
$box = imagettfbbox( $taille_txt_ref, 0, $font, "Homme Cisgenre" );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x + ($larg_col / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_ref, 0, $x1, $graphY - $marge_bas, $noir, $font, "Homme Cisgenre" );
//Barre temps parlé
$x1 = $x;
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($tpmpg_h / $val_max_tpmpg) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_temps_parlé );
$box = imagettfbbox( $taille_txt_val, 0, $font, $tpmpg_h );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $tpmpg_h );
//Barre parolle_courte
$x1 = $x + (1 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_c_h / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_courte );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_c_h );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_c_h );
//Barre parolle_longue
$x1 = $x + (2 * $larg_barre);
$y1 = $graphY - ($marge_bas + $haut_ligne_horiz + $epp_ligne_horiz);
$x2 = $x1 + $larg_barre;
$y2 = $y1 - (($nint_l_h / $val_max_nint) * $haut_max_barre);
imagefilledrectangle( $graph, $x1, $y1, $x2, $y2, $col_parole_longue );
$box = imagettfbbox( $taille_txt_val, 0, $font, $nint_l_h );
$demi_txt_x = ($box[2] - $box[0]) / 2;
$x1 = $x1 + ($larg_barre / 2) - $demi_txt_x;
imagettftext( $graph, $taille_txt_val, 0, $x1, $y - $haut_txt_val, $noir, $font, $nint_l_h );





//-------------------------------------- Explication -------------------------------
$marge_cote = 20;
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