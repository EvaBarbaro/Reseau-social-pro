<?php

if (!empty($viewVars['compte']['idcompte'])) {
  $idcompte = $viewVars['compte']['idcompte'];
} else {
  $idcompte = $_SESSION['idutilisateur'];
}

?>
<div>
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class="nav-link post" href="<?= pathUrl().'monCompte/'.$idcompte.'/mesPublications'?>">Mes publications</a>
  </li>
  <?php
    if ($_SESSION['idutilisateur'] === $idcompte) {
  ?>
  <li class="nav-item">
    <a class="nav-link account" href="<?= pathUrl().'monCompte/'.$idcompte?>">Mon Compte</a>
  </li>
  <li class="nav-item">
    <a class="nav-link infos" href="<?= pathUrl().'monCompte/'.$idcompte.'/mesInformations'?>">Mes informations</a>
  </li>
  <?php
    }
  ?>
  <?php
    if ($_SESSION['idutilisateur'] === $idcompte) {
  ?>
  <li class="nav-item">
    <a class="nav-link album" href="<?= pathUrl().'monCompte/'.$idcompte.'/mesImages'?>">Mon Album</a>
  </li>
  <?php
    } else {
  ?>
  <?php
    for ($index = 0; $index < count($viewVars['amis']); $index++) {
      if ((isset($_SESSION['url']) && in_array($_SESSION['url'], $viewVars['amis'][$index]))) {
  ?>
  <li class="nav-item">
    <a class="nav-link album" href="<?= pathUrl().'monCompte/'.$idcompte.'/mesImages'?>">Mon Album</a>
  </li>
  <?php
        }
      }
    }
  ?>
  <?php
    if ($_SESSION['idutilisateur'] === $idcompte) {
  ?>
  <li class="nav-item">
    <a class="nav-link password" href="<?= pathUrl().'monCompte/'.$idcompte.'/monMotDePasse'?>">Modifier mon mot de passe</a>
  </li>
  <?php
    }
  ?>
    <?php
    if ($_SESSION['role'] === 'admin') {
  ?>
  <li class="nav-item">
    <a class="nav-link users" href="<?= pathUrl().'monReseau/'.$_SESSION['identreprise'].'/admin'?>">Gérer les utilisateurs</a>
  </li>
  <?php
    }
  ?>
  <?php
    if ($_SESSION['idutilisateur'] === $idcompte) {
  ?>
  <li class="nav-item">
  <a class="nav-link friend" href="<?= pathUrl().'monCompte/'.$idcompte.'/mesAmis' ?>">Mes amis</a>
  </li>
  <?php
    }
  ?>
  </li>
</ul>
</div>