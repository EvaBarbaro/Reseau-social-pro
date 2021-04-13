<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <a class="navbar-brand" href="<?php echo pathUrl().'monReseau/'.$_SESSION['identreprise']?>"><img src= <?= pathUrl().'public/logoImages/'.$_SESSION['logo'] ?> class="rounded-circle" width="70px"></a>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item home">
        <a class="nav-link" href="<?php echo pathUrl().'monReseau/'.$_SESSION['identreprise']?>">Accueil</a>
      </li>
      <li class="nav-item profil">
        <a class="nav-link"  href="<?php echo pathUrl().'monCompte/'.$_SESSION['idutilisateur']?>">Profil</a>
      </li>
      <form method="POST">
        <input type="hidden" name="identreprise" id="identreprise" value=<?= $_SESSION['identreprise'] ?>>
        <input type="submit" name="logout" class="btn btn-info" value="Déconnexion">
      </form>
    </ul>
  </div>
</nav>