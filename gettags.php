<?php
require("connexion_bd.php");
?>
<center>
<div id="main">


<?php
echo '<h2 id="titre_long">'.$xml->s_tags->$lang.'</h2><hr><br><form method="post" action="?page=galerie_tags">';
$sql="SELECT * FROM sujet;";
$sql2="SELECT * FROM photojournaliste;";
echo '<br><label></label><select
name="gettags">';
echo '<option label=""></option>';
foreach ($myPDO->query($sql) as $row) {
	
$libfr = $row['LIBELLE_FR'];
$libes = $row['LIBELLE_ES'];


if ($getlang == "fr" || $lang == "fr")
{
echo "<option value='$libfr'>$libfr</option>";
}
elseif ($getlang == "es" || $lang == "es")
{
echo "<option value='$libes'>$libes</option>";
}};

echo '</select>';
echo '<br><br><br>'.$xml->selection_2->$lang.'<br>';

echo '<br>';
echo '<select name="author">';
echo '<option label=""></option>';
foreach ($myPDO->query($sql2) as $row) {

$nom = $row['NOM_PJ'];
$prenom = $row['PRENOM_PJ'];


echo "<option value=$nom>$nom"."&nbsp;"."$prenom</option>";
};
echo '</select>';


echo '<br><br><br><button class="btnsearch" type="submit">OK</button>
</form>';

$myPDO=null;
	 
?>
</div>
</center>