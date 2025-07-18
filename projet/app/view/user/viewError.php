<!-- ----- début viewError -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>

    <h3>Login ou mot de passe incorrect. Veuillez réessayer.</h3>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewError -->
