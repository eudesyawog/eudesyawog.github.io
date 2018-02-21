<script>
document.title ="Modifier un thème existant";
</script>
<?php
if (isset($_GET['ID_SUJET'])){
	include("connexion_bd.php");
	$query = $myPDO->prepare ("SELECT * FROM sujet where ID_SUJET= ?");
	$donnees = $query->execute(array($_GET['ID_SUJET']));
	$donnees = $query->fetch();	
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/modifier_theme">
<p>
<input type="hidden" name="ID_SUJET" id="ID_SUJET" value="<?php echo $donnees['ID_SUJET']?>"/>
<label for="libelle_fr"> * Votre theme/tag en français :(128 caractères maximum) </label> 
<input type="text" name="libelle_fr" id="libelle_fr" value="<?php echo $donnees['LIBELLE_FR']?>" size="30"  maxlength="128" required />
<p id="compteur"></p> 
<script  type="text/javascript">
var textarea = document.querySelector('#libelle_fr');
var blockCount = document.getElementById('compteur');

function count() {
    
    var count = 128-textarea.value.length;
    
    blockCount.innerHTML= count;
 
}

textarea.addEventListener('keyup', count);
count();
</script>
 <label for="libelle_es"> * Su tema / etiqueta en español: (128 caracteres como máximo)</label>
 <input type="libelle_es" name="libelle_es" id="libelle_es" value="<?php echo $donnees['LIBELLE_ES']?>" size="30" maxlength="128" required />
 <p id="compteur2"></p> 
<script type="text/javascript">
var textarea2 = document.querySelector('#libelle_es');
var blockCount2 = document.getElementById('compteur2');

function count() {
    
    var count = 128-textarea2.value.length;
    
    blockCount2.innerHTML= count;
 
}

textarea2.addEventListener('keyup', count);
count();
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#formulaire").validate( {
		rules: {
			libelle_fr:{
				required : true,
				maxlength: 128
			}, 
			libelle_es: {
				required: true,
				maxlength: 128 
			},
	
		},
		messages: {
			libelle_fr: {
				required: "Entrez votre nouveau thème en français",
				maxlength: "Votre thème ne pas exeder 128 caractères"
			},
			libelle_es: {
				required: "Ingrese su nuevo tema en Español",
				maxlength: "Su tema no exeder 128 caracteres"
			},
		}		 
	})
})
</script>
<p style="color:Tomato; font-family: verdana;">
Les champs avec une * sont obligatoires
</p>
<input type="submit" name="Modifier" value="Modifier theme"  />  
</p>
</center>
</form>
<?php
}
if (isset($_POST['Modifier'])){
	  $ID=$_POST ['ID_SUJET'];
	  $libelle_fr=$_POST['libelle_fr'];
	  $libelle_es=$_POST['libelle_es'];
	include("connexion_bd.php");
	  $sql="UPDATE sujet SET LIBELLE_FR=?, LIBELLE_ES=? WHERE ID_SUJET=?";
	  $requete=$myPDO->prepare ($sql);
	  $requete->execute(array($libelle_fr,$libelle_es,$ID)) or die(print_r($myPDO->errorInfo()));
	  
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