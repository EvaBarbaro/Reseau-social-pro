<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="d-flex">

<?php

    require_once __DIR__ . '/asideProfil.php';

?>

<div class="container">
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
                        </div>
                    </div>
                    </div>
                    </form>
        <?php
        }
        ?>
</div>