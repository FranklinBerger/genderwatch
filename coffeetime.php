<?php
/* --- GenderWatchProtocole · index.php ------
Permet le loggin des personnes
Vérifie si cookie présent => loggin automatique
---------------------------------------------*/

// Ouverture session et vérification session validée
session_start();
session_destroy();

if (isset($_COOKIE["GW_user"]) and isset($_COOKIE["GW_password"])) {
   // Cookie de loggin automatique exitsant, on part au loggin
   header("Location:loggin.php");
} else {
   // Pas de loggin automatique, on fait rien
   NULL;
}

//Pour le bouton share
include("html_module.php");

header("HTTP/1.0 418 I'm a teapot")

?>

<header>
    <title>I'm a teapot</title>
</header>
<body>
<center>
    <h1>418 I'm a teapot</h1>
    <h3>Thank you to not misgender me again <3</h3>
</center>
</body>