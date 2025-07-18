<!-- ----- début viewClassement -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
        ?>

        <h3>Classement des personnes par patrimoine</h3>

        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Classement</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Patrimoine total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patrimoines_personnes as $index => $patrimoine_personne) : ?>
                    <?php
                    $personne = $patrimoine_personne['personne'];
                    $totalPatrimoine = $patrimoine_personne['totalPatrimoine'];
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($personne->getNom()); ?></td>
                        <td><?php echo htmlspecialchars($personne->getPrenom()); ?></td>
                        <td><?php echo number_format($totalPatrimoine, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewClassement -->