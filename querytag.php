<?php

if (isset($_POST['id_photo'])){
	include('connexion_bd.php');

	$sql="SELECT s.id_sujet, s.libelle_es 
	FROM sujet as s
	WHERE s.id_sujet NOT IN(SELECT sp.id_sujet FROM sujetphoto as sp WHERE id_photo = ?)";

	$requete=$myPDO-> prepare($sql);
	$requete->setFetchMode(PDO::FETCH_ASSOC);
	$requete->execute(array($_POST["id_photo"]));

	//Génération de la chaîne JSON
	$json=array();
	while ($resultat = $requete->fetch()) {
		$json[] = $resultat;
		}
	echo json_encode($json);

	$requete = null;
	$myPDO = null;
}
?>