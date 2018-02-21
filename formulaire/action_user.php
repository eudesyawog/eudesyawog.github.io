<script>
document.title ="Action sur les  utilisateurs";
</script>
<center>
<div id="main">
<table border="1px" style="width:70% ; color:#4CAF50">
<tr><th><strong> Pseudo  </strong></th><th><strong>Mail de l'utilisateur</strong></th><th><strong>Supprimer</strong></th><th><strong>Modifier </strong></th></tr>
<?php
include_once ("connexion_bd.php");
$query = "SELECT * FROM utilisateur" ;
$stat = $myPDO->query($query);
$tab = $stat->fetchAll();
foreach($tab as $donnees)
{
echo "<tr><td>".$donnees[1]."</td><td>" .$donnees[3]."</td><td><a href='index.php?page=formulaire/suppr_user&id=".$donnees[0]."'> Supprimer </a></td><td><a href='index.php?page=formulaire/modifier_user&ID_USER=".$donnees[0]."'> Modifier </a></td></tr>";
}
?>
</table>
</div>
</center>
