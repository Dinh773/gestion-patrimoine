<?php
require_once 'Model.php';

class ModelResidence {
    private $id, $label, $ville, $prix, $personne_id;

    public function __construct($id = NULL, $label = NULL, $ville = NULL, $prix = NULL, $personne_id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->ville = $ville;
            $this->prix = $prix;
            $this->personne_id = $personne_id;
        }
    }

    function setId($id) { $this->id = $id; }
    function setLabel($label) { $this->label = $label; }
    function setVille($ville) { $this->ville = $ville; }
    function setPrix($prix) { $this->prix = $prix; }
    function setPersonneId($personne_id) { $this->personne_id = $personne_id; }

    function getId() { return $this->id; }
    function getLabel() { return $this->label; }
    function getVille() { return $this->ville; }
    function getPrix() { return $this->prix; }
    function getPersonneId() { return $this->personne_id; }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM residence order by prix";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelResidence");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
     public function getProprietaire() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE id = :personne_id";
            $statement = $database->prepare($query);
            $statement->execute(['personne_id' => $this->personne_id]);
            $proprietaire = $statement->fetchObject("ModelPersonne");
            return $proprietaire;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function getResidencesById($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM residence WHERE id = $id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelResidence");
            return $results ? $results[0] : null;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
        
    }
    public static function getResidencesByPersonne($personne_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from residence where personne_id = :personne_id";
            $statement = $database->prepare($query);
            $statement->execute(['personne_id' => $personne_id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelResidence");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getAllExceptOwner($owner_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM residence WHERE personne_id != :owner_id";
            $statement = $database->prepare($query);
            $statement->execute(['owner_id' => $owner_id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelResidence");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function transfererProprieteEtFonds($residence_id, $acheteur_id, $vendeur_id, $prix, $acheteur_compte_id, $vendeur_compte_id) {
        try {
            $database = Model::getInstance();
            $database->beginTransaction();
            
            
            $query = "SELECT montant FROM compte WHERE id = :acheteur_compte_id";
            $statement = $database->prepare($query);
            $statement->execute(['acheteur_compte_id' => $acheteur_compte_id]);
            $acheteur_compte = $statement->fetch(PDO::FETCH_ASSOC);

            if ($acheteur_compte['montant'] < $prix) {
                $database->rollBack();
                throw new PDOException("Solde insuffisant dans le compte acheteur.");
            }

            
            $query = "UPDATE residence SET personne_id = :acheteur_id WHERE id = :residence_id";
            $statement = $database->prepare($query);
            $statement->execute(['acheteur_id' => $acheteur_id, 'residence_id' => $residence_id]);

            
            $query = "UPDATE compte SET montant = montant - :prix WHERE id = :acheteur_compte_id";
            $statement = $database->prepare($query);
            $statement->execute(['prix' => $prix, 'acheteur_compte_id' => $acheteur_compte_id]);

            if ($statement->rowCount() == 0) {
                $database->rollBack();
                throw new PDOException("Erreur lors du débit du compte acheteur.");
            }

            $query = "UPDATE compte SET montant = montant + :prix WHERE id = :vendeur_compte_id";
            $statement = $database->prepare($query);
            $statement->execute(['prix' => $prix, 'vendeur_compte_id' => $vendeur_compte_id]);

            if ($statement->rowCount() == 0) {
                $database->rollBack();
                throw new PDOException("Erreur lors du crédit du compte vendeur.");
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


