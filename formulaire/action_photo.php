<script>
document.title =" Action sur les photos";
</script>
<center>
<div id="main">
<table border="1px" style="width:100%;">
<tr><th><strong> Titre de la photo  </strong></th><th><strong>Nom du photographe </strong></th><th><strong>Supprimer</strong></th><th><strong>Modifier </strong></th></tr>
<?php
include("connexion_bd.php");
$query = "SELECT CONCAT(PRENOM_PJ,' ',NOM_PJ) AS 'Nom du photographe', DESCRIPTION_PJ_FR, NOM_PHOTO, ID_PHOTO, TITRE FROM photojournaliste,photo WHERE photojournaliste.ID_PJ = photo.ID_PJ" ;
$stat = $myPDO->query($query);
$tab = $stat->fetchAll();
foreach($tab as $donnees)
{
echo "<tr><td>".$donnees[4]."</td><td>" .$donnees[0]."</td><td><a href='index.php?page=formulaire/suppr_photo&id=".$donnees[3]."'> Supprimer </a></td><td><a href='index.php?page=formulaire/modifier_photo&id_photo=".$donnees[3]."'> Modifier </a></td></tr>";
}
?>
</table>
</div>
</center>