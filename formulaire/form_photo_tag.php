<script>
document.title =" Ajout de tags aux photos";
</script>
<?php
if (!isset($_POST['Titre']) && !isset ($_POST['Libelle_es'])){
?>
<center>
<div id="main">
<form id="formulaire" autocomplete="off" method="post" action="index.php?page=formulaire/form_photo_tag">
<label for="Titre">* Titre de la/les photo(s) : </label> 
<select name="Titre" id="Titre" required>
<option value="">--Selectionner une/des photos--</option>
<?php
include("connexion_bd.php");
$reponse = $myPDO->prepare("SELECT * FROM photo GROUP BY NOM_PHOTO");
$reponse->execute();
while ($donnees = $reponse->fetch())
{
?>
<option value="<?php echo $donnees['ID_PHOTO']; ?>"><?php echo $donnees['NOM_PHOTO']; ?></option>
<?php
}
$reponse->closeCursor(); 
?>
</select>
<br /> <br />
<label for="Libelle_es">* Seleccione los temas de la foto en español: </label> 
<select  name="Libelle_es[]" id="Libelle_es" multiple required>
<option disabled value="">--Selectionner d'abord une photo--</option>
</select>
<script>
$(function() {
$('#Titre').change(function() {
var id_photo = document.getElementById("Titre").value;
if (id_photo!=''){
	$.ajax({
		type:"POST",
		url:"querytag.php",
		data:{"id_photo":id_photo},
		dataType:'json',
		success: function (data){			
			$.each(data, function(id,libelle) {
				html = '';
				$.each(data, function(id,libelle) {
				html += '<option value='+libelle.id_sujet+'>'+libelle.libelle_es+'</option>'
			});
			document.getElementById("Libelle_es").innerHTML=html;
			});
		},
		error: function() {
              alert('La requête n\'a pas abouti'); }
	});
}
else {
	var selType=document.getElementById("Libelle_es");
	var selOpt=selType.options;
	for (i=selOpt.length-1;i>-1;i--)
		   {selOpt[i]=null};
	selOpt[0]= new Option("--Selectionner d\'abord une photo--","");
}
});
});

</script>
</select> </select><br /> <br />
<input type="submit" id="submit" name="submit" value="Ajouter"/>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#formulaire").validate( {
		rules: {
			Titre:{
				required : true
			}, 
			Libelle_es: {
				required: true
			},
		},
		messages: {
			Titre : {
				required: "Selectionner une photo"
			},
			Libelle_es: {
				required: "Seleccione los temas correspondientes a la foto"
			},
		}		 
	});
})
</script>
<?php
}
else {
	
	include("connexion_bd.php");
	
	 for ($i = 0; $i < count($_POST['Libelle_es']); $i++) 
	 {
		 $req = $myPDO-> prepare("INSERT INTO sujetphoto(ID_PHOTO, ID_SUJET) VALUES(:titre,:libelle)"); 
		 $req -> execute(array(
			              'titre' => $_POST['Titre'],
						  'libelle' => $_POST['Libelle_es'][$i]
						  )) or die(print_r($myPDO->errorInfo()));
	 }
	 $req = null;
	 $myPDO = null;
	 echo '<body onLoad="alert(\'Vos données ont bien été ajoutées. \')">';
	 echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
} 
?>
</div>
</center>
