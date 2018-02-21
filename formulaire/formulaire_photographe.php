<script>
document.title ="Ajouter un nouveau photojournaliste";
</script>
<?php
if (!isset($_POST['NOM_PJ']) && !isset($_POST['PRENOM_PJ'])){
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/formulaire_photographe"> 
<label  for="NOM_PJ">* Nom du photographe : </label> 
<input type="text" name="NOM_PJ" id="NOM_PJ" placeholder="Ex : Capa" size="30"  maxlength="128" required />
<br/>
 <br />
 <label for="PRENOM_PJ">* Prenom du photographe :</label>
 <input type="text" name="PRENOM_PJ" id="PRENOM_PJ" placeholder="Ex : Robert" size="30" maxlength="128" required />
 <br/>
  <br/>
  <label for="DESCRIPTION_PJ">* Description de l'auteur en français :</label>
 <textarea type="text" name="DESCRIPTION_PJ" id="DESCRIPTION_PJ"   rows="10" cols="50" maxlength="100000000" required ></textarea> 
 <br />
 <br />
 <label for="DESCRIPTION_PJ_ES">* Descripción del autor en español :</label>
 <textarea type="text" name="DESCRIPTION_PJ_ES" id="DESCRIPTION_PJ_ES"   rows="10" cols="50" maxlength="100000000" required></textarea> 
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
<input type="submit" name="envoyer" value="Envoyer" />  
 
</p>
</form>
 <?php
 }
else{

     $nom=$_POST['NOM_PJ'];
	 $prenom=$_POST['PRENOM_PJ'];
     $description=$_POST['DESCRIPTION_PJ'];
     $description_es=$_POST['DESCRIPTION_PJ_ES'];
	 include("connexion_bd.php");
	 $req = $myPDO-> prepare ("INSERT INTO photojournaliste(NOM_PJ,PRENOM_PJ,DESCRIPTION_PJ_FR,DESCRIPTION_PJ_ES)
	 VALUES('$nom','$prenom','$description','$description_es')"); 
	 $req->execute();
 
echo '<body onLoad="alert(\'Vos données ont bien été ajoutées. Vous allez être redirigé vers la page membre \')">'; 
 
echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
}
?>
</div>
</center>


