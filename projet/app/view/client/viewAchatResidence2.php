<!-- ----- début viewAchatResidence2-->
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
        <input type="hidden" name='action' value='acheterResidenceAction2'>
        
        <?php
        echo("<input type='hidden' name='residence_id' value=$id_residence>");
        echo("<input type='hidden' name='acheteur_id' value=$user_id>");
        echo("<input type='hidden' name='vendeur_id' value=$id_vendeur>");
        echo("<input type='hidden' name='prix_residence' value=$prix>");
       
        ?>
                
        <label class='w-25' for="compte">Sélectionnez un compte de l'acheteur : </label>
        <select name='compte'>
          <?php
          foreach ($comptes as $compte) {
            echo "<option value='{$compte->getId()}'>{$compte->getLabel()}</option>";
          }
          ?>
        </select> <br/>
        
        <label class='w-25' for="compte_2">Sélectionnez un compte du vendeur : </label>
        <select name='compte_2'>
          <?php
          foreach ($comptes_2 as $compte_2) {
            echo "<option value='{$compte_2->getId()}'>{$compte_2->getLabel()}</option>";
          }
          ?>
        </select> <br/>
        <?php
            echo("<label class='w-25' for='prix'>Prix : </label>");
            echo("<input type='number' name='prix' value=$prix disabled='disabled'> <br/>");
        ?>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">VALIDER</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewAchatResidence2 -->