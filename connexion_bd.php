<?php
$host='localhost';
$dbname='mexico85';
$username='mexico85';
$password='4oahluvluci1_blan';
$port=3306;
$dsn = 'mysql:host='.$host.';dbname='.$dbname.';port='.$port.';charset=utf8';

try {
    $myPDO = new PDO($dsn,$username,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }
catch (PDOException $e) {
    print "Erreur de connexion : " . $e->getMessage() . "<br/>";
    die();
}
finally {
if (!debug_backtrace()) {
	echo "Connected successfully";
}
}
?>