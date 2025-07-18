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
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Login</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Récupération de la liste des personnes
        
        // Affichage des personnes dans le tableau
        foreach ($results as $personne) {
          printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $personne->getNom(), $personne->getPrenom(), $personne->getLogin());
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewAll -->
