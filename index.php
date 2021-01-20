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

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="graphic/icone.png"/>
    <title>GenderWatch</title>
    <link rel="stylesheet" href="graphic/css.css"/>
</head>
<body>
<div class="appBody marginauto">
    <h1>Gender Watch</br>Protocole</h1>

    <div class="fullwidth flexdiv">
        <img src="graphic/logo.png" class="logo_index">
    </div>
    <?php
    if (isset($_GET["msg"])) {
        echo "<p>" . htmlentities($_GET["msg"]) . "</p>";
    } else {
        echo "</br>";
    }
    ?>

    <form action="loggin.php" method="post" class="bigmargintop marginauto displayblock">
        <label for="index_input_user">Nom d'utilisateur·rice:</label>
        </br>
        <input type="text" name="index_input_user"
               class="singin_index_input widthmozavailable" required autofocus/>
        </br>
        </br>
        <label for="index_input_pass">Mot de passe:</label>
        </br>
        <input type="password" name="index_input_pass"
               class="singin_index_input widthmozavailable" required/>
        </br>
        </br>
        <button>Connexion</button>
    </form>
    <br>
    <div class="flexdiv box-alignright"><?php bouton_lien("Voir un Watch partagé", "share"); ?></div>
</div>

<?php
include("footer.php");
?>
</body>
</html>