<!-- viewErrorMontant.php -->
<?php
require_once '../../app/view/fragment/fragmentCaveHeader.html';
?>

<body>
    <div class="container">
        <?php include '../../app/view/fragment/fragmentMenu.php'; ?>
        <div class="jumbotron">
            <h1>Erreur</h1>
            <p>Le montant spécifié est invalide. Veuillez spécifier un montant positif pour créer un compte.</p>
        </div>
    </div>
    <?php include '../../app/view/fragment/fragmentCaveFooter.html'; ?>
</body>
