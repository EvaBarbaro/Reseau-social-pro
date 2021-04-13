<div>
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class="nav-link account" href="<?= pathUrl().'monCompte/'.$_SESSION['idutilisateur']?>">Mon Compte</a>
  </li>
  <li class="nav-item">
    <a class="nav-link infos" href="<?= pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/mesInformations'?>">Mes informations</a>
  </li>
  <li class="nav-item">
    <a class="nav-link album" href="<?= pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/mesImages'?>">Mon Album</a>
  </li>
  <li class="nav-item">
    <a class="nav-link password" href="<?= pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/monMotDePasse'?>">Modifier mon mot de passe</a>
  </li>
  <li class="nav-item">
<<<<<<< HEAD
    <a class="nav-link users" href="<?= pathUrl().'monReseau/'.$_SESSION['identreprise'].'/admin'?>">Gérer les utilisateurs</a>
=======
    <a class="nav-link password" href="<?= pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/MonMur'?>">Aspect de mon mur</a>
>>>>>>> 0d8f38d215e9778efee9f5fd08bc4871e3bed4bd
  </li>
</ul>
</div>