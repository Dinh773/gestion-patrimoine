<?php
require_once 'Model.php';

class ModelBanque {
    private $id, $label, $pays;

    public function __construct($id = NULL, $label = NULL, $pays = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->pays = $pays;
        }
    }

    function setId($id) { $this->id = $id; }
    function setLabel($label) { $this->label = $label; }
    function setPays($pays) { $this->pays = $pays; }

    function getId() { return $this->id; }
    function getLabel() { return $this->label; }
    function getPays() { return $this->pays; }

    public static function getAllId() {
        try {
            $database = Model::getInstance();
            $query = "select id from banque";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getMany($query) {
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelBanque");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from banque";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelBanque");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from banque where id = $id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelBanque");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($label, $pays) {
    try {
        $database = Model::getInstance();
        
        
        $query_check = "SELECT COUNT(*) FROM banque WHERE label = :label";
        $statement_check = $database->prepare($query_check);
        $statement_check->bindParam(':label', $label, PDO::PARAM_STR);
        $statement_check->execute();
        $count = $statement_check->fetchColumn();
        
        if ($count > 0) {
            return -1; 
        } else {
            
            $query = "SELECT MAX(id) AS max_id FROM banque";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['max_id'] + 1; // Calculer le nouvel ID
            
            $query_insert = "INSERT INTO banque VALUES (:id, :label, :pays)";
            $statement_insert = $database->prepare($query_insert);
            $statement_insert->bindParam(':id', $id, PDO::PARAM_INT);
            $statement_insert->bindParam(':label', $label, PDO::PARAM_STR);
            $statement_insert->bindParam(':pays', $pays, PDO::PARAM_STR);
            $statement_insert->execute();
            
            return $id; 
        }
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1; 
    }
}


    public static function update() {
        echo ("ModelBanque : update() TODO ....");
        return null;
    }

    public static function delete() {
        echo ("ModelBanque : delete() TODO ....");
        return null;
    }

    public static function getByBanque($banque_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from compte where banque_id = $banque_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCompte");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getBankById($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM banque WHERE id = $id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelBanque");
            return $results ? $results[0] : null;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }
}
?>
