<!-- ----- début viewResidences-->
<?php
require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
        ?>

        <h2>Liste de mes résidences</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Label</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $residence) {
                    printf("<tr><td>%s</td><td>%s</td><td>%.2f</td></tr>", 
                           $residence->getLabel(), 
                           $residence->getVille(), 
                           $residence->getPrix());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewResidences -->