<?php
// Temps en seconde à partir duquel une prise de parolle est longue
$PRISE_DE_PAROLLE_LONGUE = 120;

/* --- GenderWatchProtocole · act_on_intervention.php ------
Fait les modifications nécessaires à la pression du
bouton intervention dans un watch
Deux cas possible:
1) Commence une intervention
 => enregistre le temps actuel
2) Termine une intervention
 => Calcul la différence de temps entre le temps
 actuel et le début d'inetrvention
 => Ajoute ce temps au temps total parlé
 => Définit si c'est une prise de parolle longue ou courte
 => Fait le nécessaire pour mettre à jour la DB
 le temps parle_depuis et à 0
---------------------------------------------*/

// Pour récupérer les cookies
session_start();

// Ouverture DB
include("db.php");

// Vérification infos présentes
if (isset($_POST["person_id"])
    and ((int)$_POST["person_id"]) != 0) {

   $personne_id = (int)$_POST["person_id"];

   // Récupération infos personne
   $query_personne = $database->query(
       "SELECT * , TIME_TO_SEC(NOW()) AS now
	FROM personnes_watch WHERE id = " . $personne_id);
   $personne_data = $query_personne->fetch();
   $query_personne->closeCursor();

   //Début ou fin d'intervention?
   if ($personne_data["parle_depuis"] == 0) {

      // Début: Enregistre le temps actuel

      $database->exec("
		UPDATE personnes_watch
		SET parle_depuis = TIME_TO_SEC(NOW())
		WHERE id = " . $personne_id);

      header("Location:watch.php");

   } else {

      // Termine une intervention
      // => Calcul la différence de temps entre le temps
      // actuel et le début d'inetrvention
      // => Ajoute ce temps au temps total parlé
      // => Définit si c'est une prise de parolle longue ou courte
      // => Fait le nécessaire pour mettre à jour la DB
      // le temps parle_depuis et à 0

      //Calcule le temps parlé
      // Le modulo permet le saut de minuit
      // Ex: Début à 86390 fin à 20 => -86370 et modulo 86400 (24h) => 30 secondes
      $temps_parlé = ($personne_data["now"] - $personne_data["parle_depuis"]) % 86400;

      // Prise de parolle longue ou courte
      if ($temps_parlé > $PRISE_DE_PAROLLE_LONGUE) {
         // Longue
         $pp_L = 1;
         $pp_c = 0;
      } else {
         // Courte
         $pp_L = 0;
         $pp_c = 1;
      }


      // Mise à jour DB
      $database->exec("
		UPDATE personnes_watch
		SET parle_depuis = 0,
		temps_parlé = temps_parlé + " . $temps_parlé . ",
		parole_longue = parole_longue + " . $pp_L . ",
		parole_courte = parole_courte + " . $pp_c . "
		WHERE id = " . $personne_id);


      header("Location:watch.php");

   }

} else {
   //header("Location:watch.php");
}


?>
