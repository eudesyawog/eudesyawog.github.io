<?php
include('connexion_bd.php');

if (isset($_POST['PSEUDO']) && isset($_POST['MDP'])) {
    $PSEUDO = $_POST['PSEUDO'];
    $MDP = $_POST['MDP'];
	
	$sql = "SELECT PSEUDO,MDP FROM utilisateur WHERE PSEUDO='".$PSEUDO."'";
	$res = $myPDO->query($sql);
	
        if($res->rowCount() > 0) // if found a result
            {
				$row = $res->fetch(PDO::FETCH_ASSOC);
				
				if (password_verify($MDP,$row['MDP'])) 
				{
					session_start ();
          
					$_SESSION['PSEUDO'] = $_POST['PSEUDO'];

					// on redirige notre visiteur vers une page de notre section membre
					
					echo '<meta http-equiv="refresh" content="0;URL=index.php?page=page_admin">';
					
				}
                
				else    
				{
                
					echo '<body onLoad="alert(\'Membre non reconnu\')">';
                
					echo '<meta http-equiv="refresh" content="0;URL=index.php?page=connexion_prive">';
                }
            }
		else    
				{
                
					echo '<body onLoad="alert(\'Membre non reconnu\')">';
                
					echo '<meta http-equiv="refresh" content="0;URL=index.php?page=connexion_prive">';
                }
            
}
?>