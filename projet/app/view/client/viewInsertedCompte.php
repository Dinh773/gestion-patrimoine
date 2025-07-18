<!-- ----- début viewInsertedCompte -->
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
     echo ("<h3>Le nouveau compte a été ajoutée </h3>");
     echo("<ul>");
     echo ("<li>Label = " . htmlspecialchars($_GET['label']) . "</li>");
     echo ("<li>Montant = " . htmlspecialchars($_GET['montant']) . "</li>");
    
     foreach ($banques as $banque) {
            if ($banque->getId()== $_GET['banque_id']){
                $banque_label=$banque->getLabel();
                echo ("<li>Banque = " . $banque_label . "</li>");
                break;
            }
        }
       
     
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion du compte</h3>");
     echo ("Label = " . htmlspecialchars($_GET['label']));
    }

    echo("</div>");
    ?> 
    <p/>
  </div>
     
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewInsertedCompte -->