<!-- ----- début fragmentCaveMenu -->

<nav class="navbar navbar-expand-lg bg-warning fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=CaveAccueil">
      GINESTE DINH
      <?php
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user'];
          $statut = $user->getStatut() == ModelPersonne::ADMINISTRATEUR ? "Administrateur" : "Client";
          $nom = $user->getNom();
          $prenom = $user->getPrenom();
          echo " | $statut | $nom $prenom";
        } else {
          echo " ||";
        }
      ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if (isset($_SESSION['user']) && $user->getStatut() == ModelPersonne::ADMINISTRATEUR) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">BANQUE</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=banqueReadAll">Liste des banques</a></li>
              <li><a class="dropdown-item" href="router1.php?action=banqueCreate">Insertion d'une banque</a></li>
              <li><a class="dropdown-item" href="router1.php?action=banqueList">Listes des comptes d'une banque</a></li> 
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">CLIENTS</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=ClientAll">Liste des clients</a></li>
              <li><a class="dropdown-item" href="router1.php?action=AdminAll">Listes des Administrateurs</a></li>
              <li><a class="dropdown-item" href="router1.php?action=CompteAll">Liste des comptes</a></li>
              <li><a class="dropdown-item" href="router1.php?action=ResidAll">Liste des résidences</a></li> 
            </ul>
          </li>
        <?php } ?>

        <?php if (isset($_SESSION['user']) && $user->getStatut() == ModelPersonne::CLIENT) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">MES COMPTES</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=viewComptes">Liste de mes comptes</a></li>
              <li><a class="dropdown-item" href="router1.php?action=compteCreate">Ajouter un compte</a></li>
              <li><a class="dropdown-item" href="router1.php?action=compteTransfert">Transfert inter-comptes</a></li> 
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">MES RESIDENCES</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=viewResidences">Liste de mes résidences</a></li>
              <li><a class="dropdown-item" href="router1.php?action=acheterResidence">Achat d'une nouvelle résidence</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">MON PATRIMOINE</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=Patrimoine">Bilan de mon patrimoine</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if (isset($_SESSION['user'])) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">INNOVATION</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=mesPropositions">Proposition d'amélioration</a></li>
              <li><a class="dropdown-item" href="router1.php?action=classementRiche">Classement des plus riches</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONNEXION</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=logout">Déconnexion</a></li> 
            </ul>
          </li>
        <?php } else { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">INNOVATION</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=mesPropositions">Proposition d'amélioration</a></li>
              <li><a class="dropdown-item" href="router1.php?action=classementRiche">Classement des plus riches</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONNEXION</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="router1.php?action=login">Login</a></li>
              <li><a class="dropdown-item" href="router1.php?action=clientEnregistre">S'inscrire</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav> 

<!-- ----- fin fragmentCaveMenu -->
