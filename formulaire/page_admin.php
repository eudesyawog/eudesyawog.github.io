<?php
if(isset($_SESSION['PSEUDO']) && !empty($_SESSION['PSEUDO'])){
{
	echo "Vous êtes connecté(e) sous l'identifiant <br/> Vous avez maintenant accès aux formulaires d'administration " ;

}	
?>
<script>
document.title ="Espace Administrateur";
</script>
<center>
<div id="main">
<body>
<p>Vous êtes connecté(e) sous l'identifiant <strong><?php echo $_SESSION['PSEUDO']; ?></strong> <br/> Vous avez maintenant accès aux formulaires d'administration</p>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/formulaire_user">Ajouter des utilisateurs</a>
  </li>
   <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/action_user">Modifier/Supprimer des utilisateurs</a>
  </li>
  <br/>
  <br/>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/formulaire_photographe">Ajouter des photographes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/action_photographe">Modifier/Supprimer des photographes</a>
  </li>
  <br/>
  <br/>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/formulaire_photo"> Ajouter des photos sur la carte et dans la galerie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/action_photo"> Modifier/Supprimer des photos</a>
  </li>
  <br/>
  <br/>
   <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/formulaire_theme"> Ajouter des thèmes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/action_theme"> Modifier/Supprimer des thèmes</a>
  </li>
  <br/>
  <br/>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/form_photo_tag"> Ajouter des tags à des photos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/action_photo_tag"> Modifier/Supprimer des tags sur les photos</a>
  </li>
  <br/>
  <br/>
 <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/formulaire_paragraphe"> Ajouter des zones de texte</a>
  </li>
   <li class="nav-item">
    <a class="nav-link active" href="?page=formulaire/action_paragraphe"> Modifier/Supprimer des zones de texte</a>
  </li>
</ul>
</div>
</center>
<?php
}
	else {
		echo '<body onLoad="alert(Vous devez être connecté pour acceder à cette page.)">'; 
 
		echo '<meta http-equiv="refresh" content="0;URL=?page=connexion_prive">';
	}
?>


