<?php
/* --- GenderWatchProtocole · init_new_personne.php ------
Initialise une nuvelle personne de new_personne.php
1: Vérifie que cette personne soit valide
	=> Sinon, repost les infos et renvoie avec un méta
2: Initialise l'entrée dans table personnes_watch
---------------------------------------------*/

// Pour récupérer les cookies
session_start();

// Ouverture DB
include("db.php");

// Pour renvoyer avec les infos
function go_back($new_personne_name, $new_personne_gender, $new_personne_role)
{
   $get = array(
       "new_personne_name" => $new_personne_name,
       "new_personne_gender" => $new_personne_gender,
       "new_personne_role" => $new_personne_role,
       "msg" => "Impossible de créer la personne"
   );
   header("Location:new_personne.php?" . http_build_query($get));
}


// Vérification infos présentes
if (isset($_POST["new_personne_name"])
    and isset($_POST["new_personne_gender"])
    and isset($_POST["new_personne_role"])
    and $_POST["new_personne_name"] != ""
    and in_array($_POST["new_personne_gender"], array("F", "T", "H"))
    and in_array($_POST["new_personne_role"], array("", "M"))) {

   $new_personne_name = htmlspecialchars((string)$_POST["new_personne_name"]);
   $new_personne_gender = htmlspecialchars((string)$_POST["new_personne_gender"]);
   $new_personne_role = htmlspecialchars((string)$_POST["new_personne_role"]);


   try {
      // Créer l'entrée dans la table watch
      $add_watch = $database->prepare(
          "INSERT INTO personnes_watch
		(watch, nom, genre, role, temps_parlé, parole_longue, parole_courte, parle_depuis)
		VALUES
		(?, ?, ?, ?, ?, ?, ?, ?)");

      $add_watch->execute(array(
          $_SESSION["current_watch"],
          $new_personne_name,
          $new_personne_gender,
          $new_personne_role,
          0,
          0,
          0,
          0));

      // Redirection vers le menu principal
      header("Location:watch.php");
   } catch (Exception $e) {
      go_back($_POST["new_personne_name"], $_POST["new_personne_gender"], $_POST["new_personne_role"]);
   }

} else {
   go_back($_POST["new_personne_name"], $_POST["new_personne_gender"], $_POST["new_personne_role"]);
}


?>
