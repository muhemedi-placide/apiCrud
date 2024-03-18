<?php 

class  Etudiant {
private $table = 'etudiant';
private $connexion = null;

//les proprietes de l'objet etudiant.

public $id;
public $nom;
public $prenom;
public $age;
public $created_at;

// construct method for connexion

public function __construct($db)
{ 
    if($this->connexion == null){
        $this->connexion = $db;
    }
}

// lecture des etudiants

public function readAll(){
    // on ecrit la requete
    $sql = "SELECT * FROM ".$this->table;
    $req = $this->connexion->query($sql);

    return $req;
}

}