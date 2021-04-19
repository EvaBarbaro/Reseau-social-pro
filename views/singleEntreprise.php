<?php
require_once __DIR__ . '/networkNav.php';
?>

<div class="row">
<div class="col-lg-4">
<?php

require_once __DIR__ . '/asideMember.php';

?>
</div>
<div class="col-lg-2">
 
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
  <form id="formPub" name="AddPub"  enctype="multipart/form-data">
  <div class="form-group">
 
    <textarea name="description" class="form-control" id="validationTextarea" placeholder="Publier"></textarea>
  </div>
  <div class="form-group">
    <label for="pubMedia">Ajouter une image/video/fichier</label>
    <input type="hidden" name="statut" value="public" id="statut" class="text-input"/>

    <input type="file" class="form-control-file" name="pubMedia" id="pubMedia">
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
  <!-- Bouton pour recharger les publications -->
  <img name="reset"  id="reset" style="width:4em;cursor: pointer;margin-left:20em;" src="<?php echo pathUrl().'public/img/reset.png';?>" class="card-img-top mt-4" alt="Image introuvable">
 <!-- Filtre visibilité -->
 <div class="btn-group mt-4">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Visiblité
  </button>
  <div class="dropdown-menu">
    <a id="allPubs" style="cursor: pointer;" class="dropdown-item">Toutes les publications</a>
    <a id="publicPubs" style="cursor: pointer;" class="dropdown-item">Public</a>
    <a id="amisPubs" style="cursor: pointer;" class="dropdown-item">Amis</a>
  
  </div>
</div>
  <!-- Trie selon dates ou likes -->
<div class="btn-group mt-4">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Trier
  </button>
  <div class="dropdown-menu">
    <a id="datePubs" style="cursor: pointer;" class="dropdown-item">Date de publication</a>
    <a id="likePubs" style="cursor: pointer;" class="dropdown-item">Popularité</a> 
  </div>
</div>
<div id="Pub">
<div id="loadPub">
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
  <img class="offset-11" src="<?php echo pathUrl().'public/img/'.$img;?>" > 
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
else if(!empty($pub['publicationInfos']['videourl'])){
  ?>

 <video width="720" height="640" controls>
  <source src=<?=pathUrl().'public/publicationVideos/'.$pub['publicationInfos']['videourl']?> type="video/mp4">

  Your browser does not support the video tag.
</video> 
<?php  }
else if(!empty($pub['publicationInfos']['fichierurl'])){
  ?>
<div>
    <object data="<?=pathUrl().'public/publicationFichiers/'.$pub['publicationInfos']['fichierurl']?>" type="application/pdf" width="720" height="640">
       
    </object>
</div>
<?php  }
?>
  <div class="card-body">
 

    <p class="card-text">
   
<?php
    echo $pub['publicationInfos']['description'];
?></p>
  </div>
  <div class="card-footer footerComm">
  <p>

  <div id="likeUnlikePub_form">

<form name="likeUnlikePub<?=$i;?>" id="likeUnlikePub" >
  <?php if($pub['publication_Liked_Par_Utilisateur']) {
    $img ="unlike.png";
  } else {
    $img ="like.png";
  } ?>
  <input type="hidden" name="idpublication" id="idpublication" value="<?=$pub['publicationInfos']['idpublication']; ?>" class="text-input"/>
  <span id="LikePub">
  <span id="loadLikePub<?=$pub['publicationInfos']['idpublication']?>">
  <input type="image" id="<?=$img; ?>" name="likeUnlikePubButton" src="<?=pathUrl()."public/img/".$img;?>" class='card-img-top submitLike' alt='Image introuvable'>
  
  <?php echo $pub['publicationInfos']['Nombre Like']; ?>
  </span>
  </span>

  <a class="btn offset-10 buttonCom" data-toggle="collapse" href="#addComment<?php echo $i;?>" role="button" aria-expanded="false" aria-controls="collapseExample">
 
  <img id="comment" src="<?php echo pathUrl().'public/img/comment.png';?>" class="card-img-top imgComm" alt="Image introuvable">
  
  </a>
  <span id="ComPub<?=$pub['publicationInfos']['idpublication']?>">
  <span id="loadComPub<?=$pub['publicationInfos']['idpublication']?>">
 <?=count($pub['commentaires'])?>
