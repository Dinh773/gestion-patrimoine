<!-- ----- début mesPropositions -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
        ?>

        <h3>Améliorations proposées</h3>
        
        <h5>  Mieux gérer les erreurs :</h5>
        <p>
        Pour le transfert inter-compte et l'achat de nouvelles résidences, nous avons introduit une fonctionnalité avancée de gestion des erreurs qui comprend les vérifications suivantes :
        </p>
        <p>
        Vérification du solde du compte :
        </p>
        <ul>
            <li>Avant d'effectuer un transfert d'argent d'un compte à un autre, le système vérifie si le solde du compte de l'expéditeur est suffisant pour couvrir le montant du transfert. Si le solde est insuffisant, la transaction est annulée et un message d'erreur approprié est affiché à l'utilisateur.</li>
            <li>De même, lors de l'achat d'une nouvelle résidence, le système vérifie si l'acheteur dispose de fonds suffisants sur son compte bancaire pour couvrir le prix de la résidence. Si le solde est insuffisant, l'achat est annulé et un message d'erreur est affiché.</li>
        </ul>

        
    </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin mesPropositions -->