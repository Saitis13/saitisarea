<?php
require_once('libraries/database.php');
	session_start();
//$_SESSION['panier'] =[];

// affiche la liste totale des plats 
$typedeplat= "entree";
$entrees=getAll($typedeplat);
 // var_dump($entrees);
$typedeplat= "plat";
 $plats=getAll($typedeplat);
 //var_dump($plats);
$typedeplat= "dessert";
 $desserts=getAll($typedeplat);
 //var_dump($desserts);
 require_once('templates/index.phtml');	
?>

