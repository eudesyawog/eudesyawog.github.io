<script>
document.title ="Modifier les paragraphes du site";
</script>
<?php
if (isset($_GET['ID_PRG'])){
	include("connexion_bd.php");
	$query = $myPDO->prepare ("SELECT * FROM paragraphe where ID_PRG= ?");
	$donnees = $query->execute(array($_GET['ID_PRG']));
	$donnees = $query->fetch();	
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/modifier_paragraphe" > 
<input type="hidden" name="ID_PRG" id="ID_PRG" value="<?php echo $donnees['ID_PRG']?>"/>
<label for="prelude"> Paragraphe prelude :</label>
<textarea  name="prelude" id="prelude"   rows="10" cols="50" maxlength="100000000" value='<?php echo $donnees['PRELUDE_FR'];?>'></textarea>
<br/>
<br/>
<label for="accueil"> Paragraphe accueil :</label>
<textarea  name="accueil" id="accueil"   rows="10" cols="50" maxlength="100000000" value=<?php echo $donnees['ACCUEIL_FR'];?>></textarea>
<br/>
<br/>
<label for="projet"> Paragraphe projet :</label>
<textarea  name="projet" id="projet"   rows="10" cols="50" maxlength="100000000" value=<?php echo $donnees['PROJET_FR'];?>></textarea>
<br/>
<br/>
<label for="prelude_es"> Paragraphe prelude en espagnol :</label>
<textarea  name="prelude_es" id="prelude_es"   rows="10" cols="50" maxlength="100000000" value=<?php echo $donnees['PRELUDE_ES'];?>></textarea>
<br/>
<br/>
<label for="accueil_es"> Paragraphe accueil en espagnol :</label>
<textarea  name="accueil_es" id="accueil_es"   rows="10" cols="50" maxlength="100000000" value=<?php echo $donnees['ACCUEIL_ES'];?>></textarea>
<br/>
<br/>
<label for="projet_es"> Paragraphe projet en espagnol :</label>
<textarea  name="projet_es" id="projet_es"   rows="10" cols="50" maxlength="100000000" value=<?php echo $donnees['PROJET_ES'];?> ></textarea>
<br/>
<br/>
<input type="submit" name="modifier" value="Modifier" />  
</form>
<?php
}
if (isset($_POST['modifier'])){
	 $ID=$_POST['ID_PRG'];
     $prelude=$_POST['prelude'];
	 $accueil=$_POST['accueil'];
     $projet=$_POST['projet'];     
	 $prelude_es=$_POST['prelude_es'];
	 $accueil_es=$_POST['accueil_es'];
     $projet_es=$_POST['projet_es'];
	 include("connexion_bd.php");
	 $sql="UPDATE paragraphe SET PRELUDE_FR=?, PRELUDE_ES=?,ACCUEIL_FR= ?,ACCUEIL_ES=?, PROJET_FR=?,PROJET_ES= ? WHERE ID_PRG=?";
	 $req = $myPDO-> prepare($sql);
	 $req->setFetchMode(PDO::FETCH_ASSOC);
	 $req->execute(array($prelude,$prelude_es,$accueil,$accueil_es,$projet,$projet_es,$ID))or die(print_r($myPDO->errorInfo()));
			if($req){
					$req->closeCursor();
					$myPDO=null;
		echo '<body onLoad="alert(\'Vos données ont bien été modifiées. Vous allez être redirigé vers la page membre \')">'; 
 
		echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
		}
}
?>
</div>
<center>



