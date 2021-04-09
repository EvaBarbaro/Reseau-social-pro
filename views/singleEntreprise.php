<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<?php
require_once __DIR__ . '/networkNav.php';
?>
</div>
</div>
<div class="row">
<div class="col-lg-2 offset-lg-2">
  <!-- formulaire d'ajout publication -->
  
  <div class="card  mt-3" style="width: 45rem;">
<div class="card-header">
 <div class="pubHeader">
 Publier
 
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 
  <img  src="<?php echo pathUrl().'public/img/public.png';?>" class="card-img-top" alt="Image introuvable">
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" ><img type="button" id="public" src="<?php echo pathUrl().'public/img/public.png';?>" class="card-img-top" alt="Image introuvable"></a>
    <a class="dropdown-item" ><img type="button" id="amis" src="<?php echo pathUrl().'public/img/amis.png';?>" class="card-img-top" alt="Image introuvable"></a>
    
  </div>
</div>
</div> 
</div>

  <div class="card-body">
  <form>
  <div class="form-group">
 
    <textarea class="form-control" id="validationTextarea" placeholder="Publier"></textarea>
  </div>
  <div class="form-group">
    <label for="pubImage">Ajouter une image</label>
    <input type="file" class="form-control-file" id="pubImage">
  </div>
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Envoyer</button>
</div>
</form>
  </div>
  <div class="card-footer">
  <p>
 
  
</p>

  </div>
</div>
  <!-- formulaire d'ajout publication -->

<?php
$i=0;
foreach($viewVars['publicationList'] as $pub){
  $i++;
?>

 
<div class="card  mt-3" style="width: 45rem;">
<div class="card-header">
<?php
if(!empty($pub['comptePublication']['photo'])){
    $img =  pathUrl().'public/profilImages/'.$pub['comptePublication']['photo'];
} else {
    $img = pathUrl().'public/img/profil.png';
}
?>
  <div class="pubHeader" ><img src="<?php echo $img;?>" class="card-img-top" alt="Image introuvable">
<?php
 echo $pub['comptePublication']['nomutilisateur'];
?>
  <?php if($pub['publicationInfos']['statut']==="public") {
    $img ="public.png";
  } else {
    $img ="amis.png";
  } ?>
  <div class="visibilité">
  <img class="offset-9" src="<?php echo pathUrl().'public/img/'.$img;?>"> 
</div>
<!--
<div class="dropdown offset-8">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?php/* if($pub['publicationInfos']['statut']==="public") {
    $img ="public.png";
  } else {
    $img ="amis.png";
  } */?>
  <img src="<?php/* echo pathUrl().'public/img/'.$img;*/?>" class="card-img-top" alt="Image introuvable">
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#"><img src="<?php echo pathUrl().'public/img/public.png';?>" class="card-img-top" alt="Image introuvable"></a>
    <a class="dropdown-item" href="#"><img src="<?php echo pathUrl().'public/img/amis.png';?>" class="card-img-top" alt="Image introuvable"></a>
    
  </div>
</div>
-->
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
  <?php if($pub['publication_Liked_Par_Utilisateur']) {
    $img ="unlike.png";
  } else {
    $img ="like.png";
  } ?>
  <img src="<?php echo pathUrl().'public/img/'.$img;?>" class="card-img-top" alt="Image introuvable">
  <?php echo $pub['publicationInfos']['Nombre Like']; ?>
  <a class="btn offset-10" data-toggle="collapse" href="#addComment<?php echo $i;?>" role="button" aria-expanded="false" aria-controls="collapseExample">
  <img src="<?php echo pathUrl().'public/img/comment.png';?>" class="card-img-top" alt="Image introuvable">
  </a>
  
</p>
<div class="collapse" id="addComment<?php echo $i;?>">
  <div class="card card-body">
   <!-- Formulaire pour commenter-->
   <form>
  <div class="form-group">
 
    <textarea class="form-control" id="validationTextarea" placeholder="Commenter"></textarea>
  </div>
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Envoyer</button>
</div>
</form>
<!-- Formulaire pour commenter-->
  </div>
</div>
  </div>
</div>
<?php
foreach($pub['commentaires'] as $com){
?>
<div class="card" style="width: 45rem;">
<div class="card-header">
<?php
if(!empty($com['commentaire_compte']['photo'])){
    $img =  pathUrl().'public/profilImages/'.$com['commentaire_compte']['photo'];
} else {
    $img = pathUrl().'public/img/profil.png';
}
?>
  <div class="pubHeader" ><img src="<?php echo $img;?>" class="card-img-top" alt="Image introuvable">
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
  <p>
  <?php if($com['commentaire_Liked_Par_Utilisateur']) {
    $img ="unlike.png";
  } else {
    $img ="like.png";
  } ?>
  <img src="<?php echo pathUrl().'public/img/'.$img;?>" class="card-img-top" alt="Image introuvable">
  <?php echo $com['commentaireInfo']['Nombre Like']; ?>
</p>
  </div>
</div>


<?php
}
}?>
</div>
</div>
</div>