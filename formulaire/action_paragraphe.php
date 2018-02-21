<script>
document.title =" Action sur les paragraphes";
</script>
<center>
<div id="main">
<table border="1px" style="width:100%; color:#4CAF50">
<tr><th><strong> Prélude </strong></th><th><strong>Accueil</strong><th><strong>Projet</strong></th><th><strong>Supprimer</strong></th><th><strong>Modifier </strong></th></tr>
<?php
include_once ("connexion_bd.php");
$query = "SELECT * FROM paragraphe" ;
$stat = $myPDO->query($query);
$tab = $stat->fetchAll();
foreach($tab as $donnees)
{
echo "<tr><td>".$donnees[1]."</td><td>" .$donnees[3]."</td><td>" .$donnees[5]."</td><td><a href='index.php?page=formulaire/suppr_paragraphe&id=".$donnees[0]."'> Supprimer </a></td><td><a href='index.php?page=formulaire/modifier_paragraphe&ID_PRG=".$donnees[0]."'> Modifier </a></td></tr>";
}
?>
</table>
 <p style="color:Tomato; font-family: verdana; font-size : 14;">
En cliquant sur les liens vous pourrez <strong>supprimer ou modifier </strong> les informations dans les deux langues
</p>
</center>
</div>
