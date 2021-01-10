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
<?php bouton_lien("Éditer", "list_watch_edit.php"); ?>
<?php bouton_lien("MetaGW", "meta_result.php"); ?>
<?php bouton_lien("Déconnexion", "loggout.php"); ?>

</br>
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
		DATE_FORMAT(w.watch_date, '%d/%m/%Y %H:%i') AS watch_date,
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
           <td>
               <form method="post" action="watch.php">
                   <input type="hidden" name="watch_id"
                          value="<?php echo $watch["watch_id"]; ?>"/>
                   <button action="submit">Accéder</button>
               </form>
           </td>
           <td><?php echo $watch["watch_name"]; ?></td>
           <td><?php echo $watch["watch_description"]; ?></td>
           <td><?php echo $watch["watch_date"]; ?></td>
           <td><?php echo $watch["au_created_by"]; ?></td>
       </tr>
   <?php } ?>
</table>

<?php
include("footer.php");
?>
</body>