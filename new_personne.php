<?php
/* --- GenderWatchProtocole · new_personne.php ------
Page pour créer une nouvelle personne
---------------------------------------------*/

include("header.php");

// Récupération anciens nom si problème
if (isset($_POST["new_personne_name"])) {
   $new_personne_name = (string)$_POST["new_personne_name"];
} else {
   $new_personne_name = "";
}
if (isset($_POST["new_personne_gender"])) {
   $new_personne_gender = (string)$_POST["new_personne_gender"];
} else {
   $new_personne_gender = "";
}
if (isset($_GET["new_personne_name"])) {
   $new_personne_name = (string)$_GET["new_personne_name"];
}
if (isset($_GET["new_personne_gender"])) {
   $new_personne_gender = (string)$_GET["new_personne_gender"];
}
if (isset($_GET["new_personne_role"])) {
   $new_personne_role = (string)$_GET["new_personne_role"];
} else {
   $new_personne_role = "";
}

if (isset($_GET["msg"])) {
   $msg = (string)$_GET["msg"];
} else {
   $msg = NULL;
}
?>

<body>
<h2>Nouvelle personne</h2>

<!-- Boutons menu -->
<?php bouton_lien("Annuler", "watch.php"); ?>
<?php bouton_lien("Déconnexion", "loggout.php"); ?>

</br>
<?php echo "<p>" . $msg . "</p>"; ?>
</br>

<!-- Form pour infos -->
<form method="post" action="init_new_personne.php">

    <label for="new_personne_name">Nom:</label>
    <input type="text" name="new_personne_name"
           value='<?php echo $new_personne_name ?>'/>

    </br></br>

    <label for="new_personne_gender">Genre:</label></br>

    <label class="radiobutton">Femme Cisgenre
       <?php
       // Femme* déjà coché? (même pour la suite)
       echo '<input type="radio" name="new_personne_gender" value = "F"';
       if ($new_personne_gender == "F") {
          echo 'checked = "checked">';
       } else {
          echo '>';
       } ?>
        <span class="checkmark"></span>
    </label>
    <label class="radiobutton">Trans / Non-binaire
       <?php
       echo '<input type="radio" name="new_personne_gender" value = "T"';
       if ($new_personne_gender == "T") {
          echo 'checked = "checked">';
       } else {
          echo '>';
       } ?>
        <span class="checkmark"></span>
    </label>
    <label class="radiobutton">Homme Cisgenre
       <?php
       echo '<input type="radio" name="new_personne_gender" value = "H"';
       if ($new_personne_gender == "H") {
          echo 'checked = "checked">';
       } else {
          echo '>';
       } ?>
        <span class="checkmark"></span>
    </label>

    <label class="select" for="new_personne_role">Rôle:</label>
    <select name="new_personne_role" id="new_personne_role">
        <option value="" <?php ($new_personne_role == "") ? "selected" : NULL ?> ></option>
        <option value="M" <?php echo ($new_personne_role == "M") ? "selected" : NULL ?> >Modération</option>
    </select>

    </br></br>
    <button method="submit">Valider</button>
</form>

<?php
include("footer.php");
?>
</body>


















