<script>
document.title =" Action sur les photographes";
</script>
<center>
<div id="main">
<table border="1px" style="width:100%;color:#4CAF50">
<tr><th><strong> Nom du photograpge </strong></th><th><strong> Prénom du photographe </strong></th><th><strong>Supprimer</strong></th><th><strong>Modifier </strong></th></tr>
<?php
include_once ("connexion_bd.php");
$query = "SELECT * FROM photojournaliste";
$stat = $myPDO->query($query);
$tab = $stat->fetchAll();
foreach($tab as $donnees)
{
echo "<tr><td>".$donnees[1]."</td><td>" .$donnees[2]."</td><td><a href='index.php?page=formulaire/suppr_photographe&id=".$donnees[0]."'> Supprimer </a></td><td><a href='index.php?page=formulaire/modifier_photographe&ID_PJ=".$donnees[0]."'> Modifier </a></td></tr>";
}
?>
</table>
</div>
</center>
