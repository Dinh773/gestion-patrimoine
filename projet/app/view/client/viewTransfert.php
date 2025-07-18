<!-- ----- début viewTransfert-->
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
        <input type="hidden" name='action' value='compteTransfertAction'>
        
        <label class='w-25' for="compte_i">Depuis quel compte : </label>
        <select name='compte_i'>
          <?php
          foreach ($comptes as $compte) {
            echo "<option value='{$compte->getId()}'>{$compte->getLabel()} - Soldes: {$compte->getMontant()}</option>";
          }
          ?>
        </select> <br/>
        
        <label class='w-25' for="montant">Montant : </label>
        <input type="number" step='any' name='montant' value=''> <br/>
        
        <label class='w-25' for="compte_f">Vers quel compte : </label>
        <select name='compte_f'>
          <?php
          foreach ($comptes as $compte) {
            echo "<option value='{$compte->getId()}'>{$compte->getLabel()} - Soldes: {$compte->getMontant()}</option>";
          }
          ?>
        </select> <br/>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">VALIDER</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewTransfert -->

