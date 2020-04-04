<?php
/* --- GenderWatchProtocole · loggout.php ------
Logout l'utilisat·eur·rice
- Détruit la session
- Supprime les cookies
---------------------------------------------*/

// Détruit la session
session_start();
$_SESSION["loged"] = False;

// Supprime les cookies
setcookie("GW_user", NULL, 0,
null, null, false, true);
setcookie("GW_password", NULL, 0,
null, null, false, true);

//Renvoi à la page de login
header("Location:index.php");

?>
