<!-- ----- début viewAll -->
<?php
require_once($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php include $root . '/app/view/fragment/fragmentMenu.php'; ?>
    <?php include $root . '/app/view/fragment/fragmentCaveJumbotron.html'; ?>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Label</th>
          <th scope="col">Ville</th>
          <th scope="col">Prix</th>
          <th scope="col">Propriétaire</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Affichage des résidences dans le tableau
        foreach ($results as $residence) {
          printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s %s</td></tr>", $residence->getLabel(), $residence->getVille(), $residence->getPrix(), $residence->getProprietaire()->getNom(), $residence->getProprietaire()->getPrenom());
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewAll -->
