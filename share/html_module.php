<?php
/* --- GenderWatchProtocole · html_module.php ------
Divers modules répétitifs pour HTML
- bouton_lien($texte, $pagelien)
---------------------------------------------*/

// bouton_lien($texte, $pagelien)
function bouton_lien ($texte, $pagelien){
	echo "<button onclick = \"window.location.href = '".$pagelien."'\">". $texte ."</button>";
}



?>