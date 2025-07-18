<?php require ($root . '/app/view/fragment/fragmentCaveHeader.html'); ?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      ?>

    <?php
    if (isset($results) && $results !== false) {
        echo "<h3>Le client a été inscrit avec succès.</h3>";
    } else {
        echo "<h3>Problème lors de l'inscription du client.</h3>";
    }
    ?>

  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
