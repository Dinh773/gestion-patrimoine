<?php
require_once '../model/ModelBanque.php';

class ControllerBanque {
    public static function banqueReadAll() {
        $results = ModelBanque::getAll();
        include 'config.php';
        $vue = $root . '/app/view/banque/viewAll.php';
        require ($vue);
    }

    public static function banqueReadId() {
        $results = ModelBanque::getAllId();
        include 'config.php';
        $vue = $root . '/app/view/banque/viewId.php';
        require ($vue);
    }

    public static function banqueReadOne() {
        $banque_id = $_GET['id'];
        $results = ModelBanque::getOne($banque_id);
        include 'config.php';
        $vue = $root . '/app/view/banque/viewAll.php';
        require ($vue);
    }

    public static function banqueCreate() {
        include 'config.php';
        $vue = $root . '/app/view/banque/viewInsert.php';
        require ($vue);
    }

    public static function banqueCreated() {
    $label = htmlspecialchars($_GET['label']);
    $pays = htmlspecialchars($_GET['pays']);
    
    $result = ModelBanque::insert($label, $pays);
    
    if ($result == -1) {
        include 'config.php';
        $vue = $root . '/app/view/banque/viewErreur.php';
        require ($vue);
    } else {
        include 'config.php';
        $vue = $root . '/app/view/banque/viewInserted.php';
        require ($vue);
    }
}


    public static function banqueList() {
        $results = ModelBanque::getAll();
        include 'config.php';
        $vue = $root . '/app/view/banque/viewList.php';
        require ($vue);
    }

    public static function banqueComptes() {
        $banque_id = $_GET['id'];
        $results = ModelBanque::getByBanque($banque_id);
        include 'config.php';
        $vue = $root . '/app/view/banque/v.php';
        require ($vue);
    }
    
    
}
?>
