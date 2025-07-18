<!-- ----- début viewLogin -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>

    <form role="form" method='post' action='router1.php?action=verifyLogin'>
      <div class="form-group">
        <label for="login">Login : </label><input type="text" name='login' size='20'> <br/>
        <label for="password">Password : </label><input type="password" name='password' size='20'> <br/>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Login</button>
    </form>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewLogin -->


