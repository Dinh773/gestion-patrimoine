<?php
require_once '../model/ModelPersonne.php';
require_once '../model/ModelCompte.php';
require_once '../model/ModelResidence.php';

class ControllerAdministrateur {
    
    public static function adminDashboard() {
        session_start();
        if ($_SESSION['user']->getStatut() == ModelPersonne::ADMINISTRATEUR) {
            include 'config.php';
            $vue = $root . '/app/view/administrateur/viewDashboard.php';
            require($vue);
        } else {
            include 'config.php';
            $vue = $root . '/app/view/user/viewError.php';
            require($vue);
        }
    }

    public static function ClientAll() {
        $results = ModelPersonne::getAll();
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewClient.php';
        require($vue);
    }

    public static function AdminAll() {
        $results = ModelPersonne::getAllAdmin();
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewAdmin.php';
        require($vue);
    }

    public static function CompteAll() {
        $results = ModelCompte::getAll();
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewCompte.php';
        require($vue);
    }
    
    
    
    

    public static function ResidAll() {
        $results = ModelResidence::getAll();
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewResidence.php';
        require($vue);
    }

    
    public static function verifyLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $user = ModelPersonne::getUserByLoginPassword($login, $password);

            if ($user && $user->getStatut() == ModelPersonne::ADMINISTRATEUR) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['is_admin'] = true;
                header('Location: router1.php?action=adminDashboard');
            } elseif ($user && $user->getStatut() == ModelPersonne::CLIENT) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['is_admin'] = false;
                header('Location: router1.php?action=clientDashboard');
            } else {
                include 'config.php';
                $vue = $root . '/app/view/user/viewError.php';
                require($vue);
            }
        } else {
            header('Location: router1.php'); 
        }
    }

    // Méthode de déconnexion
    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
        include 'config.php';
        $vue = $root . '/app/view/user/viewLogout.php';
        require($vue);
    }

    public static function login() {
        include 'config.php';
        $vue = $root . '/app/view/user/viewLogin.php';
        require($vue);
    }
}
?>
