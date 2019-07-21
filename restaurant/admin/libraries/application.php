<?php
session_start();

require_once('./database.php');
$task =$_GET['task'];
// var_dump($task);

switch ($task){

	case'ajout';
	ajoutUnPlat();
    break;

	case'supprimer';
	supprimerUnPlat();
    break;

	case'modifier';
	modifierUnPlat();
    break;

	default :
 	echo 'Vous avez acheté un autre légume' ;
 	break;
	}

function ajoutUnPlat(){
    $image = $_POST['image']; // l'image'
	$titre = $_POST['titre']; // le titre
	$description = $_POST['description']; // 
	$type = $_POST['type']; //  
    $prix = $_POST['prix']; //  
	 // var_dump($titre);
    // ajoute dans la db
    $message= ajoutPlat($image,$titre,$description,$type,$prix);
// var_dump("ended");
   	header('Location: ../listeplats.php');
    }

function modifierUnPlat(){
	$id = $_GET['id'];
    $image = $_POST['image']; // l'image'
	$titre = $_POST['titre']; // le titre
	$description = $_POST['description']; // 
	$type = $_POST['type']; //  
    $prix = $_POST['prix']; //  
	  var_dump($titre);
    // ajoute dans la db
    $message= modifPlat($image,$titre,$description,$type,$prix,$id);
    // var_dump("ended");
   	header('Location: ../listeplats.php');
    }

function supprimerUnPlat(){
    $id = $_GET['id'];
    // ajoute dans la db
    // var_dump($id);
    $message= suppPlat($id);
    // var_dump("ended");
   	header('Location: ../listeplats.php');
    }
