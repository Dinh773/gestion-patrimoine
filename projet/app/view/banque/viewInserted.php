<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($result) {
     echo ("<h3>La nouvelle banque a été ajoutée </h3>");
     echo("<ul>");
     echo ("<li>Label = " . htmlspecialchars($_GET['label']) . "</li>");
     echo ("<li>Pays = " . htmlspecialchars($_GET['pays']) . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la Banque</h3>");
     echo ("Label = " . htmlspecialchars($_GET['label']));
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
<!-- ----- fin viewInserted -->  
