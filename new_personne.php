<?php
/* --- GenderWatchProtocole · new_personne.php ------
Page pour créer une nouvelle personne
---------------------------------------------*/

include("header.php");

// Récupération anciens nom si problème
if ( isset( $_POST["new_personne_name"] ) ){
	$new_personne_name = (string)$_POST["new_personne_name"];
} else {
	$new_personne_name = "";
}
if ( isset( $_POST["new_personne_gender"] ) ){
	$new_personne_gender = (string)$_POST["new_personne_gender"];
} else {
	$new_personne_gender = "";
}
if ( isset( $_GET["new_personne_name"] ) ){
	$new_personne_name = (string)$_GET["new_personne_name"];
}
if ( isset( $_GET["new_personne_gender"] ) ){
	$new_personne_gender = (string)$_GET["new_personne_gender"];
}

if ( isset( $_GET["msg"] ) ){
	$msg = (string)$_GET["msg"];
} else {
	$msg = NULL;
}
?>

<body>
	<h2>Nouvelle personne</h2>
	
	<!-- Boutons menu -->
	<?php bouton_lien("Annuler", "watch.php");?>
	<?php bouton_lien("Déconnexion", "loggout.php");?>
	
	</br>
	<?php echo "<p>". $msg ."</p>";?>
	</br>
	
	<!-- Form pour infos -->
	<form method = "post" action = "init_new_personne.php">
					
		<label for = "new_personne_name">Nom:</label>
		<input type = "text" name = "new_personne_name"
		value = '<?php echo $new_personne_name ?>' />
		
		</br></br>
		
		<label for = "new_personne_gender">Genre:</label></br>
		
		<label class="radiobutton">Femme*
			<?php
			// Femme* déjà coché? (même pour la suite)
			echo '<input type="radio" name="new_personne_gender" value = "F"';
			if ( $new_personne_gender == "F" ){
				 echo 'checked = "checked">';
			} else {
				echo '>';
			}?>
			<span class="checkmark"></span>
		</label>
		<label class="radiobutton">Autre*
			<?php
			echo '<input type="radio" name="new_personne_gender" value = "A"';
			if ( $new_personne_gender == "A" ){
				 echo 'checked = "checked">';
			} else {
				echo '>';
			}?>
			<span class="checkmark"></span>
		</label>
		<label class="radiobutton">Homme*
			<?php
			echo '<input type="radio" name="new_personne_gender" value = "H"';
			if ( $new_personne_gender == "H" ){
				 echo 'checked = "checked">';
			} else {
				echo '>';
			}?>
			<span class="checkmark"></span>
		</label>
		
		<button method = "submit">Valider</button>
	</form>
	
<?php
include("footer.php");
?>
</body>


















