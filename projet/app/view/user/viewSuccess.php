<!-- ----- début viewSuccess -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';

    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        echo "<h3>Bienvenue, " . htmlspecialchars($user->getPrenom() . " " . $user->getNom()) . "!</h3>";

        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
            echo "<p>Vous êtes connecté en tant qu'administrateur.</p>";
        } else {
            echo "<p>Vous êtes connecté en tant qu'utilisateur.</p>";
        }
    } else {
        echo "<h3>Erreur: Utilisateur non connecté.</h3>";
    }
    ?>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewSuccess -->
