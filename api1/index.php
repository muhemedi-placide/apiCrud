<?php 

include 'config/database.php';
require 'models/Etudiant.php';


$data = new database();
$db = $data->connexionDB();
$etudiant = new Etudiant($db);

$data = $etudiant->readAll();

var_dump($data -> fetchAll());