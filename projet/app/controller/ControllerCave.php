<?php


class ControllerCave {
    
    public static function caveAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewCaveAccueil.php';
        if (DEBUG) {
            echo ("ControllerCave : caveAccueil : vue = $vue");
        }
        require($vue);
    }

    
    public static function mesPropositions() {
        include 'config.php';
        $vue = $root . '/app/view/proposition/viewPropositions.php';
       
        require($vue);
    }
    
    public static function classementRiche() {
        $personnes = ModelPersonne::getAll();

        
        $patrimoines_personnes = [];

        foreach ($personnes as $personne) {
            
            $results = ModelCompte::getComptesByPersonne($personne->getId());
            $resid = ModelResidence::getResidencesByPersonne($personne->getId());

            
            $patrimoine_personne = ModelPersonne::calculerPatrimoinePersonne($results, $resid);
            $patrimoine_personne['personne'] = $personne; 

            
            $patrimoines_personnes[] = $patrimoine_personne;
        }

        
        usort($patrimoines_personnes, function($a, $b) {
            return $b['totalPatrimoine'] - $a['totalPatrimoine'];
        });
 
        include 'config.php';
        $vue = $root . '/app/view/proposition/viewClassement.php';
        require ($vue);
    }
}
?>


