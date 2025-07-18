<?php
require_once 'Model.php';

class ModelPersonne {
    public const ADMINISTRATEUR = 0;
    public const CLIENT = 1;

    private $id, $nom, $prenom, $statut, $login, $password;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $statut = NULL, $login = NULL, $password = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->statut = $statut;
            $this->login = $login;
            $this->password = $password;
        }
    }

    function setId($id) { $this->id = $id; }
    function setNom($nom) { $this->nom = $nom; }
    function setPrenom($prenom) { $this->prenom = $prenom; }
    function setStatut($statut) { $this->statut = $statut; }
    function setLogin($login) { $this->login = $login; }
    function setPassword($password) { $this->password = $password; }

    function getId() { return $this->id; }
    function getNom() { return $this->nom; }
    function getPrenom() { return $this->prenom; }
    function getStatut() { return $this->statut; }
    function getLogin() { return $this->login; }
    function getPassword() { return $this->password; }

    public static function verifyUser($login, $password) {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where login = :login and password = :password";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $login, 'password' => $password]);
            $statement->setFetchMode(PDO::FETCH_CLASS, "ModelPersonne");
            $user = $statement->fetch();
            return $user;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where statut=1";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAllAdmin() {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where statut=0";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getProprio($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results ? $results[0] : null;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function insert($nom, $prenom, $statut, $login, $password) {
    try {
        $database = Model::getInstance();
        $database->beginTransaction();

        
        $query = "SELECT MAX(id) AS max_id FROM personne";
        $statement = $database->prepare($query);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $next_id = $row['max_id'] + 1;

       
        $query = "INSERT INTO personne (id, nom, prenom, statut, login, password) VALUES (:id, :nom, :prenom, :statut, :login, :password)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $next_id,
            'nom' => $nom,
            'prenom' => $prenom,
            'statut' => $statut,
            'login' => $login,
            'password' => $password
        ]);

        $database->commit();
        return $next_id; 
    } catch (PDOException $e) {
        $database->rollBack();
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1; 
    }
}

       public static function getUserByLoginPassword($login, $password) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE login = :login AND password = :password";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $login, 'password' => $password]);
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new ModelPersonne($row['id'], $row['nom'], $row['prenom'], $row['statut'], $row['login'], $row['password']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
    public static function calculerPatrimoinePersonne($results, $resid) {
        $totalPatrimoine = 0;
        $patrimoines = [];

        // Parcours des comptes
        foreach ($results as $compte) {
            $patrimoines[] = [
                'type' => 'Compte',
                'label' => $compte->getLabel(),
                'prix' => $compte->getMontant()
            ];
            $totalPatrimoine += $compte->getMontant();
        }

        
        foreach ($resid as $residence) {
            $patrimoines[] = [
                'type' => 'Résidence',
                'label' => $residence->getLabel(),
                'prix' => $residence->getPrix()
            ];
            $totalPatrimoine += $residence->getPrix();
        }

        return [
            'patrimoines' => $patrimoines,
            'totalPatrimoine' => $totalPatrimoine
        ];
    }

    
    
}
?>
