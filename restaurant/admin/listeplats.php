<?php
session_start();

require_once('libraries/database.php');
	
$typedeplat= "entree";
 $entrees=getAll($typedeplat);
//var_dump($entrees);

$typedeplat= "plat";
 $plats=getAll($typedeplat);
 //var_dump($plats);

$typedeplat= "dessert";
 $desserts=getAll($typedeplat);
 // var_dump($desserts);

require_once('templates/listeplats.phtml');

?>
	
