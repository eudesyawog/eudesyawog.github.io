<?php
if(isset($_GET['idsujet']) AND isset($_GET['idphoto'])) 
{
	include("connexion_bd.php");
	$id_sujet = $_GET['idsujet'];
	$id_photo = $_GET['idphoto'];
	$sql ="DELETE FROM sujetphoto where ID_SUJET = ? AND ID_PHOTO= ?";
	$delete= $myPDO->prepare ($sql);
	$delete->execute(array($id_sujet,$id_photo)) or die(print_r($myPDO->errorInfo()));
	if($delete)
	{
		echo '<body onLoad="alert(\'Vos données ont bien été supprimé. Vous allez être redirigé vers la page membre \')">'; 
 
		echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
 
	}
	else
	{
		echo "Nous ne sommes pas parvenus à supprimer le tag sur la photo";
	}
}
?>
