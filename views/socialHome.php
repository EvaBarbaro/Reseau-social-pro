<?php
require_once __DIR__ . '/networkNav.php';
foreach($viewVars['publicationList'] as $pub){
?>
<div class="card  mt-3" style="width: 30rem;">
<div class="card-header">
<?php
if(!empty($pub['comptePublication']['photo'])){
    $img = 'public/profilImages/'.$pub['comptePublication']['photo'];
} else {
    $img = pathUrl().'public/img/profil.png';
}
?>
  <div class="user" ><img src="<?php echo $img;?>" class="card-img-top" alt="Image introuvable">
<?php
 echo $pub['comptePublication']['nomutilisateur'];
?>
  </div>
</div>
<?php
if(!empty($pub['publicationInfos']['imageurl'])){
    ?><img src="<?php echo 'public/publicationImages/'.$pub['publicationInfos']['imageurl'];?>" class="card-img-top" alt="Image introuvable">
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
<div class="card" style="width: 30rem;">
<div class="card-header">
<?php
if(!empty($com['commentaire_compte']['photo'])){
    $img = 'public/profilImages/'.$com['commentaire_compte']['photo'];
} else {
    $img = pathUrl().'public/img/profil.png';
}
?>
  <div class="user" ><img src="<?php echo $img;?>" class="card-img-top" alt="Image introuvable">
<?php
 echo $com['commentaire_compte']['nomutilisateur'];
?>
  </div>
  </div>
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
