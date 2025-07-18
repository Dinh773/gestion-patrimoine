<!-- ----- début viewInsertCompte -->
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
        <input type="hidden" name='action' value='compteCreer'>
        <label class='w-25' for="label">Label du compte : </label>
        <input type="text" name='label' size='75' value=''> <br/>
        
        <label class='w-25' for="montant">Montant : </label>
        <input type="text" step='any' name='montant' value=''> <br/>
        
        <label class='w-25' for="banque_id">Banque : </label>
        <select name='banque_id'>
          <?php
          foreach ($banques as $banque) {
            echo "<option value='{$banque->getId()}'>{$banque->getLabel()} - {$banque->getPays()}</option>";
          }
          ?>
        </select> <br/>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewInsertCompte -->

