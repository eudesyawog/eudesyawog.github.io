<script>
document.title =" Action sur les sujets";
</script>
<center>
<div id="main">
<table border="1px" style="width:100%;">
<tr><th><strong> Nom du thème en français </strong></th><th><strong> Nom du thème en espagnol</strong></th><th><strong>Supprimer</strong></th><th> <strong>Modifier </strong></th></tr>
<?php
include_once ("connexion_bd.php");
$query="SELECT * FROM sujet";
$stat = $myPDO->query($query);
$tab = $stat->fetchAll();
foreach($tab as $donnees)
{
echo "<tr><td>".$donnees[1]."</td><td>" .$donnees[2]."</td> <td><a href='index.php?page=formulaire/suppr_theme&id=".$donnees[0]."'> Supprimer </a></td><td><a href='index.php?page=formulaire/modifier_theme&ID_SUJET=".$donnees[0]."'> Modifier </a></td></tr>";
}
?>
</table>
</div>
</center>
