<?php
require_once '../model/ModelPersonne.php';
require_once '../model/ModelCompte.php';

class ControllerClient {
    public static function clientDashboard() {
        session_start();
        if ($_SESSION['user']->getStatut() == ModelPersonne::CLIENT) {
            include 'config.php';
            $vue = $root . '/app/view/client/viewDashboard.php';
            require ($vue);
        } else {
            include 'config.php';
            $vue = $root . '/app/view/user/viewError.php';
            require ($vue);
        }
    }

    public static function viewComptes() {
        session_start();
        if ($_SESSION['user']->getStatut() == ModelPersonne::CLIENT) {
            $personne_id = $_SESSION['user']->getId();
            $results = ModelCompte::getComptesByPersonne($personne_id);
            include 'config.php';
            $vue = $root . '/app/view/client/viewComptes.php';
            require($vue);
        } else {
            include 'config.php';
            $vue = $root . '/app/view/user/viewError.php';
            require($vue);
        }
    }

    public static function clientEnregistre() {
        include 'config.php';
        $vue = $root . '/app/view/client/viewEnregistre.php';
        require($vue);
    }

    public static function clientEnregistremsg() {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $statut = ModelPersonne::CLIENT;

        $results = ModelPersonne::insert($nom, $prenom, $statut, $login, $password);

        include 'config.php';
        $vue = $root . '/app/view/client/viewEnregistremsg.php';
        require($vue);
    }
    
    public static function compteCreate() {
        $banques = ModelBanque::getAll();
        include 'config.php';
        $vue = $root . '/app/view/client/viewInsertCompte.php';
        require ($vue);
    }
    
    public static function Patrimoine() {
        session_start();
        if ($_SESSION['user']->getStatut() == ModelPersonne::CLIENT) {
            $personne_id = $_SESSION['user']->getId();
            $results = ModelCompte::getComptesByPersonne($personne_id);
            $resid = ModelResidence::getResidencesByPersonne($personne_id);
            include 'config.php';
            $vue = $root . '/app/view/client/viewPatrimoine.php';
            require($vue);
        } else {
            include 'config.php';
            $vue = $root . '/app/view/user/viewError.php';
            require($vue);
        }
    }
    
    public static function compteCreer() {
    session_start();
    if ($_SESSION['user']->getStatut() == ModelPersonne::CLIENT) {
        $personne_id = $_SESSION['user']->getId();
        $label = htmlspecialchars($_GET['label'], ENT_QUOTES, 'UTF-8');
        $montant = htmlspecialchars($_GET['montant'], ENT_QUOTES, 'UTF-8');
        $banque_id = htmlspecialchars($_GET['banque_id'], ENT_QUOTES, 'UTF-8');

        $result = ModelCompte::insertCompte($label, $montant, $banque_id, $personne_id);

        if ($result == -2) {
            
            include 'config.php';
            $vue = $root . '/app/view/client/viewErreur.php';
            require($vue);
            return;
        } elseif ($result > 0) {
            
            $banques = ModelBanque::getAll();
            include 'config.php';
            $results=true;
            $vue = $root . '/app/view/client/viewInsertedCompte.php';
            require($vue);
            return;
        } else {
            
            include 'config.php';
            $vue = $root . '/app/view/client/viewE.php';
            require($vue);
            return;
        }
    } else {
        include 'config.php';
        $vue = $root . '/app/view/client/viewE.php';
        require($vue);
        return;
    }
}

    
    public static function viewResidences() {
        session_start();
        if ($_SESSION['user']->getStatut() == ModelPersonne::CLIENT) {
            $personne_id = $_SESSION['user']->getId();
            $results = ModelResidence::getResidencesByPersonne($personne_id);
            include 'config.php';
            $vue = $root . '/app/view/client/viewResidences.php';
            require($vue);
        } else {
            include 'config.php';
            $vue = $root . '/app/view/user/viewError.php';
            require($vue);
        }
    }
    
