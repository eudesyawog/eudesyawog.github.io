<script>
document.title ="Présentation des photojournalistes";
</script>
<center>
<div id="main">
<div id="cont_2">
	<h2><?php echo $xml->photoj->$lang;?></h2><hr> 
<?php
include('connexion_bd.php');
$sql="SELECT * FROM photojournaliste;";	

 foreach ($myPDO->query($sql) as $row) {
	$desfr = $row['DESCRIPTION_PJ_FR'];
	$deses = $row["DESCRIPTION_PJ_ES"];
	$nom = $row['NOM_PJ'];
	$prenom = $row['PRENOM_PJ'];
				
?>				
			
<h3><strong><?php echo $nom.'&nbsp;'.$prenom;?></strong></h3></br>
<!--<p id="p_al"><?php //echo $xml->p_photoj_1_1->$lang;?></p></br>
<p id="p_al"><?php //echo $xml->p_photoj_1_2->$lang;?></p></br>
<p id="p_al"><?php// echo $xml->p_photoj_1_3->$lang;?></p></br>-->
<p id="p_al">
	
<?php if ($getlang == "fr" || $lang == "fr")
{
echo $desfr;
}
elseif ($getlang == "es" || $lang == "es")
{
echo $deses.'<br>';
}
}

$query=null;
$myPDO=null;
?>
</p></br>
</div>
</div>
</center>