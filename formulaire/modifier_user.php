<script>
document.title ="Modifier les actions d'un utilisateur";
</script>
<?php
if (isset($_GET['ID_USER'])){
	include("connexion_bd.php");
	$query = $myPDO->prepare ("SELECT * FROM utilisateur where ID_USER= ?");
	$donnees = $query->execute(array($_GET['ID_USER']));
	$donnees = $query->fetch();	
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/modifier_user" autocomplete="off">
<p>
<input type="hidden" name="ID_USER" id="ID_USER" value="<?php echo $donnees['ID_USER']?>"/>
<label for="pseudo"> * Pseudo de l'utilisateur : </label> 
<input type="text" name="pseudo" id="pseudo" value="<?php echo $donnees['PSEUDO'];?>" size="30" required />
<br/>
 <br />
 <label for="MDP"> * Mot de passe de l'utilisateur :</label>
 <input type="password" name="MDP" id="MDP" value="<?php echo $donnees ['MDP'];?>" size="30"  required />
 <br/>
 <br/>
 <label for="Confirmer_mdp"> * Confirmer votre mot de passe :</label>
 <input type="password" name="Confirmer_mdp" id="Confirmer_mdp" value="<?php echo $donnees['MDP'];?>" size="30"  required />
 <br/>
 <br/>
 <label for="EMAIL"> * Email de l'utilisateur :</label>
 <input type="email" name="EMAIL" id="EMAIL" value="<?php echo $donnees ['EMAIL_USER']?>" size="30" required  />
 <br/>
 <br/>
 <label for="confirmer_email"> * Confirmer votre email :</label>
 <input type="email" name="confirmer_email" id="confirmer_email" value="<?php echo $donnees ['EMAIL_USER']?>" size="30" required  />
 <br/>
 <br/>
 <p style="color:Tomato; font-family: verdana; font-size : 12;">
Les champs avec une * sont obligatoires
</p>
<input type="submit" name="modifier" value="Modifier" />  
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#formulaire").validate( {
		rules: {
			pseudo:{
				required : true,
				minlength: 2
			},
			MDP: {
				required: true,
				minlength: 5
			},
			Confirmer_mdp: {
				required: true,
				minlength: 5,
				equalTo: "#MDP"
			},
			EMAIL : {
				required : true,
				email : true
			},
			confirmer_email : {
				required : true,
				email : true,
				equalTo : "#EMAIL"
			},
		},
		messages: {
			pseudo: {
				required: "Entrez votre pseudo",
				minlength: "Votre pseudo doit faire au moins 2 caractères"
			},
			MDP: {
				required: "Entrez votre mot de passe",
				minlength: "Votre mot de passe doit faire au moins 5 caractères"
			},
			Confirmer_mdp: {
				required: "Entrez de nouveau votre mot de passe",
				minlength: "Votre mot de passe doit faire au moins 5 caractères",
				equalTo: "Entrez le même mot de passe que précedemment"
			},
			EMAIL: {
				required: "Entrez votre adresse mail",
				email: "Entrez une adresse mail correcte"
			},
			confirmer_email : {
				required: "Entrez de nouveau votre mail",
				email : "Entrez une adresse mail correcte",
				equalTo: "Entrez la même email que précedemment"
			},
		}		 
	})
})
</script>
<?php
}

if (isset($_POST['modifier'])){
	  
	  $ID=$_POST ['ID_USER'];
      $pseudo=$_POST['pseudo'];
      $mdp=password_hash($_POST['MDP'],PASSWORD_DEFAULT);
	  $email=$_POST['EMAIL'];
	  include("connexion_bd.php");
	  $sql="UPDATE utilisateur SET PSEUDO=?, MDP=?,EMAIL_USER= ? WHERE ID_USER=?";
	  $requete=$myPDO->prepare ($sql);
	  $requete->execute(array($pseudo,$mdp,$email,$ID)) or die(print_r($myPDO->errorInfo()));
	  
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