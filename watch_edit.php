<?php
include("header.php");

// Extraction info du watch
include("data_watch.php");

?>

<body>
<h2><?php echo $watch_data["name"]; ?></h2>


<!-- Boutons menu -->
<?php bouton_lien("Retour", "list_watch.php"); ?>
<?php bouton_lien("Déconnexion", "loggout.php"); ?>
<?php bouton_lien("Nouvelle personne", "new_personne.php"); ?>
<?php bouton_lien("Fin Édition", "watch.php"); ?>
<?php bouton_lien("Partager", "watch_share.php"); ?>

</br>
<?php
//Eventuel message
if (isset($_GET["msg"])) {
   echo "<p>" . $_GET["msg"] . "</p>";
}
?>
</br>

<!-- Tableau des personnes -->
<?php
// Extrais toutes les personnes du watch
$prep_all_personnes = $database->prepare("
		SELECT * FROM personnes_watch WHERE watch = ? ORDER BY nom");
$prep_all_personnes->execute(array((int)$watch_data["id"]));

// Affiche
?>
<table>
    <tr>
        <th>Enregistrer</th>
        <th>Nom</th>
        <th>Temps parlé</th>
        <th>Prise de parolle longue</th>
        <th>Prise de parolle courte</th>
        <th>Genre</th>
        <th>Rôle</th>
    </tr>
   <?php
   while ($personne = $prep_all_personnes->fetch()) {
      ?>
       <tr>
           <form method="post" action="watch_edit_save.php">
               <td>
                   <input type="hidden" name="person_id"
                          value="<?php echo $personne["id"]; ?>"/>
                   <button action='submit'>Enregistrer</button>
               </td>

               <td>
                   <input type="text" name="nom" value="<?php echo $personne["nom"]; ?>" style="width: 100%"/>
               </td>
               <td><?php echo $personne["temps_parlé"]; ?></td>
               <td><?php echo $personne["parole_longue"]; ?></td>
               <td><?php echo $personne["parole_courte"]; ?></td>
               <td>
                   <select name="genre" style="width: 100%">
                       <option value="F" <?php echo ($personne["genre"] == "F") ? "selected = 'selected'" : ""; ?>>Femme
                           Cisgenre
                       </option>
                       <option value="T" <?php echo ($personne["genre"] == "T") ? "selected = 'selected'" : ""; ?>>Trans
                           / Non-Binaire
                       </option>
                       <option value="H" <?php echo ($personne["genre"] == "H") ? "selected = 'selected'" : ""; ?>>Homme
                           Cisgenre
                       </option>
                   </select>
               </td>
               <td>
                   <select name="role" style="width: 100%">
                       <option value="" <?php echo ($personne["role"] == "") ? "selected = 'selected'" : ""; ?>></option>
                       <option value="M" <?php echo ($personne["role"] == "M") ? "selected = 'selected'" : ""; ?>>
                           Modération
                       </option>
                   </select>
               </td>
           </form>
       </tr>
      <?php
   }
   echo "</table>";
   $prep_all_personnes->closeCursor();


   ?>


   <?php
   include("footer.php");
   ?>
</body>