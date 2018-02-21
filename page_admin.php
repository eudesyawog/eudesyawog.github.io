<?php
if(isset($_SESSION['PSEUDO']) && !empty($_SESSION['PSEUDO'])){
?>
<script>
document.title ="Espace Administrateur";
</script>
<center>
<div id="main">
<p class="container2">Vous êtes connecté(e) sous l'indentifiant <strong><?php echo $_SESSION['PSEUDO']; ?></strong> <br/> Vous avez maintenant accès aux formulaires d'administration</p>
<div class = "container"> 
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


