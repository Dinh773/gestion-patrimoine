<!-- app/view/client/viewEnregistre.php -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      ?>

    <form role="form" method='post' action='router1.php?action=clientEnregistremsg'>
      <div class="form-group">
        <label for="nom">Nom : </label><input type="text" name='nom' class="form-control" required>
      </div>
      <div class="form-group">
        <label for="prenom">Prénom : </label><input type="text" name='prenom' class="form-control" required>
      </div>
      <div class="form-group">
        <label for="login">Login : </label><input type="text" name='login' class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe : </label><input type="password" name='password' class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
