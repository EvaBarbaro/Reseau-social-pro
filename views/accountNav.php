<div>
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class="nav-link post" href="<?= pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/mesPublications'?>">Mes publications</a>
  </li>
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
    <a class="nav-link users" href="<?= pathUrl().'monReseau/'.$_SESSION['identreprise'].'/admin'?>">Gérer les utilisateurs</a>
  </li>
</ul>
</div>