<?php 

    require_once __DIR__ . '/networkNav.php';
?>
<div style="margin-top:7rem;">
<?php
    require_once __DIR__ . '/accountNav.php';
?>
<div class="d-flex">

<?php

    require_once __DIR__ . '/asideProfil.php';
?>

<div class="container">
<div class="mt-1">
  <a class="btn"  data-toggle="collapse" href="#Invitations" role="button" aria-expanded="false" aria-controls="collapseExample">
  <figure class="figure">
  <img src="<?php echo pathUrl().'public/img/demandeAmis.png';?>" style="height:4rem;"/>
  <figcaption class="figure-caption text-dark">Invitations.</figcaption>
  </figure>
  </a>
</div>

<div class="collapse" id="Invitations">
  <div class="card card-body">
  <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Demandes reçues
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Compte</th>
                <th scope="col">Répondre</th>
                </tr>
            </thead>
            <tbody>
      <?php
      
      if(count($viewVars['inviteList'])!==0){
       
        foreach ($viewVars['inviteList'] as $invite) { 
            
        ?>
    
                <tr>
                <td><?= $invite['nom'] ?> <?= $invite['prenom'] ?></td>
                <td>
                   <button id="AccepterDemande" type="button" class="btn btn-success col-3" data-toggle="modal" data-target="<?= '#userDelModalAdmin'.$amis['idcompte'] ?>">
                    Accepter
                    </button>
                    <button id="RefuserDemande" type="button" class="btn btn-danger col-3" data-toggle="modal" data-target="<?= '#userDelModalAdmin'.$amis['idcompte'] ?>">
                    Refuser
                    </button>
                </td>
                </tr>

                <!-- Button trigger modal -->


                    <!-- Modal -->
                  
        <?php
        }
    }
        ?>
                    </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Demandes envoyées
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Compte</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
      
      if(count($viewVars['requestList'])!==0){
       
        foreach ($viewVars['requestList'] as $request) { 
            
        ?>
    
                <tr>
                <td><?= $request['nom'] ?> <?= $request['prenom'] ?></td>
                <td>
                
                    <button id="AnnulerDemande" type="button" class="btn btn-danger col-3" data-toggle="modal" data-target="<?= '#userDelModalAdmin'.$amis['idcompte'] ?>">
                   Annuler
                    </button>
                </td>
                </tr>

                <!-- Button trigger modal -->


                    <!-- Modal -->
                  
        <?php
        }
    }
        ?>
         </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  </div>
  </div>

<h2 class="mt-4">Tous les amis</h2>
    
    <?php
    $length = count($viewVars['amisList']);

    for ($index=0; $index < $length; $index++) { 
        $amis = $viewVars['amisList'][$index];
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Ami</th>
            <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td><?= $amis['nomutilisateur'] ?></td>
            <td>
                <button id="deleteAccount" type="button" class="btn btn-danger mb-4" data-toggle="modal" data-target="<?= '#userDelModalAdmin'.$amis['idcompte'] ?>">
                Supprimer
                </button>
            </td>
            </tr>
        </tbody>
    </table>
            <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="<?= 'userDelModalAdmin'.$amis['idcompte'] ?>" tabindex="-1" role="dialog" aria-labelledby="userDelModalAdminLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userDelModalAdminLabel">Comfirmez-vous la suppression du compte <?= $amis['nomutilisateur'] ?> ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form action=<?= pathUrl()."mesAmis/delete" ?> method='POST'>
                    <div class="modal-footer">
                        <input type='hidden' value=<?= $amis['idcompte'] ?> name='idcompte' />
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
                    </div>
                </div>
                </div>
                
    <?php
    }
    ?>
</div>
</div>