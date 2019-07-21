
<?php
session_start();

require_once('libraries/database.php');
// affiche la liste totale des plats 
$reservations= getAllReservations();

require_once('templates/index.phtml');	
?>
