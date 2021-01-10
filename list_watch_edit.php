<?php
include("header.php");

//echo print_r($_SESSION["current_watch"]);

// Session: n'est plus dans un watch
if (isset($_SESSION["current_watch"])) {
   $_SESSION["current_watch"] == NULL;
}
?>

<body>
<h2>Bienvenue <?php echo $user_data["user"]; ?></h2>

<!-- Boutons menu -->
<?php bouton_lien("Nouveau Watch", "new_watch.php"); ?>
<?php bouton_lien("Fin Édition", "list_watch.php"); ?>
<?php bouton_lien("Déconnexion", "loggout.php"); ?>

</br>
<?php
//Eventuel message
if (isset($_GET["msg"])) {
   echo "<p>" . $_GET["msg"] . "</p>";
}

?>
</br>


<!-- Affichage des watch -->
<?php
// Extraction tous les watch du compte
$query_all_watch = $database->query("
	SELECT
		w.id AS watch_id,
		w.watch_name,
		w.user_access,
		w.created_by,
		w.watch_description,
		watch_date,
		au.user AS au_created_by
	FROM watch as w
	INNER JOIN authorized_user AS au
	ON au.id = w.created_by
	WHERE user_access REGEXP '" . $user_data["id"] . ",'
	ORDER BY w.id DESC
	");

//Entête
?>
<table>
    <tr>
        <th>Accéder</th>
        <th>Nom du Watch</th>
        <th>Description</th>
        <th>Date de Création</th>
        <th>Crée par</th>
    </tr>
   <?php

   //$a = $query_all_watch->fetch();
   //echo print_r( $a );
   //echo $a["created_by"];

   // Fetch + affichage
   while ($watch = $query_all_watch->fetch()) {
      ?>
       <tr>
           <form method="post" action="list_watch_edit_save.php">
               <td>
                   <input type="hidden" name="watch_id"
                          value="<?php echo $watch["watch_id"]; ?>"/>
                   <button action="submit">Enregistrer</button>
               </td>
               <td>
                   <input type="text" name="name" value="<?php echo $watch["watch_name"]; ?>" style="width: 100%"/>
               </td>
               <td>
			<textarea name="description" style="width: 100%"
            ><?php echo $watch["watch_description"]; ?></textarea>
               </td>
               <td>
                   <input type="text" name="date" value="<?php echo $watch["watch_date"]; ?>" style="width: 100%"/>
               </td>
               <td><?php echo $watch["au_created_by"]; ?></td>
           </form>
       </tr>
   <?php } ?>
</table>

<?php
include("footer.php");
?>
</body>