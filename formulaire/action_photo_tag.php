<script>
document.title =" Action sur les tags de photos";
</script>
<center>
<div id="main">
<table border="1px" style="width:100%;color:#4CAF50">
<tr><th><strong> Titre de la photo </strong></th><th><strong>Nom du thème en français</strong></th><th><strong>Nom du thème en espagnol</strong></th><th><strong>Supprimer</strong></th><th><strong>Modifier </strong></th></tr>
<?php
include_once ("connexion_bd.php");
$query = "SELECT NOM_PHOTO, LIBELLE_FR, LIBELLE_ES, sujetphoto.ID_SUJET, sujetphoto.ID_PHOTO, TITRE FROM photo, sujet, sujetphoto WHERE photo.ID_PHOTO = sujetphoto.ID_PHOTO AND sujet.ID_SUJET = sujetphoto.ID_SUJET ORDER BY NOM_PHOTO " ;
$stat = $myPDO->query($query);
$tab = $stat->fetchAll();
foreach($tab as $donnees)
{
echo "<tr><td>".$donnees[5]."</td><td>" .$donnees[1]."</td><td>" .$donnees[2]."</td><td><a href='index.php?page=formulaire/suppr_photo_tag&idsujet=".$donnees[3]."&idphoto=".$donnees[4]."'> Supprimer </a></td><td><a href='index.php?page=formulaire/modifier_photo_tag&idsujet=".$donnees[3]."&idphoto=".$donnees[4]."'>Modifier </a></td></tr>";
}
?>
</div>
</center>


