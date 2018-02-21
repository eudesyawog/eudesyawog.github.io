<script>
document.title ="Modifier un photojournaliste";
</script>
<?php
if (isset($_GET['ID_PJ'])){
	include("connexion_bd.php");
	$query = $myPDO->prepare ("SELECT * FROM photojournaliste where ID_PJ= ?");
	$donnees = $query->execute(array($_GET['ID_PJ']));
	$donnees = $query->fetch();	
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/modifier_photographe" > 
<input type="hidden" name="ID_PJ" value="<?php echo $donnees['ID_PJ']?>"/>
<label  for="NOM_PJ">* Nom du photographe : </label> 
<input type="text" name="NOM_PJ" id="NOM_PJ" value="<?php echo $donnees['NOM_PJ'];?>"  maxlength="128" required />
<br/>
 <br />
 <label for="PRENOM_PJ">* Prenom du photographe :</label>
 <input type="text" name="PRENOM_PJ" id="PRENOM_PJ" value="<?php echo $donnees['PRENOM_PJ'];?>" size="30" maxlength="128" required />
 <br/>
  <br/>
  <label for="DESCRIPTION_PJ">* Description de l'auteur en français :</label>
 <textarea type="text" name="DESCRIPTION_PJ" id="DESCRIPTION_PJ"   rows="10" cols="50" maxlength="100000000" required value=" <?php echo $donnees['DESCRIPTION_PJ_FR'];?>"></textarea>
 <br />
 <br />
 <label for="DESCRIPTION_PJ_ES">* Descripción del autor en español :</label>
 <textarea type="text" name="DESCRIPTION_PJ_ES" id="DESCRIPTION_PJ_ES"  rows="10" cols="50" maxlength="100000000" required value="<?php echo $donnees["DESCRIPTION_PJ_ES"];?>"></textarea>
<script type="text/javascript">
$(document).ready(function(){
	$("#formulaire").validate( {
		rules: {
			NOM_PJ:{
				required : true,
				maxlength: 128
			}, 
			PRENOM_PJ: {
				required: true,
				maxlength: 128 
			},
			DESCRIPTION_PJ: {
				required: true
			},
			DESCRIPTION_PJ_ES: {
				required: true
			},
		},
		messages: {
			NOM_PJ: {
				required: "Entrez le nom du photographe/Ingrese el apellido del fotógrafo",
				maxlength: "Le nom du photographe ne peut pas excéder 128 caractères"
			},
			PRENOM_PJ: {
				required: "Entrez le prénom du photographe/Ingrese el nombre del fotógrafo",
				maxlength: "Le prénom du photographe ne peut pas excéder 128 caractères"
			},    
			DESCRIPTION_PJ : {
				required : "Entrez la description du photographe en français"
			},
			DESCRIPTION_PJ_ES: {
				required : "Ingrese la descripción del fotógrafo en español"	
			},			
		},		 
	})
})
</script>
<p style="color:Tomato; font-family: verdana;">
Les champs avec une * sont obligatoires
</p>
<br />
<br />
<input type="submit" name="modifier" value="Envoyer" />  
 
</p>
</form>
<?php
 }
if (isset($_POST['modifier'])){
	  $ID=$_POST ['ID_PJ'];
      $nom=$_POST['NOM_PJ'];
      $prenom=$_POST['PRENOM_PJ'];
	  $description_fr=$_POST['DESCRIPTION_PJ'];
	  $description_es=$_POST['DESCRIPTION_PJ_ES'];
	  include("connexion_bd.php");
	  $sql="UPDATE photojournaliste SET NOM_PJ=?, PRENOM_PJ=?,DESCRIPTION_PJ_FR= ?, DESCRIPTION_PJ_ES= ?  WHERE ID_PJ=?";
	  $requete=$myPDO->prepare ($sql);
	  $requete->execute(array($nom,$prenom,$description_fr,$description_es,$ID)) or die(print_r($myPDO->errorInfo()));
	  
		if($requete) {
			echo '<body onLoad="alert(\'Vos données ont bien été modifiées. Vous allez être redirigé vers la page membre \')">'; 
 
			echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
		}
		else {
			echo "<h1 align='center' color='green'>ECHEC DE MODIFICATION<h1>";
		}
	}	
?>
</div>
</center>


 