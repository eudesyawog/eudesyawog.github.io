<script>
document.title ="Bienvenue sur Mexico - 1985";
</script>
<?php 
include('connexion_bd.php');
$query = $myPDO->query("SELECT * FROM paragraphe;");
if($query->rowCount() > 0){
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		$preFr = $row['PRELUDE_FR'];
		$preEs = $row['PRELUDE_ES'];
	}
}
?>
<div class="arrow-right"></div> 
	<a href="?lang=es"><img id="fl0" width="30" height="20" src="ico/mx.svg"></img></a>
    <a href="?lang=fr"><img id="fl" width="30" height="20" src="ico/fr.svg"></img></a>
<center>
<div id="main">
	<h1>MEXICO - 1985</h1></br><hr></br> 
	<!--<br><p id="p_al"><?php //echo $xml->p_accueil1->$lang;?><p>
	<br><p id="p_al"><?php //echo $xml->p_accueil2->$lang;?><p>-->
	<p id="p_al"><?php 
	
	if ($getlang == "fr" || $lang == "fr")
{
echo $preFr;
}
elseif ($getlang == "es" || $lang == "es")
{
echo $preEs;
}?>
</p>
</div>
</center>
