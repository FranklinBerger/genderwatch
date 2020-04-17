<?php
// Extraction info du watch
include("data_watch.php");
include("header.php");
?>

<body>
	<h2>Résultat: <?php echo $watch_data["name"]; ?></h2>
	
	
	<!-- Boutons menu -->
	<?php bouton_lien("Retour", "index.php"); ?>
	</br>
	
	</br>
	
	<!-- Tableau des personnes -->
	<?php
		
		// Affichage temps parlé total
		echo "<h3>Temps Parlé total:</br>";
		echo $temps_parlé_total . " secondes ou</br>";
		echo (int)($temps_parlé_total / 60) ." minutes ";
		echo ($temps_parlé_total % 60) ." secondes</br></br>";
		echo "Interventions: " . $nbr_interventions. "</br>";
		echo "● Courtes: " . $nbr_interventions_courte . " => ";
		echo (int)($nbr_interventions_courte * 100 / $nbr_interventions) . "[%]</br>";
		echo "● Longue: " . $nbr_interventions_longue . " => ";
		echo (int)($nbr_interventions_longue * 100 / $nbr_interventions) . "[%]</br></h3>";
		
		// Affichage tableau complet
		?>
		</br>
		<table style = "margin-bottom: 2.5%;">
			<tr>
				<th>Valleur</th>
				<th>Moyenne</th>
				<th>Femme Cisgenre</th>
				<th>Trans / Non-binaire</th>
				<th>Homme Cisgenre</th>
			</tr>
			
		<!-- Temps parlé par genre -->
			<tr onclick="window.open('watch_graph/watch_result_graph_data_personne.php?max=tp', '_blank');">
				<td><b>Temps total parlé</b></td>
				<td>
					<?php
					$tppg = ($temps_parlé_total / 3);
					echo (int)$tppg  . "[s]</br>" . (int)($tppg * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
				<td>
					<?php
					$tppg_f = add_all_data_where_dataname_is_value("temps_parlé", "genre", "F", $data_watch_result);
					echo (int)$tppg_f . "[s]</br>" . (int)($tppg_f * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
				<td>
					<?php
					$tppg_a = add_all_data_where_dataname_is_value("temps_parlé", "genre", "T", $data_watch_result);
					echo (int)$tppg_a . "[s]</br>" . (int)($tppg_a * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
				<td>
					<?php
					$tppg_h = add_all_data_where_dataname_is_value("temps_parlé", "genre", "H", $data_watch_result);
					echo (int)$tppg_h . "[s]</br>" . (int)($tppg_h * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
			</tr>
		<!-- Temps moyen parlé par personnes et par genre -->
			<tr onclick="window.open('watch_graph/watch_result_graph_gender_pp.php?max=tp', '_blank');">
				<td><b>Temps moyen parlé par personnes</b></td>
				<td>
					<?php
					$tpmpg = ($temps_parlé_total / $nombre_total_personnes);
					echo (int)$tpmpg  . "[s]</br>" . (int)($tpmpg * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
				<td>
					<?php
					$tpmpg_f = ($tppg_f / $tot_personne_f);
					echo (int)$tpmpg_f  . "[s]</br>" . (int)($tpmpg_f * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
				<td>
					<?php
					$tpmpg_a = ($tppg_a / $tot_personne_a);
					echo (int)$tpmpg_a  . "[s]</br>" . (int)($tpmpg_a * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
				<td>
					<?php
					$tpmpg_h = ($tppg_h / $tot_personne_h);
					echo (int)$tpmpg_h  . "[s]</br>" . (int)($tpmpg_h * 100 / $temps_parlé_total) ."[%]";
					?>
				</td>
			</tr>
		<!-- Nombres d'interventions -->
			<tr onclick="window.open('watch_graph/watch_result_graph_data_personne.php?max=pcpl', '_blank');">
				<td><b>Nombres d'interventions</b></td>
				<td>
					<?php
					$nint = ($nbr_interventions / 3);
					echo (int)$nint  . "</br>" . (int)($nint * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nint_c_f = add_all_data_where_dataname_is_value("parole_courte",
					"genre", "F", $data_watch_result);
					$nint_l_f = add_all_data_where_dataname_is_value("parole_longue",
					"genre", "F", $data_watch_result);
					$nint_f = $nint_c_f + $nint_l_f;
					echo (int)$nint_f . "</br>" . (int)($nint_f * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nint_c_a = add_all_data_where_dataname_is_value("parole_courte",
					"genre", "T", $data_watch_result);
					$nint_l_a = add_all_data_where_dataname_is_value("parole_longue",
					"genre", "T", $data_watch_result);
					$nint_a = $nint_c_a + $nint_l_a;
					echo (int)$nint_a . "</br>" . (int)($nint_a * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nint_c_h = add_all_data_where_dataname_is_value("parole_courte",
					"genre", "H", $data_watch_result);
					$nint_l_h = add_all_data_where_dataname_is_value("parole_longue",
					"genre", "H", $data_watch_result);
					$nint_h = $nint_c_h + $nint_l_h;
					echo (int)$nint_h . "</br>" . (int)($nint_h * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
			</tr>
		<!-- Nombres d'interventions courte -->
			<tr onclick="window.open('watch_graph/watch_result_graph_data_personne.php?max=pc', '_blank');">
				<td><b>● Courte</b></td>
				<td>
					<?php
					$nintc = ($nbr_interventions_courte / 3);
					echo (int)$nintc . "</br>" . (int)($nintc * 100 / $nbr_interventions_courte) ."[%]";
					?>
				</td>
				<td>
					<?php
					echo (int)$nint_c_f . "</br>" . (int)($nint_c_f * 100 / $nbr_interventions_courte) ."[%]";
					?>
				</td>
				<td>
					<?php
					echo (int)$nint_c_a . "</br>" . (int)($nint_c_a * 100 / $nbr_interventions_courte) ."[%]";
					?>
				</td>
				<td>
					<?php
					echo (int)$nint_c_h . "</br>" . (int)($nint_c_h * 100 / $nbr_interventions_courte) ."[%]";
					?>
				</td>
			</tr>
		<!-- Nombres d'interventions longue -->
			<tr onclick="window.open('watch_graph/watch_result_graph_data_personne.php?max=pl', '_blank');">
				<td><b>● Longue</b></td>
				<td>
					<?php
					$nintl = ($nbr_interventions_longue / 3);
					echo (int)$nintl . "</br>" . (int)($nintl * 100 / $nbr_interventions_longue) ."[%]";
					?>
				</td>
				<td>
					<?php
					echo (int)$nint_l_f . "</br>" . (int)($nint_l_f * 100 / $nbr_interventions_longue) ."[%]";
					?>
				</td>
				<td>
					<?php
					echo (int)$nint_l_a . "</br>" . (int)($nint_l_a * 100 / $nbr_interventions_longue) ."[%]";
					?>
				</td>
				<td>
					<?php
					echo (int)$nint_l_h . "</br>" . (int)($nint_l_h * 100 / $nbr_interventions_longue) ."[%]";
					?>
				</td>
			</tr>
		<!-- Nombres d'interventions par personne -->
			<tr onclick="window.open('watch_graph/watch_result_graph_gender_pp.php?max=pcpl', '_blank');">
				<td><b>Nombres d'interventions par personne</b></td>
				<td>
					<?php
					$nintp = ($nbr_interventions / $nombre_total_personnes);
					echo (int)$nintp . "</br>" . (int)($nintp * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_f = ($nint_f / $tot_personne_f);
					echo (int)$nintp_f . "</br>" . (int)($nintp_f * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_a = ($nint_a / $tot_personne_a);
					echo (int)$nintp_a . "</br>" . (int)($nintp_a * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_h = ($nint_h / $tot_personne_h);
					echo (int)$nintp_h . "</br>" . (int)($nintp_h * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
			</tr>
		<!-- Nombres d'interventions courte par personne -->
			<tr onclick="window.open('watch_graph/watch_result_graph_gender_pp.php?max=pc', '_blank');">
				<td><b>● Courte</b></td>
				<td>
					<?php
					$nintp_c = ($nbr_interventions_courte / $nombre_total_personnes);
					echo (int)$nintp_c . "</br>" . (int)($nintp_c * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_c_f = ($nint_c_f / $tot_personne_f);
					echo (int)$nintp_c_f . "</br>" . (int)($nintp_c_f * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_c_a = ($nint_c_a / $tot_personne_a);
					echo (int)$nintp_c_a . "</br>" . (int)($nintp_c_a * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_c_h = ($nint_c_h / $tot_personne_h);
					echo (int)$nintp_c_h . "</br>" . (int)($nintp_c_h * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
			</tr>
		<!-- Nombres d'interventions longue par personne -->
			<tr onclick="window.open('watch_graph/watch_result_graph_gender_pp.php?max=pl', '_blank');">
				<td><b>● Longue</b></td>
				<td>
					<?php
					$nintp_l = ($nbr_interventions_longue / $nombre_total_personnes);
					echo (int)$nintp_l . "</br>" . (int)($nintp_l * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_l_f = ($nint_l_f / $tot_personne_f);
					echo (int)$nintp_l_f . "</br>" . (int)($nintp_l_f * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_l_a = ($nint_l_a / $tot_personne_a);
					echo (int)$nintp_l_a . "</br>" . (int)($nintp_l_a * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
				<td>
					<?php
					$nintp_l_h = ($nint_l_h / $tot_personne_h);
					echo (int)$nintp_l_h . "</br>" . (int)($nintp_l_h * 100 / $nbr_interventions) ."[%]";
					?>
				</td>
			</tr>
		</table>
		
		
		<!-- ---------------------Graphiques------------- -->
		
		<a href = "./watch_graph/watch_result_graph_gender_pp.php" target="_blank">
			<img src = "./watch_graph/watch_result_graph_gender_pp.php"
			class = "img_graph_final" />
		</a>
		
		<a href = "./watch_graph/watch_result_graph_data_personne.php" target="_blank">
			<img src = "./watch_graph/watch_result_graph_data_personne.php"
			class = "img_graph_final" />
		</a>
		
		
		
		
		
<?php
include("footer.php");
?>
</body>