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
<?php bouton_lien("Éditer", "watch_edit.php"); ?>
<?php bouton_lien("Voir résultats", "watch_result.php"); ?>

</br></br>

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
        <th>Intervention</th>
        <th>Nom</th>
        <th>Temps parlé</th>
        <th>Prise de parolle longue</th>
        <th>Prise de parolle courte</th>
        <th>Genre</th>
        <th>Rôle</th>
    </tr>
   <?php
   while ($personne = $prep_all_personnes->fetch()) {
      if ($personne["parle_depuis"] == 0) {
         // Pas en intervention => bouton gris etc...
         $bouton_interv = "<button action = 'submit' >
				Démarrer</button>";
      } else {
         // En intervention => bouton vert etc...
         $bouton_interv = "<button action = 'submit'
				style = 'background-color: #7cb179;'>
				Arrêter</button>";
      }
      ?>
       <tr>
           <td>
               <form method="post" action="act_on_intervention.php">
                   <input type="hidden" name="person_id"
                          value="<?php echo $personne["id"]; ?>"/>
                  <?php echo $bouton_interv; ?>
               </form>
           </td>
           <td><?php echo $personne["nom"]; ?></td>
           <td><?php echo $personne["temps_parlé"]; ?></td>
           <td><?php echo $personne["parole_longue"]; ?></td>
           <td><?php echo $personne["parole_courte"]; ?></td>
           <td><?php echo $personne["genre"]; ?></td>
           <td><?php echo $personne["role"]; ?></td>
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