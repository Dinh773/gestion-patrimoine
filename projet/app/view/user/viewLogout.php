<!-- ----- début viewDeconnexion -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Détruire toutes les variables de session et terminer la session
session_unset();
session_destroy();
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>

    <h3>Vous avez été déconnecté avec succès.</h3>
    <p>Merci de votre visite.</p>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewDeconnexion -->
