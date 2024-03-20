<?php 
header("Access-control-Allow-Origin: *");
header("Access-control-Allow-Methods:POST");
header("Content-type: application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../models/Etudiant.php';


if($_SERVER['REQUEST_METHOD'] === "POST"){
    // J'INSTANCIE LA BASE  DE DONNEES
    $database = new database();
    $db = $database->connexionDB();

    // on instancie l'objet etudiant
    $etudiant = new Etudiant($db);
// on recupere les informations envoyees et on decode les donnees en format exploitable json

$data = json_decode(file_get_contents("php://input"));
if(!empty($data ->nom ) && !empty($data ->prenom) && !empty($data ->age) && !empty($data ->niveau_id)){
// on hydrate l'objet etudiant
$etudiant->nom = $data ->nom;
$etudiant->prenom = $data ->prenom;
$etudiant->age = $data->age;
$etudiant->niveau_id = $data ->niveau_id;

$resultat = $etudiant->creatEtudiant();
if($resultat){
    http_response_code(201);
    echo json_encode(['Message' => 'Etudiant created Successfully']);
}else{
    http_response_code(503);
    echo json_encode(['Message' => 'Etudiant has not been created successfully']);
}
}else{
    echo json_encode(['message' => 'Tout le champs est requis']);
}

}else{
http_response_code(405);
echo json_encode(['message' => 'La methode n\'est pas autorise']);
}