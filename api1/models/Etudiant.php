<?php

class  Etudiant
{
    private $table = 'etudiant';
    private $connexion = null;

    //les proprietes de l'objet etudiant.

    public $id;
    public $nom;
    public $prenom;
    public $age;
    public $niveau_id;
    public $created_at;

    // construct method for connexion

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    // lecture des etudiants

    public function readAll()
    {
        // on ecrit la requete
        $sql = "SELECT etudiantTab.id, etudiantTab.nom,prenom,age,niveau_id,creted_at, niveauTab.nom as nom_niveau
         FROM $this->table as etudiantTab LEFT JOIN niveau as niveauTab ON niveau_id = niveauTab.id ORDER BY etudiantTab.creted_at DESC";
        // execution de la requette
        $req = $this->connexion->query($sql);
        // on retourne le resultat
        return $req;
    }
    public function creatEtudiant()
    {
        $sql = "INSERT INTO  $this->table (nom,prenom,age,niveau_id) VALUES(:nom,:prenom,:age,:niveau_id)";
        $req = $this->connexion->prepare($sql);
        $resultat = $req->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':age' => $this->age,
            ':niveau_id' => $this->niveau_id
        ]);
        if ($resultat) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET nom=:nom,prenom=:prenom,age=:age,niveau_id=:niveau_id WHERE id=:id";
        // prepare la requete
        $req = $this->connexion->prepare($sql);

        // execution de la requete
        $resultat = $req->execute(
            [
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':age' => $this->age,
                ':niveau_id' => $this->niveau_id,
                ':id' => $this->id
            ]
        );
        if ($resultat) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $req = $this->connexion->prepare($sql);
        $res = $req->execute(
            [
                ':id' => $this->id
            ]
        );
        if($res){
            return true;
        }else{
            return false;
        }
    }
}
