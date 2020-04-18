<?php
/* --- GenderWatchProtocole · new_personne.php ------
Page pour créer une nouvelle personne
---------------------------------------------*/

include("header.php");
include("data_watch.php");

if ( isset( $_GET["msg"] ) ){
	$msg = (string)$_GET["msg"];
} else {
	$msg = NULL;
}
?>

<body>
	<h2>Partage d'utilisation</h2>
	
	
	
	<?php
	//Vérification modification vient de lea créat·eur·ice
	if ( $user_data["id"] == $watch_data["created_by"] ){
		
	// Boutons menu
	bouton_lien("Retour", "watch.php");
	bouton_lien("Déconnexion", "loggout.php");
	?>
	
	</br><p><u>Attention!</u></br>
	Partager un watch de cette manière donnera tout droit de</br>
	modification, d'utilisation et de partage des résultats du watch.</br>
	Pour donner un accès de visualisation, utilisez le lien ou</br>
	la clé donnée dans les résultats du watch.</p>
	
	<?php echo "<p>". $msg ."</p>";?>
	
	<!-- Form pour infos -->
	<form method = "post" action = "watch_share_act.php">
		<input type="hidden" name="action" value="add" />
		<label for = "name">Nom:</label>
		<input type = "text" name = "name" />
		</br></br>
		<button method = "submit">Partager</button>
	</form>
	
	<!--Affichage avec qui déjà partagé -->
	</br></br>
	<table style="width: 45%;">
		<tr>
			<th>Retirer l'accès</th>
			<th>Nom d'utilisat·eur·rice</th>
		</tr>
		
		
		<?php
		// Pour récupérer le nom
		$getName = $database->prepare("SELECT user FROM authorized_user WHERE id = ?");
		// Récupération accès au watch
		$queryShare = $database->query("
		SELECT user_access
		FROM watch
		WHERE id = " . $watch_data["id"] );
		$user_access = $queryShare->fetch()["user_access"];
		$queryShare->closeCursor();
		$user_access = preg_split("#,#", $user_access);
		
		foreach ( $user_access as $user ){
			if ( ($user != "") AND ($user != "1") AND ($user != $watch_data["created_by"]) ){
				$getName->execute(array( $user ));
				$name = $getName->fetch();
				$getName->closeCursor();
				
				?>
				<tr>
				<td>
					<form method = "post" action = "watch_share_act.php">
						<input type="hidden" name="action" value="remove" />
						<input type="hidden" name="id" value="<?php echo $user; ?>" />
						<button action="submit">Supprimer</button>
					</form>
				</td>
				<td>
					<?php echo $name["user"]; ?>
				</td>
				</tr>
			
			<?php
			}
		}
		
		?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php } else {?>
	<!-- Pas lea créateurice -->
	<p>Seul lea créat·eur·rice du watch peut modifier les droits</br>
	de partage du watch.</p>
	<?php bouton_lien("Retour", "watch.php"); 
	}?>
	
<?php
include("footer.php");
?>
</body>






