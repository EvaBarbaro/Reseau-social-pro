<!-- <pre>
        <b><p style="color:red;" >Variable SESSION</p></b>    <?php //var_dump($_SESSION); ?> 
        <b><p style="color:red;">Variable viewvars</p> </b>    <?php //var_dump($viewVars); ?> 
        <b><p style="color:red;"> Variable POST</p></b>   <?php //var_dump($_POST); ?> 
        <b><p style="color:red;">Variable getAll</p></b>   <?php //var_dump($_GET); ?> 
        <b><p style="color:red;">Variable FILES</p> </b>    <?php //var_dump($_FILES); ?> 
  </pre>   -->
  <?php

if (!empty($_SESSION['messageMember'])) {?>
<div class="alert alert-warning" role="alert" style="width: 20rem; height:3rem;">
<?php
    echo $_SESSION['messageMember'];
    $_SESSION['messageMember']="";
?>
</div>
<?php } ?>
<?php
        $length = count($viewVars['compteList']);

        for ($index=0; $index < $length; $index++) { 
            $compte = $viewVars['compteList'][$index];

            if ($compte['photo'] == NULL) {
              $profileImage = "default158978.png";
          } else {
              $profileImage = $compte['photo'];
          }
?>
  

<div class="row mt-4">
      <div class="col-2">
      <img src="<?= pathUrl().'public/profilImages/'.$profileImage ?>" class="rounded-circle ml-1 media-object" alt="image profil" width="100%" height="60px">
      </div>
      <div class="col-9 ml-2 d-flex flex-row">
      <a id="memberLink" href="<?= pathUrl().'monCompte/'.$compte['idcompte'].'/mesPublications' ?>"><h3 class="mt-2"><?= $compte['nomutilisateur'] ?></h3></a>
      <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
      </svg> -->
      <?php
       $color="LightSteelBlue";
       
        $lengthA = count($viewVars['amisLList']);

        for ($indexA=0; $indexA < $lengthA; $indexA++) { 
            $ami = $viewVars['amisLList'][$indexA]['idcompte_ami'];            
                 
            if ($compte['idcompte']===$ami) {
              $color="YellowGreen";
            }  
        }

        $lengthB = count($viewVars['demandeamisList']);

        for ($indexB=0; $indexB < $lengthB; $indexB++) { 
            $demandeami = $viewVars['demandeamisList'][$indexB]['idcompte_solliciter'];            
                 
            if ($compte['idcompte']===$demandeami) {
              $color="SandyBrown";
            }  
        }
     
  if($compte['idcompte']!==$_SESSION['idutilisateur'])  {   
?>

<form name="addAmis">
<button type="submit" style="background:none;border:none;">
<input type='hidden' value=<?= $compte['idcompte'] ?> name="idsolliciter">
<input type='hidden' value=<?= $_SESSION['idutilisateur'] ?> name="iddemandeur">
      <svg xmlns="http://www.w3.org/2000/svg" width="55" height="35" fill="<?= $color ?>" class="bi bi-person-plus-fill ml-2 mt-2" viewBox="0 0 16 16">
        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
      </svg>
</button>
      </form>
      <?php } ?>
      </div>
    </div>
<?php
    }
?>


