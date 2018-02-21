<center>
<div id="main">
<h2><?php echo $xml->connexion->$lang;?></h2><hr>
<form action= "veriflogin.php" method="post" class="form" role="form">

 <div class="form-group">
    <input id="emailInput" placeholder="<?php echo $xml->identifiant->$lang;?>" class="form-control form-control-sm inline" type="text" required="" name= "PSEUDO">
    </div>
    <div class="form-group">
    <br><input id="passwordInput" placeholder="<?php echo $xml->mdp->$lang;?>" class="form-control form-control-sm inline" required="" type="password" name="MDP">
    </div>
    <div class="form-group">
    <br><button type="submit" class="btn btn-primary btn-block"><?php echo $xml->login->$lang;?></button>
    </div>
</form>
</div>
</center>
<script>
document.title ="Page de Connexion";
</script>