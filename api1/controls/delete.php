<?php 
header("Access-control-Allow-Origin: *");
header("Access-control-Allow-Methods: DELETE");
header("Content-type:application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../models/Etudiant.php';

if($_SERVER["REQUEST_METHOD"] === "DELETE"){
// instanciation de la base de donnnes
$dbase = new database();
$db = $dbase ->connexionDB();

// on instancie l'objet etudiant
$etudiant = new Etudiant($db);

// recuperation de donnees
$data =  json_decode(file_get_contents("php://input"));

if(!empty($data->id)){
    // hydrate l'objet etudiant
    $etudiant->id = $data -> id;

    $res = $etudiant->delete();
    if($res){
        http_response_code(201);
        echo json_encode(["Message" => "L'etudiant a ete bien suprime"]);
    }else{
        http_response_code(503);
        echo json_encode(["Message" => "l'etudiant n'a pas ete bien suprime"]);
    }
}else{
    http_response_code(405);
    echo json_encode(['Message' => "la methode applique ne pas autorise.. !"]);
}


}
?>