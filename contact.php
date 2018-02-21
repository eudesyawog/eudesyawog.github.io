<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title> Page contact </title>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
<?php
if (empty($_POST['envoyer'])){
?>
<center>
<div id='main'>
            <link href = "registration.css" type = "text/css" rel = "stylesheet" />    
            <h3>Contact</h3> <br/> <br/> 
            <form name = "form1" action="contact.php" method = "post" enctype = "multipart/form-data" >    
                <div class = "container">    
                    <div class = "form_group">    
                        <label>  * Votre Nom : </label>    
                        <input type = "text" name = "fname" id="fname" value = "" required />    
                    </div>  <br/> <br/>    
                    <div class = "form_group">    
                        <label> * Votre Prenom : </label>    
                        <input type = "text" name = "mname" id="mname" value = "" required />   						
                    </div>  <br/> <br/>  
					<div class = "form_group">    
                        <label> * Objet du contact : </label>    
                        <input type = "text" name = "sujet" maxlength="128" value = "" required >   						
                    </div> 	<br/> <br/>  
					<div class = "form_group">    
                        <label> * Votre Email : </label>    
                        <input type = "email" name = "email" value = "" required >   						
                    </div> 	<br/> <br/>  			
                    <div class = "form_group">    
                        <label> * Ajouter votre message : </label>    
                         <textarea type="text" name="commentaire" id="commentaire"   rows="10" cols="50" required />
						 </textarea>  <br/> <br/>  
						 <h5 style="color:Tomato; font-family: verdana;"> Les champs avec une étoile sont obligatoires </h5> <br/> <br/> 
						 <input type="submit" name="envoyer" value="envoyer" />   
                    </div>    
                </div>    
            </form>  
		 </div>			   
		</center>   
  
 <?php
 }
else {
    $destinataire = 'fabrice.pierron@yahoo.com';
    
    $expediteur = $_POST['email'];
     
    $objet = $_POST['sujet'];
     
    $headers  = 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n"; 
    $headers .= 'To: '.$destinataire."\n"; 
    $headers .= 'From: "Nom_de_destinataire"<'.$expediteur.'>'."\n"; 
     
    $message =  '<div style="width: 100%; text-align: center; font-weight: bold"> '.$_POST['commentaire'].'</div>';
     
    if(mail($destinataire, $objet, $message, $headers))
    {
        echo '<script languag="javascript" >alert("Votre message a bien été envoyé ");</script>';
		echo '<meta http-equiv="refresh" content="0;URL=?page=accueil">';
    }
    else 
    {
        echo '<script languag="javascript">alert("Votre message n\'a pas pu être envoyé");</script>';
    }
}
?>
	