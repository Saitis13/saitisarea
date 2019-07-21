<?php
session_start();

require_once('libraries/database.php');
$id=$_GET['id'];
//"libraries/application.php?task=modifier"
$monplat=getOnePlat($id);
//var_dump($monplat);

require_once('templates/modifierplat.phtml');	
?>
