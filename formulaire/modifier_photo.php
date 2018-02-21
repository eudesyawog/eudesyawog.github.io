<script>
document.title ="Modifier une photo";
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsDh0zklXj3k97raQK-dxWniueU5AaKbM&callback=initMap"></script>
<style>
#map {
   height: 400px;
   width: 80%;
   margin :auto;
     }
</style>
<?php
if (isset($_GET['id_photo'])){
	include("connexion_bd.php");
	$query = $myPDO->prepare ("SELECT * FROM photo where ID_PHOTO= ?");
	$donnees = $query->execute(array($_GET['id_photo']));
	$donnees = $query->fetch();	
?>
<center>
<div id="main">
<form id="formulaire"  method="post" action="index.php?page=formulaire/modifier_photo" enctype="multipart/form-data"> 
<fieldset>
<center>
<legend style="text-align : center; color:Tomato; font-size: 24; "> Information sur la photo </legend> <br/>
<input type="hidden" name="ID_PHOTO" value="<?php echo $donnees['ID_PHOTO']?>"/>
<label for="NOM_PJ">* Qui est votre photographe :  </label> 
<select name="NOM_PJ" id="NOM_PJ" required >
<?php
include ('connexion_bd.php');
$reponse = $myPDO->query ("SELECT * FROM photojournaliste");
 
while ($valeur = $reponse->fetch())
{
	if ( $donnees['ID_PJ']==$valeur['ID_PJ']){
		echo '<option selected="selected" value="'.$valeur['ID_PJ'].'">'.$valeur['PRENOM_PJ'].' '.$valeur['NOM_PJ'].'</option>';
	}
	else {
		echo'<option value="'.$valeur['ID_PJ'].'">'.$valeur['PRENOM_PJ'].' '.$valeur['NOM_PJ'].'</option>';
	}

}
$reponse->closeCursor(); 
?>
</select>
<br/>
<label for="photo">  Fichier (JPG, PNG, JPEG / max. 8 Mo) :</label><br />
<input type="hidden" name="MAX_FILE_SIZE" value="8388608" />
<input type="file" name="photo" id="photo" /><br /><br/>

<label for="titre">* Titre de la photographie : </label>  <br>
<input type="text" name="titre" id="titre" required value="<?php echo $donnees['TITRE']?>"/> <br>
 </center>
 </fieldset> <br /><br />
 <fieldset>
 <center>
 <legend style="text-align : center; color:Tomato; font-size: 24; " > Géolocalisation de la photographie </legend> 
 <p style="color:Tomato; font-family: verdana; font-size: 12;">
Utiliser le bouton géolocaliser pour chercher les informations
</p>
* Adresse en français :  <input type="text" name="adresse_fr" id="adresse_fr" placeholder="Ex : Rue Ponciano Arriaga. A l’angle de la Plaza de la Republica" maxlength="128" required value="<?php echo $donnees['ADRESSE_FR']?>" />
<p id="compteur"></p> 
<script type="text/javascript">
var textarea = document.querySelector('#adresse_fr');
var blockCount = document.getElementById('compteur');

function count() {
    
    var count = 128-textarea.value.length;
    
    blockCount.innerHTML= count;
 
}

textarea.addEventListener('keyup', count);
count();
</script>
* Adresse en espagnol : <input type="text" name="adresse_es" id="adresse_es" placeholder="Ex : Calle Ponciano Arriaga. En la esquina de Plaza de la República" maxlength="128" required value="<?php echo $donnees['ADRESSE_ES']?>" />
<p id="compteur2"></p> 
<script type="text/javascript">
var textarea2 = document.querySelector('#adresse_es');
var blockCount2 = document.getElementById('compteur2');

function count() {
    
    var count = 128-textarea2.value.length;
    
    blockCount2.innerHTML= count;
 
}

textarea2.addEventListener('keyup', count);
count();
</script>
<br />
<br />
* Longitude : <input type="number_format" name="longitude" id="longitude"  size="15" required value="<?php echo $donnees['LONGITUDE']?>"/>
* Latitude : <input type="number_format" name="latitude" id="latitude" size="15" required value="<?php echo $donnees['LATITUDE']?>"/> <br/> <br/>
<div id="map"></div>
<script type="text/javascript">
function initMap() {
var myOptions = {
	zoom: 12,
	center: new google.maps.LatLng(19.4284700, -99.1276600),
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

map = new google.maps.Map(document.getElementById("map"), myOptions);    

/*var geocoder = new google.maps.Geocoder();
var adresse_fr, latitude, longitude;

	var infoWindow = new google.maps.InfoWindow;
function geolocalise(){
adresse_fr = document.getElementById('adresse_fr').value;
geocoder.geocode( { 'adresse_fr': adresse_fr}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
longitude = results[0].geometry.location.lng();
latitude = results[0].geometry.location.lat();
document.getElementById('longitude').value = longitude;
document.getElementById('latitude').value = latitude;
};
});
}*/
}
</script>

<label for="streetview"> Lien streetview de la photo :</label><br>
<input type="url" name="streetview" id="streetview" placeholder="Ex :https://www.google.com/maps/@19.3943,-99.1461436,3..." value="<?php echo $donnees['STREET_VIEW']?>">
<br /><br />
<input type="button" onclick="geolocalise()" value="géolocaliser" />
</center>
</fieldset> <br /><br />
<fieldset>
<center>
<legend style="text-align : center; color:Tomato; font-size: 24; "> Description de la photo : </legend> <br /><br />
 <label for="DESCRIPTION_FR">* Description de la photo en français : </label>
 <textarea type="text" name="DESCRIPTION_FR" id="DESCRIPTION_FR"   rows="10" cols="50"  required value="<?php echo $donnees['DESCRIPTION_FR']?>"></textarea> 
 <br />
 <br />
 <label for="DESCRIPTION_ES">* Descripción de la foto en español :</label>
 <textarea type="text" name="DESCRIPTION_ES" id="DESCRIPTION_ES"   rows="10" cols="50" required value="<?php echo $donnees['DESCRIPTION_ES']?>"></textarea>
</center>
</fieldset><br/> <br/>
<fieldset> 
<center>
<legend style="text-align : center; color:Tomato; font-size: 24; "> Autre information sur la photo : </legend>
 <p> * Precision de la localisation ? 
<input type="radio" name="precision_loc" value="1" id="precision_loc" required > Exacte
<input type="radio" name="precision_loc" value="0" id="precision_loc"> Approximative 

</p>
<label for="ordre"> Ordre de prise de vue :</label>
<input type="number" name="ordre" id="ordre" min="1" value="<?php echo $donnees['ORDRE']?>">
<br /><br />
<label for="date_photo"> Date de la photo : </label>
<input type="text" name="date_photo" id="date_photo" value="<?php echo $donnees['DATE_PHOTO']?>">
<script>
$( function() {
    $( "#date_photo" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
</script>
<br />
<label for="angle"> Angle de la photo :</label>
<input type="number" name="angle" id="angle" min="0" max="360" value="<?php echo $donnees['ANGLE_VUE']?>">
</center>
</fieldset>
<CENTER>
<p style="color:Tomato; font-family: verdana;">
Les champs avec une * sont obligatoires
</p>
<input type="submit" name="modifier" value="Modifier photo" />   
</p>
</center>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#formulaire").validate( {
		rules: {
			NOM_PJ : "required",
			repertoire : {
				required: true,
				maxlength: 200
			},
			photo : {
				maxlength: 8388608 
			},
			titre : {
				required: true,
				maxlength: 128
			},
			adresse_fr : {
				required: true,
				maxlength: 128
			},
			adresse_es : {
				required: true,
				maxlength: 128
			},
			longitude : {
				required: true,
				number: true,
				maxlength: 15
			},
			latitude : {
				required: true,
				number: true,
				maxlength: 15
			},
			DESCRIPTION_FR: "required",
			DESCRIPTION_ES: "required",
			precition_loc: "required",
			ordre : {
				number: true,
				minlength: 1
			},
			date_photo : {
				date: true
			},
			streetview : {
				url: true
			},
			angle : {
				number: true,
				minlength: 0,
				maxlength: 360
			},
		},
		messages : {
			NOM_PJ : {
				required : "Selectionnez le photographe dans la liste déroulante"
			},
			photo: {
				required : "Vous devez indiquer le répertoire des photos",
				maxlength : "La photo ne peut pas faire plus de 8 Mo"
			},
			titre : {
				required : "Indiquez le titre de la photo ",
				maxlength : "Le titre ne doit pas dépasser 128 caractères"
			},
			adresse_fr : {
				required : "Indiquez l'adresse de la photo",
				maxlength : "L'adresse ne doit pas dépasser 128 caractères"
			},
			adresse_es : {
				required : "Ingrese la dirección de la foto",
				maxlength : "La dirección no debe exceder los 128 caracteres"
			},
			longitude : {
				required: "Indiquez la longitude de la photo",
				number: "La longitude doit être de type numérique",
				maxlength: "15 chiffres au total et 7 chiffres maximum après la virgule"
			},
			latitude: {
				required: "Indiquez la latitude de la photo",
				number: "La latitude doit être de type numérique",
				maxlength: "15 chiffres au total et 7 chiffres maximum après la virgule"
			},
			DESCRIPTION_FR: {
				required: "Decrivez la photo en français"
			},
			DESCRIPTION_ES: {
				required: "Describe la imagen en español"
			},
			precition_loc: {
				required: "Indiquer si la précision est exacte ou approximative"
			},
			ordre: {
				number: "L'ordre des photos doit être de type numérique",
				minlength: "La valeur doit être au minimum égal à 1"
			},
			date_photo :{
				date: "La date de la photo doit être au format date"
			},
			streetview :{
				url : "Le lien doit avoir une url valide"
			},
			angle :{
				number: "La valeur doit être de type numérique",
				minlength: "La valeur doit être au minimum égal à 0",
				maxlength: "La valeur doit être au maximum égal à 360",
			},
		}
	})
})
</script>
<?php
}
else {
        $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
		$ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg'); 
	if (isset($_POST['modifier'])){	
		$ID_PHOTO = $_POST['ID_PHOTO'];
		$id_pj = $_POST['NOM_PJ'];
		$adresse_fr = $_POST['adresse_fr'];
		$adresse_es = $_POST['adresse_es'];
		$longitude = $_POST['longitude'];
		$latitude = $_POST['latitude'];
		$description_fr = $_POST['DESCRIPTION_FR'];
		$description_es = $_POST['DESCRIPTION_ES'];
		$precision_loc = $_POST['precision_loc'];
		$ordre = $_POST['ordre'];
		$date = $_POST['date_photo'];
		$streetview = $_POST['streetview'];
		$angle = $_POST['angle'];
		$date_photo = $_POST['date_photo'];
		$titre=$_POST['titre'];
		$repertoire="photos";
		 
		if (!empty($_POST['NOM_PJ']) && (!empty($_FILES['photo'])) && (!empty($_POST['adresse_fr'])))
        {		
				if ($_FILES['photo']['error'] <= 0)
                {
					if ($_FILES['photo']['size'] <= 8388608)
					{							
						$photoname = $_FILES['photo']['name'];
						$Extensionpresumee = explode('.', $photoname);
						$ExtensionPresumee = strtolower($Extensionpresumee[count($Extensionpresumee)-1]);
						if ($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg')
						{	
							$photo= getimagesize($_FILES['photo']['tmp_name']);
							if($photo['mime'] == $ListeExtension[$ExtensionPresumee]  || $photo['mime'] == $ListeExtensionIE[$ExtensionPresumee])
							{
								$ImageChoisie = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
								$TailleImageChoisie = getimagesize($_FILES['photo']['tmp_name']);
								
								//Enregistrer l'image en pleine résolution
								imagejpeg($ImageChoisie,'photos/'.$photoname,100);
								
								//Miniature de 200px
								$NouvelleLargeur = 200;
								$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
							    imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
							    $NomFichier='';
								for ($i = 0; $i < count($Extensionpresumee)-1; $i++) 
								{
									$NomFichier.=$Extensionpresumee[$i] ;
								}
								$NomImageExploitable = $NomFichier.'_200';
                                imagejpeg($NouvelleImage ,'photos/thumb_200/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
								
								//Miniature de 400px
								$NouvelleLargeur = 400;
								$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
							    imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								$NomFichier='';
								for ($i = 0; $i < count($Extensionpresumee)-1; $i++) 
								{
									$NomFichier.=$Extensionpresumee[$i] ;
								}
								$NomImageExploitable = $NomFichier.'_400';
                                imagejpeg($NouvelleImage ,'photos/thumb_400/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
								
								include ('connexion_bd.php');
								$sql="UPDATE photo SET ID_PJ = ?,NOM_PHOTO 	= ?,TITRE = ?, LONGITUDE = ?,LATITUDE = ?,DESCRIPTION_FR = ?,DESCRIPTION_ES = ?, ADRESSE_FR = ?, ADRESSE_ES = ?,PRECISIONLOC = ?,ORDRE = ?,DATE_PHOTO = ?,STREET_VIEW = ?, ANGLE_VUE =? WHERE ID_PHOTO=?";
									  
								$requete=$myPDO->prepare($sql);
								$requete->setFetchMode(PDO::FETCH_ASSOC);
								$requete->execute(array($id_pj, $repertoire, $titre, $longitude, $latitude, $description_fr, $description_es,$adresse_fr, $adresse_es, $precision_loc, $ordre, $date,$streetview,$angle,$ID_PHOTO)) or die(print_r($myPDO->errorInfo()));

								if($requete)
								{
									$requete->closeCursor();
									$myPDO=null;
									echo '<body onLoad="alert(\'Vos données ont bien été modifiées. Vous allez être redirigé vers la page membre \')">'; 
									echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
								}
							}
							
							else
							{
								echo 'Le type MIME de l\'image n\'est pas bon';
							}
						}
							
						else if ($ExtensionPresumee == 'png')
						{
							$photo= getimagesize($_FILES['photo']['tmp_name']);
							if($photo['mime'] == $ListeExtension[$ExtensionPresumee]  || $photo['mime'] == $ListeExtensionIE[$ExtensionPresumee])
							{
								$ImageChoisie = imagecreatefrompng($_FILES['photo']['tmp_name']);
								$TailleImageChoisie = getimagesize($_FILES['photo']['tmp_name']);
								
								//Enregistrer l'image en pleine résolution
								imagepng($ImageChoisie,'photos/'.$photoname,100);
								
								//Miniature de 200px
								$NouvelleLargeur = 200;
								$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
							    imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
							    $NomFichier='';
								for ($i = 0; $i < count($Extensionpresumee)-1; $i++) 
								{
									$NomFichier.=$Extensionpresumee[$i] ;
								}
								$NomImageExploitable = $NomFichier.'_200';
                                imagepng($NouvelleImage ,'photos/thumb_200/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);
								
								//Miniature de 400px
								$NouvelleLargeur = 400;
								$NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
							    imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								$NomFichier='';
								for ($i = 0; $i < count($Extensionpresumee)-1; $i++) 
								{
									$NomFichier.=$Extensionpresumee[$i] ;
								}
								$NomImageExploitable = $NomFichier.'_400';
                                imagepng($NouvelleImage ,'photos/thumb_400/'.$NomImageExploitable.'.'.$ExtensionPresumee, 100);

								include ('connexion_bd.php');
								$sql="UPDATE photo SET ID_PJ = ?,TITRE = ?, LONGITUDE = ?,LATITUDE = ?,DESCRIPTION_FR = ?,DESCRIPTION_ES = ?, ADRESSE_FR = ?, ADRESSE_ES = ?,PRECISIONLOC = ?,ORDRE = ?,DATE_PHOTO = ?,STREET_VIEW = ?, ANGLE_VUE =? WHERE ID_PHOTO=?";
									  
								$requete=$myPDO->prepare($sql);
								$requete->execute(array($id_pj, $titre, $longitude, $latitude, $description_fr, $description_es,$adresse_fr,$adresse_es, $precision_loc, $ordre, $date,$streetview,$angle,$ID_PHOTO)) or die(print_r($myPDO->errorInfo()));

								if($requete)
								{
									$requete->closeCursor();
									$myPDO=null;
									echo '<body onLoad="alert(\'Vos données ont bien été modifiées. Vous allez être redirigé vers la page membre \')">'; 
									echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
								}
							}
							
							else
							{
								echo 'Le type MIME de l\'image n\'est pas bon';
							}	
						}
									
						else
                        {
                            echo 'L\'extension choisie pour l\'image n\'est pas supportée';
                        }
						
                    }
                    else
                    {
                        echo 'L\'image est trop lourde';
                    }
                }
                else
                {
                    echo 'Erreur lors de l\'upload image';
                }
        }
        else
        {
            echo 'Au moins un des champs est vide';
        }		
	}
}
?>
</div>
</center>