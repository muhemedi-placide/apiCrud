<?php
// les entetes headers requises

header("Access-Control-Allow-Origin:*"); //definition de l'access de l'application qui doit acceder a notre application
header("Contet-type: application/json; charset=UTF-8"); //le type de contenu autorise
header("Access-control-Allow-method: GET"); //le type de la requete accepter est uniquement la methode get 

require_once '../config/database.php';
require_once '../models/Etudiant.php';


if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // instanciation db
    $database = new database();
    $db = $database->connexionDB();

    // on instancie l'objet etudiant
    $etudiant = new Etudiant($db);

    // recuration des donnees
    $stmt = $etudiant->readAll();

    if ($stmt->rowCount() > 0) {
        // var_dump($stmt);
        $data = [];
        $data[] = $stmt->fetchAll();

        // renvoie de donnees sous format json.
        http_response_code(200);
        echo json_encode($data);
    } else {
        echo json_encode(['Message' => 'Aucune donnee n\est trouve a envoyer !']);
    }
} else {
    http_response_code(405);
    echo json_encode(['Message' => "la methode utilise n'est pas autorisee"]);
}