</span>
</span>
</form>
</div>

 
 
 
  
</p>
<div class="collapse" id="addComment<?php echo $i;?>">
  <div class="card card-body">
    <!-- Formulaire pour commenter-->
        <form name="AddCom<?=$i;?>" >
          <div class="form-group">
            <input type="hidden" name="idpublication" id="idpublication" value="<?=$pub['publicationInfos']['idpublication']; ?>" class="text-input"/>
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
<span id="ComsPub<?=$pub['publicationInfos']['idpublication']?>">
<span id="loadComsPub<?=$pub['publicationInfos']['idpublication']?>">
<?php
$j=0;
foreach($pub['commentaires'] as $com){
$j++;
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
  <div class="user">
<?php
 echo $com['commentaire_compte']['nomutilisateur'];
?>
  <small id="dateCom" style="display:inline;" class="form-text font-weight-bold" ><?= $com['commentaireInfo']['date']?></small>
  </div>
  <?php if($viewVars['idUtilisateur']===$com['commentaire_compte']['idcompte']){?>
  <img name="updateCom" 
       id="updateCom"
       value="<?=$j?>"
       style="cursor:pointer;height: 2.5rem;width: 2.5rem;" 
       src="<?php echo pathUrl().'public/img/pencil.png';?>" 
       alt="Image introuvable"
  >
  <img name="deleteCom" 
       id="deleteCom"
       style="cursor:pointer;height: 1.5rem;width: 1.5rem;" 
       src="<?php echo pathUrl().'public/img/deleteCom.png';?>"  
       alt="Image introuvable"
       data-toggle="modal" 
       data-target="#deleteComModal<?=$com['commentaireInfo']['idcommentaire']?>"
  >
    
    <?php } ?>


  

  </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="deleteComModal<?=$com['commentaireInfo']['idcommentaire']?>" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="deleteComModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteComModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Êtes vous sûrs de vouloir supprimer ?
      </div>
      <div class="modal-footer">
      <form name="deleteComForm<?=$j;?>" id="deleteComForm" value="<?=$pub['publicationInfos']['idpublication']; ?>">
        <input type="hidden" name="idcommentaire" value="<?=$com['commentaireInfo']['idcommentaire']; ?>" class="text-input"/>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" id="deleteComModal" class="btn btn-primary">Confirmer</button>
      </form>
      </div>
    </div>
  </div>
</div>
  <div class="card-body" style="background-color:#B4C1D3;"  value="<?=$pub['publicationInfos']['idpublication']; ?>">
  <p class="card-text" id="cardText" value=<?=$com['commentaireInfo']['idcommentaire']?>><?php
    echo $com['commentaireInfo']['description'];
?></p>
    
  </div>
  <div class="card-footer rounded-0" style="background-color:#7A92B1;">
  <p>
  <div id="likeUnlikeCom_form">
<form name="likeUnlikeCom<?=$i;?>" >
  <?php if($com['commentaire_Liked_Par_Utilisateur']) {
    $img ="unlike.png";
  } else {
    $img ="like.png";
  } ?>
    <input type="hidden" name="idcommentaire" value="<?=$com['commentaireInfo']['idcommentaire']; ?>" class="text-input"/>
    <span id="LikeCom">
  <span id="loadLikeCom<?=$com['commentaireInfo']['idcommentaire']?>">
  <input type="image" id="<?=$img; ?>" name="likeUnlikeComButton" src="<?=pathUrl()."public/img/".$img;?>" class='card-img-top submitLike' alt='Image introuvable'>
  <?php echo $com['commentaireInfo']['Nombre Like']; ?>
  </span>
  </span>
</div>
</form>
</p>
  </div>
</div>


<?php
}?>
</span>
</span>
<?php

}?>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src=<?php echo pathUrl().'utils/scripts/homeNetwork.js' ?>></script>