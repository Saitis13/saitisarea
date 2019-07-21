<?php
session_start();

require_once('./database.php');
$task =$_GET['task'];
// var_dump($task);

switch ($task){

	case'panier';
	ajoutUnArticle();
	break;

	case'panier-';
	diminuerUnArticle();
	break;
	
	case'ajout';
	ajoutreservation();
	break;

	case'vider';
	viderpanier();
	break;

	default :
 	echo 'Vous avez acheté un autre légume' ;
 	break;
	}

function viderpanier(){
	$_SESSION['panier']=[];
	header('Location: ../index.php');
}

function ajoutreservation(){
	$nom = $_POST['nom']; // le nom
	$prenom = $_POST['prenom']; // le prenom
	$email = $_POST['email']; // le email
	$date = $_POST['date']; //  
    $message = $_POST['message']; //  
	$nbpersonnes = $_POST['nbpersonnes']; // 
    // ajoute dans la db
    $message= addreservation($nom,$prenom,$email,$date,$message,$nbpersonnes);

   	header('Location: ../index.php');
    }

function ajoutUnArticle(){
    // article +
	$idproduit =$_GET['id'];
	//je recupere les infos sur ce produit 
	$produit = showproduitinfos($idproduit);
	// var_dump($produit);
	 // var_dump($_SESSION['panier']);
     var_dump($_GET['origine']);
    if (!empty($_SESSION['panier'])){ 
   	 var_dump("debut cas pas vide ");
			$flag = false;
			foreach ($_SESSION['panier'] as &$element){
				 var_dump("debut cas pas vide ");
			// on cherche la clé du   produit est il deja dans la liste? 
			// &$element car on travaille sur le tableau et non sa copie!!! 
		   // foreach ($_SESSION['panier'] as &$element){
				// var_dump($element, $idproduit);
		    	if ($element[0]==$idproduit){
		    		$flag = true;
				    /// on ajoute +1 à la quantité $_SESSION['panier']
				    // retrouver le produit donc le premier champs est id 
					// rajouter +1 au dernier champs de ce produits
					//$quantite ++;
				    $element[4]++;
				}//   	
		    }// fin de foreach
	
            if (!$flag){
    // met sa quantité à 1  ajoute le produit et
		// array_push($produit,1);
		// on ajoute dans le tableau la ligne correspondant au produit avec la quantite a 1
		array_push($_SESSION['panier'], [
			$produit['id'],
			$produit['titre'],
			$produit['prix'],
			$produit['image'],
			1
		]);
	    }// endif 
	}else {
		// cas ou le panier est vide 
		var_dump("panier vide");
		    $_SESSION['panier']=[];
			$quantite=1;
		    var_dump ($quantite);// // $nvlleligne=[$produit['id'],$produit['titre'],$produit['prix'],$quantite];
			array_push($_SESSION['panier'], [$produit['id'],$produit['titre'],$produit['prix'],$produit['image'],$quantite]);
		   }//var_dump("fin");
    // var_dump($_SESSION['panier']);

   if($_GET['origine']=="panier"){
    header('Location: ../panier.php');
   }else{
    header('Location: ../index.php');
   }
}

function diminuerUnArticle(){
	// article-
	//var_dump($id);
	$idproduit =$_GET['id'];
	var_dump($idproduit);
	foreach ($_SESSION['panier'] as &$element){
		// var_dump($element, $idproduit);
    	if ($element[0]==$idproduit){
    		$flag = true;
		    /// on ajoute +1 à la quantité $_SESSION['panier']
		    // retrouver le produit donc le premier champs est id 
			// rajouter +1 au dernier champs de ce produits
			//$quantite ++;
		    $element[4]--;
		}//   	
    }// fin de foreach
    header('Location: ../panier.php');
   
   }  














