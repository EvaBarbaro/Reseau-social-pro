
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <a class="navbar-brand" href="#">LOGO</a>
 
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo pathUrl().'socialHome'?>">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="<?php echo pathUrl().'mesImages'?>">Profil</a>
      </li>
      
    </ul>
  </div>
</nav>
<?php
foreach($viewVars['publicationList'] as $pub){
?>
<div class="card  mt-3" style="width: 18rem;">
<div class="card-header">
<?php
 echo $pub['comptePublication']['nomutilisateur'];
?>
  </div>
<?php
if(!empty($pub['comptePublication']['photo'])){
?>
  <img src="..." class="card-img-top" alt="Image introuvable">
  <?php
}
  ?>
  
  <div class="card-body">
    <p class="card-text"><?php
    echo $pub['publicationInfos']['description'];
?></p>
  </div>
  <div class="card-footer">
    Card footer
  </div>
</div>
<?php
foreach($pub['commentaires'] as $com){
?>
<div class="card" style="width: 18rem;">
<div class="card-header">
<?php
 echo "commentateur ".$com['commentaire_compte']['nomutilisateur'];
?>
  </div>
<?php
if(!empty($com['commentaire_compte']['photo'])){
?>
  <img src="..." class="card-img-top" alt="Image introuvable">
  <?php
}
  ?>
  
  <div class="card-body">
    <p class="card-text"><?php
    echo $com['commentaireInfo']['description'];
?></p>
  </div>
  <div class="card-footer">
    Card footer
  </div>
</div>
<?php
}
}?>