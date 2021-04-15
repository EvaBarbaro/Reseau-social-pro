<div id="networkHomePage">


<?php
require_once __DIR__ . '/networkNav.php';
?>


<div class="row">
<div class="col-lg-2 offset-lg-2">
  <!-- formulaire d'ajout publication -->
  
  <div class="card  rounded-0 mt-3" style="width: 45rem;">
<div class="card-header">
 <div class="pubHeader">
 Publier
 
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 
  <img name="statut" value="public" src="<?php echo pathUrl().'public/img/public.png';?>" class="card-img-top" alt="Image introuvable">
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" ><img type="button" id="public" src="<?php echo pathUrl().'public/img/public.png';?>" class="card-img-top drop" alt="Image introuvable"></a>
    <a class="dropdown-item" ><img type="button" id="amis" src="<?php echo pathUrl().'public/img/amis.png';?>" class="card-img-top drop" alt="Image introuvable"></a>
    
  </div>
  
</div>
</div> 
</div>

  <div class="card-body">
  <form id="formPub" name="AddPub" action="" enctype="multipart/form-data">
  <div class="form-group">
 
    <textarea name="description" class="form-control" id="validationTextarea" placeholder="Publier"></textarea>
  </div>
  <div class="form-group">
    <label for="pubImage">Ajouter une image</label>
    <input type="hidden" name="statut" value="public" id="statut" class="text-input"/>

    <input type="file" class="form-control-file" name="pubImage" id="pubImage">
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

//print_r($viewVars['publicationList']);
foreach($viewVars['publicationList'] as $pub){
  $i++;
?>

 
<div class="card  mt-3  rounded-0" style="width: 45rem;">
<div class="card-header">
<?php
if(!empty($pub['comptePublication']['photo'])){
    $img =  pathUrl().'public/profilImages/'.$pub['comptePublication']['photo'];
} else {
    $img = pathUrl().'public/img/profil.png';
}
?>
  <div class="pubHeader" ><img src="<?php echo $img;?>" class="card-img-top" alt="Image introuvable">
  <div class="user">
<?php

 echo $pub['comptePublication']['nomutilisateur'];
?>
  <small id="datePub" style="display:inline;" class="form-text font-weight-bold text-primary" ><?=$pub['publicationInfos']['date']?></small>

</div>
  <?php if($pub['publicationInfos']['statut']==="public") {
    $img ="public.png";
  } else {
    $img ="amis.png";
  } ?>
  <div class="visibilité">
  <img class="offset-11" src="<?php echo pathUrl().'public/img/'.$img;?>"> 
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
    ?><img src="<?php echo  pathUrl().'public/publicationImages/'.$pub['publicationInfos']['imageurl'];?>" class="card-img-top rounded-0" alt="Image introuvable">
    <?php

} 
?>
  <div class="card-body">
    <p class="card-text"><?php
    echo $pub['publicationInfos']['description'];
?></p>
  </div>
  <div class="card-footer footerComm">
  <p>

  <div id="likeUnlikePub_form">
<form name="likeUnlikePub<?=$i;?>" id="likeUnlikePub">
  <?php if($pub['publication_Liked_Par_Utilisateur']) {
    $img ="unlike.png";
  } else {
    $img ="like.png";
  } ?>
  <input type="hidden" name="idpublication" value="<?=$pub['publicationInfos']['idpublication']; ?>" class="text-input"/>

  <input type="image" id="<?=$img; ?>" name="likeUnlikePubButton" src="<?=pathUrl()."public/img/".$img;?>" class='card-img-top submitLike' alt='Image introuvable'>
  
  <?php echo $pub['publicationInfos']['Nombre Like']; ?>


  <a class="btn offset-10 buttonCom" data-toggle="collapse" href="#addComment<?php echo $i;?>" role="button" aria-expanded="false" aria-controls="collapseExample">
 
  <img id="comment" src="<?php echo pathUrl().'public/img/comment.png';?>" class="card-img-top imgComm" alt="Image introuvable">
  
  </a>

 <?=count($pub['commentaires'])?>

</form>
</div>

 
 
 
  
</p>
<div class="collapse" id="addComment<?php echo $i;?>">
  <div class="card card-body">
   <!-- Formulaire pour commenter-->
   <form name="AddCom<?=$i;?>" action="">
  <div class="form-group">
  <input type="hidden" name="idpublication" value="<?=$pub['publicationInfos']['idpublication']; ?>" class="text-input"/>
    <textarea class="form-control" name="description" id="validationTextarea" placeholder="Commenter"></textarea>
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
$tabCom = array_reverse($pub['commentaires'],true);
foreach($pub['commentaires'] as $com){
?>
<div class="card rounded-0" style="width: 45rem;">
<div class="card-header rounded-0" style="background-color:#7A92B1;">
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
  <small id="dateCom" style="display:inline;" class="form-text font-weight-bold" ><?= $com['commentaireInfo']['date']?></small>

  </div>
  </div>
  <div class="card-body" style="background-color:#B4C1D3;">
    <p class="card-text"><?php
    echo $com['commentaireInfo']['description'];
?></p>
  </div>
  <div class="card-footer rounded-0" style="background-color:#7A92B1;">
  <p>
  <div id="likeUnlikeCom_form">
<form name="likeUnlikeCom<?=$i;?>" action="">
  <?php if($com['commentaire_Liked_Par_Utilisateur']) {
    $img ="unlike.png";
  } else {
    $img ="like.png";
  } ?>
    <input type="hidden" name="idcommentaire" value="<?=$com['commentaireInfo']['idcommentaire']; ?>" class="text-input"/>
  <input type="image" id="<?=$img; ?>" name="likeUnlikeComButton" src="<?=pathUrl()."public/img/".$img;?>" class='card-img-top submitLike' alt='Image introuvable'>
  <?php echo $com['commentaireInfo']['Nombre Like']; ?>
</div>
</form>
</p>
  </div>
</div>


<?php
}
}?>
</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src=<?php echo pathUrl().'utils/scripts/homeNetwork.js' ?>></script>
