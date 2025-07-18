<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      ?>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Label</th>
          <th scope="col">Montant</th>
          <th scope="col">Nom de la Banque</th>
          <th scope="col">Nom du Propriétaire</th>
          <th scope="col">Prénom du Propriétaire</th>
        </tr>
      </thead>
      <tbody>
          <?php
          foreach ($results as $element) {
            $banque = $element->getBanque();
            $proprietaire = $element->getProprietaire();
            printf("<tr><td>%s</td><td>%.2f</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
                   $element->getLabel(), $element->getMontant(), $banque->getLabel(), $proprietaire->getNom(), $proprietaire->getPrenom());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
