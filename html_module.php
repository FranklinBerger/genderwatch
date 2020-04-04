<?php
/* --- GenderWatchProtocole · html_module.php ------
Divers modules répétitifs pour HTML
- bouton_lien($texte, $pagelien)
---------------------------------------------*/

// bouton_lien($texte, $pagelien)
function bouton_lien ($texte, $pagelien){
	echo "<form methode = 'post' action = '". $pagelien ."'>";
	echo "<button methode = 'submit'>". $texte ."</button>";
	echo "</form>";
}



?>