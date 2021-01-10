<?php
include("header.php");

// Récupération anciens nom si problème
if (isset($_POST["new_watch_name"])) {
   $new_watch_name = (string)$_POST["new_watch_name"];
} else {
   $new_watch_name = "";
}
if (isset($_POST["new_watch_description"])) {
   $new_watch_description = (string)$_POST["new_watch_description"];
} else {
   $new_watch_description = "";
}
if (isset($_GET["new_watch_name"])) {
   $new_watch_name = (string)$_GET["new_watch_name"];
}
if (isset($_GET["new_watch_description"])) {
   $new_watch_description = (string)$_GET["new_watch_description"];
}

if (isset($_GET["msg"])) {
   $msg = (string)$_GET["msg"];
} else {
   $msg = NULL;
}
?>

<body>
<h2>Nouveau Watch</h2>

<!-- Boutons menu -->
<?php bouton_lien("Annuler", "list_watch.php"); ?>
<?php bouton_lien("Déconnexion", "loggout.php"); ?>

</br>
<?php echo "<p>" . $msg . "</p>"; ?>
</br>

<form method="post" action="init_new_watch.php">
    <label for="new_watch_name">Nom:</label></br>
    <input type="text" name="new_watch_name"
           value='<?php echo $new_watch_name ?>'/>
    </br></br>
    <label for="new_watch_description">Description:</label></br>
    <textarea name="new_watch_description" rows="10"
    ><?php echo $new_watch_description ?></textarea>
    </br>
    <button method="submit">Valider</button>
</form>

<?php
include("footer.php");
?>
</body>