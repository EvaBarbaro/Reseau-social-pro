<?php
require_once __DIR__ . '/networkNav.php';
?>

<?php
foreach($viewVars['publicationList'] as $pub){
?>
<div class="card  mt-3 offset-2" style="width: 45rem;">
<div class="card-header">
<?php
if(!empty($pub['comptePublication']['photo'])){
    $img =  pathUrl().'public/profilImages/'.$pub['comptePublication']['photo'];
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
    ?><img src="<?php echo  pathUrl().'public/publicationImages/'.$pub['publicationInfos']['imageurl'];?>" class="card-img-top" alt="Image introuvable">
    <?php

} 
?>
  <div class="card-body">
    <p class="card-text"><?php
    echo $pub['publicationInfos']['description'];
?></p>
  </div>
  <div class="card-footer">
  <p>
  <a class="btn btn-primary" data-toggle="collapse" href="#addComment" role="button" aria-expanded="false" aria-controls="collapseExample">
    Commenter
  </a>
  
</p>
<div class="collapse" id="addComment">
  <div class="card card-body">
   Formulaire pour commenter
  </div>
</div>
  </div>
</div>
<?php
foreach($pub['commentaires'] as $com){
?>
<div class="card  offset-2" style="width: 45rem;">
<div class="card-header">
<?php
if(!empty($com['commentaire_compte']['photo'])){
    $img =  pathUrl().'public/profilImages/'.$com['commentaire_compte']['photo'];
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
