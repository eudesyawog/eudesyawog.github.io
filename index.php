<?php
session_start();

function set_cookie($lang)
{
	$expire = 365*24*3600;
	setcookie("CHOIXlang", $lang, time() + $expire);
}
$getlang = isset($_GET['lang']) ? $_GET['lang']:'';

if (isset ($_COOKIE['CHOIXlang']) && $getlang != 'fr' && $getlang != 'es')
{
$lang = $_COOKIE['CHOIXlang'];
} 

else if ($getlang == 'es' || $getlang == 'fr')
{
$lang = $getlang;
set_cookie($lang);
}
else
{
$lang = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$lang = strtolower(substr(chop($lang[0]),0,2));
set_cookie($lang);
} 

$xml=simplexml_load_file("langue.xml")or die("xml non trouvé");
?>
<!DOCTYPE html>
<html >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--link rel="icon" type="image/png" href="" /-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Montserrat Alternates' rel='stylesheet'>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
<link rel="stylesheet" type="text/css" href="style.css">

<!--jQuery and Plugins-->
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<!-- fancybox JS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<!--Magnific Popup-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"</script>
<!--Bootstrap JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

</head>
<body>
<?php
include 'menu.html';

if (isset ($_GET[ 'page' ])) {
$page = $_GET[ 'page' ];
} else {
// set proper default value if it was not set
$page = 'accueil' ;
}
include ($page. '.php' );

include 'footer.php';
?>
</html>