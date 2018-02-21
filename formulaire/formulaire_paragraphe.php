<script>
document.title =" Ajouter des paragraphes";
</script>
<?php
if (!isset($_POST['prelude']) && !isset($_POST['accueil'])){
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/formulaire_paragraphe">  
<label for="prelude"> Paragraphe prelude :</label>
<textarea  name="prelude" id="prelude"   rows="10" cols="50" maxlength="100000000"></textarea>
<br/>
<br/>
<label for="accueil"> Paragraphe accueil :</label>
<textarea  name="accueil" id="accueil"   rows="10" cols="50" maxlength="100000000" ></textarea>
<br/>
<br/>
<label for="projet"> Paragraphe projet :</label>
<textarea  name="projet" id="projet"   rows="10" cols="50" maxlength="100000000" ></textarea>
<br/>
<br/>
<label for="prelude_es"> Paragraphe prelude en espagnol :</label>
<textarea  name="prelude_es" id="prelude_es"   rows="10" cols="50" maxlength="100000000"></textarea>
<br/>
<br/>
<label for="accueil_es"> Paragraphe accueil en espagnol :</label>
<textarea  name="accueil_es" id="accueil_es"   rows="10" cols="50" maxlength="100000000"></textarea>
<br/>
<br/>
<label for="projet_es"> Paragraphe projet en espagnol :</label>
<textarea  name="projet_es" id="projet_es"   rows="10" cols="50" maxlength="100000000"  ></textarea>
<br/>
<br/>
<input type="submit" name="envoyer" value="Envoyer" />  
</form>

<?php
}
else{
     $prelude=$_POST['prelude'];
	 $accueil=$_POST['accueil'];
     $projet=$_POST['projet'];     
	 $prelude_es=$_POST['prelude_es'];
	 $accueil_es=$_POST['accueil_es'];
     $projet_es=$_POST['projet_es'];
	 include("connexion_bd.php");
	 $sql = "INSERT INTO paragraphe(PRELUDE_FR,PRELUDE_ES,ACCUEIL_FR,ACCUEIL_ES,PROJET_FR,PROJET_ES)
	 VALUES(:prelude,:accueil,:projet,:prelude_es,:accueil_es,:projet_es)";
	 $req=$myPDO->prepare($sql);
	 $req->setFetchMode(PDO::FETCH_ASSOC);
	 $req->execute(array('prelude' => $prelude, 'accueil' => $accueil,'projet' => $projet,'prelude_es' => $prelude_es, 'accueil_es' => $accueil_es,'projet_es' => $projet_es)) or die(print_r($myPDO->errorInfo()));
			if($req){
					$req->closeCursor();
					$myPDO=null;
					echo '<body onLoad="alert(\'Vos données ont bien été ajoutées. Vous allez être redirigé vers la page membre \')">'; 
					echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
					}
}
?>
</div>
</center>



								