    public static function compteTransfert() {
        session_start();
        if ($_SESSION['user']->getStatut() == ModelPersonne::CLIENT) {
            $user_id = $_SESSION['user']->getId();
            $compte_count = ModelCompte::countUserAccounts($user_id);
            if ($compte_count < 2) {
                $results = "Vous devez avoir au moins deux comptes pour effectuer un transfert.";
                include 'config.php';
                $vue = $root . '/app/view/client/viewNonTransfert.php';
                require ($vue);
            } else {
                $comptes = ModelCompte::getComptesByPersonne($user_id);
                include 'config.php';
                $vue = $root . '/app/view/client/viewTransfert.php';
                require ($vue);
            }
        }
    }
    
    public static function compteTransfertAction() {
        $comptes = ModelCompte::getAll();
        $id_compte_i = htmlspecialchars($_GET['compte_i'], ENT_QUOTES, 'UTF-8');
        $montant = htmlspecialchars($_GET['montant'], ENT_QUOTES, 'UTF-8');
        $id_compte_f = htmlspecialchars($_GET['compte_f'], ENT_QUOTES, 'UTF-8');
        
        if (empty($montant)) {
            $results = "Le champ montant ne peut pas être vide.";
        } else {
            $results = ModelCompte::transfertCompte($id_compte_i, $montant, $id_compte_f);
        }
        
        include 'config.php';
        $vue = $root . '/app/view/client/viewTransfertAction.php';
        require ($vue);
    }
    
    public static function acheterResidence() {
        session_start();
        $user_id = $_SESSION['user']->getId();
        $residences = ModelResidence::getAllExceptOwner($user_id);
        include 'config.php';
        $vue = $root . '/app/view/client/viewAchatResidence.php';
        require ($vue);

    }
    public static function acheterResidenceAction() {
        session_start();
        $user_id = $_SESSION['user']->getId();
        $comptes=ModelCompte::getComptesByPersonne($user_id);
        $id_residence = htmlspecialchars($_GET['residence'], ENT_QUOTES, 'UTF-8');
        $residence=ModelResidence::getResidencesById($id_residence);
        $id_vendeur=$residence->getPersonneId();
        $prix=$residence->getPrix();
        $comptes_2=ModelCompte::getComptesByPersonne($id_vendeur);
        
        
        if (count($comptes) < 1) {
            $results = "Vous devez avoir au moins un compte pour acheter une résidence.";
            include 'config.php';
            $vue = $root . '/app/view/client/viewAchatResidence3.php';
            require ($vue);
            
        }
        
        elseif (count($comptes_2) < 1) {
            $results = "Le vendeur doit avoir au moins un compte pour vendre la résidence.";
            include 'config.php';
            $vue = $root . '/app/view/client/viewAchatResidence3.php';
            require ($vue);
        } else {
            include 'config.php';
            $vue = $root . '/app/view/client/viewAchatResidence2.php';
            require ($vue);
           
        }
        
        
        

    }
    public static function acheterResidenceAction2() {
        $acheteur_compte_id = htmlspecialchars($_GET['compte'], ENT_QUOTES, 'UTF-8');
        $vendeur_compte_id = htmlspecialchars($_GET['compte_2'], ENT_QUOTES, 'UTF-8');
        $prix = htmlspecialchars($_GET['prix_residence'], ENT_QUOTES, 'UTF-8');
        $residence_id = htmlspecialchars($_GET['residence_id'], ENT_QUOTES, 'UTF-8');
        $acheteur_id = htmlspecialchars($_GET['acheteur_id'], ENT_QUOTES, 'UTF-8');
        $vendeur_id  = htmlspecialchars($_GET['vendeur_id'], ENT_QUOTES, 'UTF-8');
        $results=ModelResidence::transfererProprieteEtFonds($residence_id, $acheteur_id, $vendeur_id, $prix, $acheteur_compte_id, $vendeur_compte_id);
        
        include 'config.php';
        $vue = $root . '/app/view/client/viewAchatResidence3.php';
        require ($vue);

    }
}
?>
