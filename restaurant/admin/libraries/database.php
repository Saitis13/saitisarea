<?php
// fction de connexion à la base de donnees
function connect(){
	   $db=new pdo( 'mysql:host=localhost;dbname=restaurant;charset=utf8','root','troiswa',  [
	    //$db=new pdo( 'mysql:host=localhost;dbname=restaurant;charset=utf8','root','troiswa', [
	   		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	   	]);  
	return $db;
} 

function getAllReservations(){
	// connexion à la base de données
	$base=connect();
	// requete auprès de la base 
	$requete=$base->query('SELECT * 
	FROM reservations
	ORDER BY date ');
	// recupération des données
	$reservations=$requete->fetchAll();
return$reservations;
}
function getOnePlat($id){
	// connexion à la base de données
	$base=connect();
	// requete auprès de la base 
	$requete = $base->prepare('SELECT  * 
				from plats 
				where 
				id=:monid');
	// recupération des données
	$message=$requete->execute([
		":monid"=> $id
		]);
	$monplat=$requete->fetch();
 	//  var_dump($apparts2);
	return$monplat;
}

function getAll($type){
	$base=connect();
	// requete auprès de la base 
	$requete =$base ->prepare('SELECT  * 
				from plats 
				where 
				type = :montype
				order by prix'
				);
	// recupération des données
	$message=$requete->execute([
		":montype"=> $type
		]);
				

	// recupération des données
	$plats=$requete->fetchAll();
 	//  var_dump($apparts2);
	return$plats;
}

function ajoutPlat($image,$titre,$description,$type,$prix){
	$base=connect();
	 // requete auprès de la base 
	// (donc attention aux codes malveillants que des connards viennent mettre)
	$requete = $base->prepare('
					INSERT INTO plats
					SET 
					image=:monimage,
					titre=:montitre,
					description= :madescription,
					type= :montype,
					prix = :monprix					
					
					');
	
	// Execution de la requête en précisant à quoi doivent correspondre
	// les tokens ()
	$message=$requete->execute([
		":monimage"=> $image,
		":montitre"=> $titre,
		":madescription"=> $description,
		":montype"=> $type,
		":monprix"=> $prix
		]);
    return $message;
}

function modifPlat($image,$titre,$description,$type,$prix,$id){
    $db=connect();
	 // requete auprès de la base 
	// On prépare la requête de mise à jour 
	// (donc attention aux codes malveillants )
	// var_dump($id);
	//var_dump($prix);
	//var_dump($type);
	$query = $db->prepare('UPDATE plats 
							SET
							image        = :monimage,
							titre        = :montitre,
							description  = :madescription,
							type         = :montype,
							prix         = :monprix
						
							WHERE id = :monid');

	// On exécute en passant les valeurs pour chaque token
	$message=$query->execute([
		":monid"          => $id,
		":monimage"       => $image,
		":montitre"       => $titre,
		":madescription"  => $description,
		":montype"   	  => $type,
		":monprix"        => $prix	
	]);
 	return $message; 
}

function suppPlat($id){
    $db=connect();
	 // requete auprès de la base 
	// On prépare la requête de mise à jour 
	// (donc attention aux codes malveillants )
	$query = $db->prepare('DELETE FROM `plats`					
							WHERE id = :monid');

	// On exécute en passant les valeurs pour chaque token
	$message=$query->execute([
		":monid"            => $id	
	]);
 	return $message; 
}


?>