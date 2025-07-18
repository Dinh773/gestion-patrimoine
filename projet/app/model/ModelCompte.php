<?php
require_once 'Model.php';
require_once 'ModelBanque.php';
require_once 'ModelPersonne.php';

class ModelCompte {
    private $id, $label, $montant, $banque_id, $personne_id;

    public function __construct($id = NULL, $label = NULL, $montant = NULL, $banque_id = NULL, $personne_id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->montant = $montant;
            $this->banque_id = $banque_id;
            $this->personne_id = $personne_id;
        }
    }

    function setId($id) { $this->id = $id; }
    function setLabel($label) { $this->label = $label; }
    function setMontant($montant) { $this->montant = $montant; }
    function setBanqueId($banque_id) { $this->banque_id = $banque_id; }
    function setPersonneId($personne_id) { $this->personne_id = $personne_id; }

    function getId() { return $this->id; }
    function getLabel() { return $this->label; }
    function getMontant() { return $this->montant; }
    function getBanqueId() { return $this->banque_id; }
    function getPersonneId() { return $this->personne_id; }

    public static function getComptesByPersonne($personne_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from compte where personne_id = :personne_id";
            $statement = $database->prepare($query);
            $statement->execute(['personne_id' => $personne_id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCompte");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from compte";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCompte");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public function getBanque() {
        return ModelBanque::getBankById($this->banque_id);
    }

     public function getProprietaire() {
        return ModelPersonne::getProprio($this->personne_id);
    }
    
    public static function insertCompte($label, $montant, $banque_id, $personne_id) {
    try {
        $database = Model::getInstance();

        
        if (!is_numeric($montant) || $montant < 0) {
            return -2; 
        }

        
        $query = "SELECT MAX(id) AS max_id FROM compte";
        $statement = $database->query($query);
        $tuple = $statement->fetch();
        $id = $tuple['max_id'] + 1;

       
        $query = "INSERT INTO compte VALUES (:id, :label, :montant, :banque_id, :personne_id)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $id,
            'label' => $label,
            'montant' => $montant,
            'banque_id' => $banque_id,
            'personne_id' => $personne_id
        ]);

        return $id; 

    } catch (PDOException $e) {
        
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1; 
    }
}

public static function countUserAccounts($user_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT COUNT(*) as compte_count FROM compte WHERE personne_id = :user_id";
            $statement = $database->prepare($query);
            $statement->execute(['user_id' => $user_id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result['compte_count'];
        } catch (PDOException $e) {
            return 0; 
        }
}

    
    
    public static function transfertCompte($id_compte_i, $montant, $id_compte_f) {
    try {
        $database = Model::getInstance();

        
        $database->beginTransaction();
        
        if ($id_compte_i==$id_compte_f){
            $database->rollBack();
            throw new PDOException("Compte source et compte destination ne doit pas etre identique !");
        }
        
        
        $query = "SELECT montant FROM compte WHERE id = :id_compte_i";
        $statement = $database->prepare($query);
        $statement->execute(['id_compte_i' => $id_compte_i]);
        $compte_source = $statement->fetch(PDO::FETCH_ASSOC);

        if ($compte_source === false || $compte_source['montant'] < $montant) {
            $database->rollBack();
            throw new PDOException("Solde insuffisant dans le compte source ou compte inexistant.");
          
        }

        
        $query = "UPDATE compte SET montant = montant - :montant WHERE id = :id_compte_i";
        $statement = $database->prepare($query);
        $statement->execute([
            'montant' => $montant,
            'id_compte_i' => $id_compte_i
        ]);

        
        if ($statement->rowCount() == 0) {
            $database->rollBack();
            throw new PDOException("Erreur lors du débit du compte source.");
            
        }

        $query = "UPDATE compte SET montant = montant + :montant WHERE id = :id_compte_f";
        $statement = $database->prepare($query);
        $statement->execute([
            'montant' => $montant,
            'id_compte_f' => $id_compte_f
        ]);

        
        if ($statement->rowCount() == 0) {
            $database->rollBack();
            throw new PDOException("Erreur lors du crédit du compte destination.");
            
        }

        
        $database->commit();
        return 1;

    } catch (PDOException $e) {
            if ($database->inTransaction()) {
            $database->rollBack();
            } 
            
            return $e->getMessage();
        }
        
}
    
}
?>
