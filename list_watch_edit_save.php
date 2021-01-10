<?php
/* --- GenderWatchProtocole · list_watch_edit_save.php ------
sauvragerde les modifications des infos du watch
---------------------------------------------*/

// Pour récupérer les cookies
session_start();

// Ouverture DB
include("db.php");

// Pour renvoyer avec les infos
function go_back()
{
   $get = array(
       "msg" => "Modification impossible"
   );
   header("Location:list_watch_edit.php?" . http_build_query($get));
}


// Vérification infos présentes
if (isset($_POST["name"])
    and isset($_POST["description"])
    and isset($_POST["date"])
    and $_POST["name"] != ""
    and $_POST["description"] != ""
    and preg_match("#^[0-9]{4}-[0-1]\d-[0-3]\d [0-2]\d:[0-5]\d:[0-5]\d$#", $_POST["date"])) {

   $name = htmlspecialchars((string)$_POST["name"]);
   $description = htmlspecialchars((string)$_POST["description"]);
   $date = htmlspecialchars((string)$_POST["date"]);


   try {
      // Créer l'entrée dans la table watch
      $add_watch = $database->prepare(
          "UPDATE watch 
		SET watch_name = ?, watch_description = ?, watch_date = ?
		WHERE id = ? ");

      $add_watch->execute(array(
          $name,
          $description,
          $date,
          $_POST["watch_id"]
      ));

      // Redirection vers le menu principal
      header("Location:list_watch_edit.php");
   } catch (Exception $e) {
      //go_back();
   }

} else {
   go_back();
}


?>
