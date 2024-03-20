<?php 
header("Access-control-Allow-Origin: *");
header("Access-control-Allow-Methods: PUT");
header("content-type:application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../models/Etudiant.php';

if($_SERVER["REQUEST_METHOD"] === "PUT"){
    // j'instancie la base de donnes
    $database = new database();
    $db = $database->connexionDB();

    // on instancie l'objet etudiant
    $etudiant = new Etudiant($db);

    // on recuperer les donnnees envoyer et on le decoder dans le format json

    $data = json_decode(file_get_contents("php://input"));
    if( !empty($data->id) && !empty($data ->nom ) && !empty($data ->prenom) && !empty($data ->age) && !empty($data ->niveau_id)){
        // on hydrate l'objet etudiant
        $etudiant->nom = $data ->nom;
        $etudiant->prenom = $data ->prenom;
        $etudiant->age = $data->age;
        $etudiant->niveau_id = $data ->niveau_id;
        $etudiant->id=$data->id;
        
        $resultat = $etudiant->update();
        if($resultat){
            http_response_code(201);
            echo  json_encode(['Message' => "Etudiant a ete bien modifier"]);

        }else{
            http_response_code(503);
            echo json_encode(["Message" => "Etudiant n'etait pas bien modifier"]);
        }
    }else{
        http_response_code(405);
        echo json_encode(["Message" => "La methode Utilise n'est pas autorise"]);
    }

}

?>