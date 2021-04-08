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
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>
  
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
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
