<script>
document.title ="Modifier les tags d'une photo";
</script>
<?php
if (isset($_GET['idphoto']) AND isset($_GET['idsujet'])){ 
	include("connexion_bd.php");
	$query = $myPDO->prepare ("SELECT * from sujetphoto where ID_PHOTO= ? AND ID_SUJET= ?");
	$donnees = $query->execute (array ($_GET['idphoto'], $_GET['idsujet']));
	$donnees = $query->fetch();	
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/modifier_photo_tag" autocomplete="off">
<input type="hidden" name="id_sujet" value="<?php echo $donnees['ID_SUJET']?>"/>
<input type="hidden" name="id_photo" value="<?php echo $donnees['ID_PHOTO']?>"/>
<label for="Titre">* Titre de la/les photo(s) : </label> 
<select name="Titre" id="Titre"  required value="<?php echo $donnees['ID_PHOTO'];?>"/>
<?php
include("connexion_bd.php");
$reponse = $myPDO->prepare("SELECT * FROM photo GROUP BY NOM_PHOTO");
$reponse->execute();
while ($valeur = $reponse->fetch())
{
?>
<option value="<?php echo $valeur['ID_PHOTO']; ?>"><?php echo $valeur['TITRE']; ?></option>
<?php
}
 
$reponse->closeCursor(); 
 
?>
</select>
<br /> <br />
<label for="Libelle_es">* Seleccione los temas de la foto en español: </label> 
<select  name="Libelle_es" id="Libelle_es"  multiple required value="<?php echo $donnees['LIBELLE_ES'];?>">
<?php
include("connexion_bd.php");
$reponse = $myPDO->prepare("SELECT * FROM  sujet GROUP BY LIBELLE_ES");
$reponse->execute();
while ($valeur = $reponse->fetch())
{
	

?>
<option value="<?php echo $valeur['ID_SUJET']; ?>"><?php echo $valeur['LIBELLE_ES']; ?></option>
<?php
}
$reponse->closeCursor(); 
 
?>
<script type="text/javascript">
$(document).ready(function() {
$('#Libelle_es').multiselect({
nonSelectedText: 'Selectionner un/des tags'

});
});
</script>
</select> </select><br /> <br />
<input type="submit" id="submit" name="modifier" value="modifier"/>
</center>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#formulaire").validate( {
		rules: {
			Titre:{
				required : true
			}, 
			Libelle_es: {
				required: true,
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
	})
})
</script>
<?php
}
if (isset($_POST['modifier'])){
	 $ID=$_POST ['id_photo'];
	 $ID2=$_POST['id_sujet'];
     $Titre=$_POST['Titre'];
	 $libelle_es=$_POST['Libelle_es'];
	 include("connexion_bd.php");
	 $sql="UPDATE sujetphoto SET ID_PHOTO=?, ID_SUJET=? where ID_PHOTO=? AND ID_SUJET=?";
	 $req = $myPDO-> prepare ($sql);
	 $req->execute(array($Titre,$libelle_es,$ID,$ID2)) or die(print_r($myPDO->errorInfo()));
	 if($req) { 
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
