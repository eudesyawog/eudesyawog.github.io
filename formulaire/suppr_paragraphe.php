<?php
if(isset($_GET['id']))
{
	include_once 'connexion_bd.php';
	$id = $_GET['id'];
	
	$delete = $myPDO->query("DELETE FROM paragraphe where ID_PRG=$id");
	if($delete)
	{
		echo '<body onLoad="alert(\'Vos données ont bien été supprimé. Vous allez être redirigé vers la page membre \')">'; 
 
		echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
 
	}
	else
	{
		echo "Nous ne sommes pas parvenus à supprimer le theme";
	}
}
?>
