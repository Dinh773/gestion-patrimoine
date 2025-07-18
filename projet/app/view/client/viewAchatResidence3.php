<!-- ----- début viewAchatResidence3-->
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
            echo ("<h3>Achat effectué avec succes ! </h>");

            
     
    } else {
      echo("<h5>Erreur ! </h>");
      
      echo ("<h5>$results</h5>");
    }
    }
    echo("</div>");
    ?> 
    
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewAchatResidence3 -->