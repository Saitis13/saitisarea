<?php
session_start();
require_once('templates/partials/header.phtml');
//var_dump($_SESSION['panier']);
$montantCommande=0;
$nbproduits=0;
require_once('templates/panier.phtml');	
?>

	