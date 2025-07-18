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
          <th scope="col">Montant</th>
          <th scope="col">Banque</th>
          <th scope="col">Propriétaire</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Récupération de la liste des comptes

        // Affichage des comptes dans le tableau
        foreach ($results as $compte) {
          $banque = $compte->getBanque();
          $proprietaire = $compte->getProprietaire();
          printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s %s</td></tr>",
            $compte->getLabel(),
            $compte->getMontant(),
            $banque ? $banque->getLabel() : "N/A",
            $proprietaire ? $proprietaire->getNom() : "N/A",
            $proprietaire ? $proprietaire->getPrenom() : "N/A"
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewAll -->
