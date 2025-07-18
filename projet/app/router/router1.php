<?php


require ('../controller/ControllerCave.php');
require ('../controller/ControllerBanque.php');

require ('../controller/ControllerAdministrateur.php');
require ('../controller/ControllerClient.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);


switch ($action) {
    
    case "banqueReadAll" :
    case "banqueReadOne" :
    case "banqueReadId" :
    case "banqueCreate" :
    case "banqueCreated" :
    case "banquePropose" :
    case "banqueComptes":
    case "banqueList":
    
        ControllerBanque::$action();
        break;
    // Routes du quatrième contrôleur (ControllerUser)
    
    // Routes du contrôleur administrateur (ControllerAdministrateur)
    case "adminDashboard" :
    case "ClientAll":
    case "AdminAll" :
    case "CompteAll":
    case "ResidAll":
    case "logout":
    case "login" :
    case "verifyLogin":
        ControllerAdministrateur::$action();
        break;
    // Routes du contrôleur client (ControllerClient)
    case "clientDashboard" :
    case "viewComptes" :
    case "clientEnregistre":
    case "clientEnregistremsg":
    case "verifyLogin":
    case "compteCreate":
    case "compteCreer":
    case "viewResidences":
    case "compteTransfert":
    case "compteTransfertAction":
    case "Patrimoine":
    case "acheterResidence":
    case "acheterResidenceAction":
    case "acheterResidenceAction2":
        
        
        
        ControllerClient::$action();
        break;
    
    case "mesPropositions":
    case "classementRiche":
        ControllerCave::$action();
        break;
    // Tache par défaut
    default:
        $action = "caveAccueil";
        ControllerCave::$action();
        break;
}
?>
