<?php

include('connexion_bd.php');

$sql="SELECT DISTINCT pj.id_pj as id, CONCAT(prenom_pj,' ',nom_pj) as photojournaliste
FROM photo as ph, photojournaliste as pj
WHERE ph.id_pj=pj.id_pj";

$requete=$myPDO-> prepare($sql);
$requete->setFetchMode(PDO::FETCH_ASSOC);
$requete->execute();

//Génération de la chaîne JSON
$json=array();
while ($resultat = $requete->fetch()) {
	$json[] = $resultat;
	}
echo json_encode($json);

$requete = null;
$myPDO = null;

?>