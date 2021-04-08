<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <a class="navbar-brand" href="<?php echo pathUrl().'monReseau/'.$_SESSION['identreprise']?>">LOGO ENTREPRISE</a>
 
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item home">
        <a class="nav-link" href="<?php echo pathUrl().'monReseau/'.$_SESSION['identreprise']?>">Accueil</a>
      </li>
      <li class="nav-item profil">
        <a class="nav-link"  href="<?php echo pathUrl().'monCompte/'.$_SESSION['idutilisateur']?>">Profil</a>
      </li>
      
    </ul>
  </div>
</nav>