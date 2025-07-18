<!-- ----- début viewPropose -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='banqueComptes'>
        <label for="id">Sélectionnez une banque :</label>
        <select class="form-control" id='id' name='id' style="width: 300px">
          <?php
          foreach ($results as $element) {
            printf("<option value='%d'>%s</option>", $element->getId(), $element->getLabel());
          }
          ?>
        </select>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Voir les comptes</button>
    </form>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewPropose -->


