<!-- ----- début viewPatrimoine -->
<?php
require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
        ?>

        <h2>Liste des Patrimoines</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalGlobal = 0;

                // Fusion des comptes et résidences en une seule liste avec type
                $patrimoines = [];

                foreach ($results as $compte) {
                    $banque = ModelBanque::getBankById($compte->getBanqueId());
                    $patrimoines[] = [
                        'type' => 'Compte',
                        'label' => $compte->getLabel(),
                        'prix' => $compte->getMontant()
                    ];
                }

                foreach ($resid as $residence) {
                    $patrimoines[] = [
                        'type' => 'Résidence',
                        'label' => $residence->getLabel(),
                        'prix' => $residence->getPrix()
                    ];
                }

                // Affichage des lignes avec calcul du total global
                foreach ($patrimoines as $patrimoine) {
                    $totalGlobal += $patrimoine['prix'];
                    $rowClass = ($patrimoine['type'] == 'Compte') ? 'table-primary' : 'table-secondary';
                    printf("<tr class='%s'><td>%s</td><td>%s</td><td>%.2f</td><td>%.2f</td></tr>", 
                           $rowClass,
                           htmlspecialchars($patrimoine['type']),
                           htmlspecialchars($patrimoine['label']),
                           $patrimoine['prix'],
                           $totalGlobal);
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewPatrimoine -->
