<script>
document.title ="Galerie Mexico - 1985";
</script>
<style type="text/css">
.gallery img {
    width: 150px;
    height: 150px;
    border-radius: 5px;
    cursor: pointer;
    transition: .3s;
	margin : 5px;
	margin-bottom: 15px;
}
#fancybox-content {
    height: 680px;
    width: 550px;
    padding: 0;
    margin: 0;
    overflow: scroll;
}
.gallery {
		overflow: auto;
}
</style>
<center>
<div id="main">
	<h2><?php echo $xml->galerie->$lang;?></h2><hr>
    <div class="gallery">
        <?php
        //Include database configuration file
        include('connexion_bd.php');
        
        //get images from database
        $query = $myPDO->query("SELECT * FROM photo, photojournaliste WHERE photo.ID_PJ=photojournaliste.ID_PJ ORDER BY CAST(photo.ORDRE AS UNSIGNED);");
		if($query->rowCount() > 0){
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$img = substr($row['NOM_PHOTO'],0,-4);
				$format = substr($row['NOM_PHOTO'],-4);
                $imageThumbURL = 'photos/thumb_400/'.$img.'_400'.$format;
                $imageURL = 'photos/'.$row["NOM_PHOTO"];
				$view= $row['STREET_VIEW'];
				$adresseFr= $row['ADRESSE_FR'];
				$adresseEs= $row['ADRESSE_ES'];
				$date= $row['DATE_PHOTO'];
				$angle= $row['ANGLE_VUE'];
				$descFr= $row['DESCRIPTION_FR'];
				$descEs= $row['DESCRIPTION_ES'];
				$auteurP= $row['PRENOM_PJ'];
				$auteurN= $row['NOM_PJ'];
        ?>
            <a class ="fancybox" href="<?php echo $imageURL; ?>" data-fancybox="group" data-caption="
			<?php if ($getlang == "fr" || $lang == "fr")
{
echo '<strong>DESCRIPTION :&nbsp;</strong>'.$descFr;
}
elseif ($getlang == "es" || $lang == "es")
{
echo '<strong>'.$xml->description_g->$lang.':&nbsp;</strong>'.$descEs;
}
				  echo '<br>';
				  
				  if ($getlang == "fr" || $lang == "fr")
{
echo '<strong>'.$xml->adresse_g->$lang.':&nbsp;</strong>'.$adresseFr;
}
elseif ($getlang == "es" || $lang == "es")
{
echo '<strong>'.$xml->adresse_g->$lang.':&nbsp;</strong>'.$adresseEs;
} 
				  echo '<br>';
				  echo '<strong>'.$xml->date_g->$lang.':&nbsp;</strong>'.$date;
				  echo '<br>';
				  echo '<strong>'.$xml->auteur_g->$lang.':&nbsp;</strong>'.$auteurP.'&nbsp'.$auteurN;
				  
			?> <p><strong>StreetView :&nbsp;<a target= '_blank' href=<?php echo $row["STREET_VIEW"].'>'.$xml->pano_g->$lang;?></a></strong></p>" content="text/html";>
            <img src="<?php echo $imageThumbURL; ?>" data-title-id="title-1" alt="" />

			</a>
			
			
			
    <?php 
		}
     } 
	//$query=null;
	//$myPDO=null;
	 
	 ?>

    </div>
	
	
</div>
</center>