<?php
// fction de connexion à la base de donnees
function connect(){
	  // $db=new pdo( 'mysql:host=localhost;dbname=restaurant;charset=utf8','user','DHYrKzMEQ00gdZFn', [
	   //$db=new pdo( 'mysql:host=localhost;dbname=restaurant;charset=utf8','user','troiswa', [
	  $db=new pdo( 'mysql:host=localhost;dbname=restaurant;charset=utf8','root','troiswa', [
	  	 //$db=new pdo( 'mysql:host=localhost;dbname=restaurant;charset=utf8','root','', [
	   		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	   	]);  
	return $db;
} 

function getAll($type){
// connexion à la base de données
		$base=connect();
		// requete auprès de la base 
		$requete=$base->prepare('
		SELECT plats.* 
		FROM plats
		WHERE plats.type =:montype
		order by prix 
		');
		// protection contre les codes saisies malveillants
		$requete->execute([":montype"=>$type]);
	
		// recupération des données
		$elements=$requete->fetchAll();
return$elements;
}
  
function  addreservation($nom,$prenom,$email,$date,$message,$nbpersonnes){	
	$base=connect();
	
	// requete auprès de la base 
	$requete = $base->prepare('
					INSERT INTO reservations
					SET 
					nom=:monnom,
					prenom=:monprenom,
					email= :monemail,
					message= :monmessage,
					`date` = :madate,					
					nb_personnes= :mesconvives
					');
	
	// Execution de la requête en précisant à quoi doivent correspondre
	// les tokens ()
	$message=$requete->execute([
		":monnom"=> $nom,
		":monprenom"=> $prenom,
		":monemail"=> $email,
		":madate"=> $date,
		":monmessage"=> $message,
		":mesconvives"=> $nbpersonnes]);

    return $message;
}

function  showproduitinfos($id){	
	$base=connect();
	
	// requete auprès de la base 
	$requete = $base->prepare('
		SELECT plats.* 
		 FROM plats
		 WHERE plats.id =:monid
		');
		// protection contre les codes saisies malveillants
	$requete->execute([":monid"=>$id]);	
		// recupération des données
	$element=$requete->fetch();

	return $element;
}

