<script>
document.title ="Ajouter un nouvel utilisateur";
</script>
<?php
if (!isset($_POST['pseudo']) && !isset($_POST['MDP'])){
?>
<center>
<div id="main">
<form id="formulaire" method="post" action="index.php?page=formulaire/formulaire_user" autocomplete="off">
<p>
<label for="pseudo"> * Pseudo de l'utilisateur : </label> 
<input type="text" name="pseudo" id="pseudo" placeholder="Ex : RobertCapa" size="30" required />
<br/>
 <br />
 <label for="MDP"> * Mot de passe de l'utilisateur :</label>
 <input type="password" name="MDP" id="MDP" size="30"  required />
 <br/>
 <br/>
 <label for="Confirmer_mdp"> * Confirmer votre mot de passe :</label>
 <input type="password" name="Confirmer_mdp" id="Confirmer_mdp" size="30"  required />
 <br/>
 <br/>
 <label for="EMAIL"> * Email de l'utilisateur :</label>
 <input type="email" name="EMAIL" id="EMAIL" size="30" required  />
 <br/>
 <br/>
 <label for="confirmer_email"> * Confirmer votre email :</label>
 <input type="email" name="confirmer_email" id="confirmer_email" size="30" required  />
 <br/>
 <br/>
 <p style="color:Tomato; font-family: verdana; font-size : 12;">
Les champs avec une * sont obligatoires
</p>
<input type="submit" name="envoyer" value="Envoyer" />  
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
else {
      $pseudo=$_POST['pseudo'];
      $mdp=password_hash($_POST['MDP'],PASSWORD_DEFAULT);
	  $email=$_POST['EMAIL'];
	  include("connexion_bd.php");
	  $req = $myPDO-> prepare("INSERT INTO utilisateur(PSEUDO,MDP,EMAIL_USER)VALUES('$pseudo','$mdp','$email')");
	  $req->execute();

echo '<body onLoad="alert(\'Vos données ont bien été ajoutées. Vous allez être redirigé vers la page membre \')">'; 
 
echo '<meta http-equiv="refresh" content="0;URL=?page=page_admin">';
}
?>
</div>
</center>