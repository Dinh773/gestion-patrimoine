<!-- ----- début viewNonTransfert-->
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
        
      echo ("<h5>$results</h5>");
    }
   
    echo("</div>");
    ?> 
    
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
<!-- ----- fin viewNonTransfert-->