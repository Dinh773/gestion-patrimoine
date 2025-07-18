<!-- ----- début viewAchatResidence-->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?> 
    <h3>Sélection d'une résidence pour un achat</h3>  
    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='acheterResidenceAction'>
        
        <label class='w-25' for="residence">Sélectionnez une résidence : </label>
        <select name='residence'>
          <?php
          foreach ($residences as $residence) {
            echo "<option value='{$residence->getId()}'>{$residence->getLabel()}</option>";
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
<!-- ----- fin viewAchatResidence -->
