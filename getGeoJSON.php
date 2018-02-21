<?php

include('connexion_bd.php');

if (isset($_GET['lang']))
{
	if ($_GET['lang']=='fr')
	{
		$query = $myPDO->query("SET lc_time_names = 'fr_FR';");
		$sql="SELECT repertoire, nom_photo, titre, longitude as lon, latitude as lat, description_fr as description, adresse_fr as adresse, precisionloc, DATE_FORMAT(date_photo, '%e %M %Y') as datejour,street_view, 
			  CAST(ordre AS UNSIGNED) as ordre_int, angle_vue, CONCAT(prenom_pj,' ',nom_pj) as nomprenom
			  FROM photo as ph, photojournaliste as pj
			  WHERE ph.id_pj=pj.id_pj
              ORDER BY id_photo";
	}
	else if ($_GET['lang']=='es')
	{
		$query = $myPDO->query("SET lc_time_names = 'es_MX';");
		$sql="SELECT repertoire, nom_photo, titre, longitude as lon, latitude as lat, description_es as description, adresse_es as adresse, precisionloc, DATE_FORMAT(date_photo, '%e %M %Y') as datejour,street_view, 
			  CAST(ordre AS UNSIGNED) as ordre_int, angle_vue, CONCAT(prenom_pj,' ',nom_pj) as nomprenom
			  FROM photo as ph, photojournaliste as pj
			  WHERE ph.id_pj=pj.id_pj
              ORDER BY id_photo";
	}


$requete=$myPDO-> prepare($sql);
$requete->setFetchMode(PDO::FETCH_ASSOC);
$requete->execute();

//Génération de la chaîne GeoJSON
$str = 'var photos =';
	$str .= '{
	"type": "FeatureCollection",
	"features": [';
	$i = 1;
	while ($resultat = $requete->fetch()) {
		$str .= '{
			"geometry":{"type":"Point","coordinates":['.$resultat['lon'].','.$resultat['lat'].']},
			"id_feature": '.$i++.',
			"type": "Feature",'.
			'"properties": {
			"repertoire": "'.$resultat['repertoire'].'",
			"nom_photo": "'.$resultat['nom_photo'].'",
			"titre": "'.$resultat['titre'].'",
			"description": "'.$resultat['description'].'",
			"adresse": "'.$resultat['adresse'].'",
			"precisionloc": "'.$resultat['precisionloc'].'",
			"date_photo": "'.$resultat['datejour'].'",
			"street_view": "'.$resultat['street_view'].'",
			"ordre": "'.$resultat['ordre_int'].'",
			"angle_vue": "'.$resultat['angle_vue'].'",
			"photojournaliste": "'.$resultat['nomprenom'].'"
			}
		},';
	}
$str2 = substr($str,0,strlen($str)-1);
$str2 .= ']}';

$requete = null;
$myPDO = null;

echo $str2;

}
?>