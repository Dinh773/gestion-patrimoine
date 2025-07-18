<!-- ----- début viewComptes -->
<?php
require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
        ?>

        <h2>Liste des comptes</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Label</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Banque</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $compte) {
                    $banque = ModelBanque::getBankById($compte->getBanqueId());
                    printf("<tr><td>%s</td><td>%.2f</td><td>%s</td></tr>", 
                           $compte->getLabel(), 
                           $compte->getMontant(), 
                           $banque->getLabel());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewComptes -->
