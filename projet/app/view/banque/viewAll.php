<!-- ----- début viewAll -->
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
          <th scope="col">Pays</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des banques est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%s</td><td>%s</td></tr>", $element->getLabel(), $element->getPays());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewAll -->
