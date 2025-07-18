<!-- ----- début viewTransfertAction-->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?> 
    <?php
    if ($results) {
        if ($results ==1){
            echo ("<h3>Transfert effectué avec succes ! </h>");

            foreach ($comptes as $compte) {
                   if ($id_compte_i==$compte->getId()){
                       $label_compte_i=$compte->getLabel();
                   }
                 }
            foreach ($comptes as $compte) {
                   if ($id_compte_f==$compte->getId()){
                       $label_compte_f=$compte->getLabel();
                   }
                 }

            echo ("<h5>Le montant de $montant a été envoyé depuis le compte $label_compte_i vers le compte $label_compte_f </h>");
     
    } else {
      echo("<h5>Erreur de transaction ! la transaction a été annulée !</h>");
      
      echo ("<h5>$results</h5>");
    }
    }
    echo("</div>");
    ?> 
    
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewTransfertAction -->

