<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Social-Connect</a>
    <form class="form-inline" method="POST" action="<?= pathUrl().'superAdmin/logoutAdmin' ?>">
        <button class="btn btn-info my-2 my-sm-0" type="submit">Déconnexion</button>
    </form>
    </nav>
	<h2 class="mt-4">Toutes les entreprises</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th>Statut</th>
            <th width="70px">Modifier</th>
            <th width="70px">Supprimer</th>
		</tr>
        <?php
        $length = count($viewVars['entrepriseList']);

        for ($index=0; $index < $length; $index++) { 
            $entreprise = $viewVars['entrepriseList'][$index];
        ?>
            <form action="<?= pathUrl()."monReseau/update" ?>" method="POST">
                <input type='hidden' value=<?= $entreprise['identreprise'] ?> name='identreprise' />
                <input type='hidden' value=<?= $entreprise['logo'] ?> name='logo' />
                <input type='hidden' value="<?= $entreprise['description'] ?>" name='description' />
                <input type='hidden' value=<?= $entreprise['url'] ?> name='url' />
            <tr>
                <td><input type="text" name="designation" id="designation" class="fakeTextInput" value="<?= $entreprise['designation']?>" readonly></td>
                <td>
                <div class="form-check">
                    <input name="statut" class="form-check-input" type="checkbox" value="<?= $entreprise['statut'] ?>" id="checkStatut<?= $index?>" <?php if($entreprise['statut'] == 1){echo "checked";} ?>>
                    <label class="form-check-label" for="checkStatut<?= $index?>">
                        Activé/Désactivé un compte
                    </label>
                </div>
                </td>
                <td><button type='submit' class='btn btn-info'>Modifier</button></td>
            </form>
            <td><button id="deleteSocial" type="button" class="btn btn-danger" data-toggle="modal" data-target="<?= '#userDelModalSuperAdmin'.$entreprise['identreprise'] ?>">
                Supprimer
                </button>

                    <!-- Modal -->
                    <div class="modal fade" id="<?= 'userDelModalSuperAdmin'.$entreprise['identreprise'] ?>" tabindex="-1" role="dialog" aria-labelledby="userDelModalSuperAdminLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userDelModalSuperAdminLabel">Comfirmez-vous la suppression du compte <?= $entreprise['designation'] ?> ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action=<?= pathUrl()."monReseau/delete" ?> method='POST'>
                        <div class="modal-footer">
                            <input type='hidden' value=<?= $entreprise['identreprise'] ?> name='identreprise' />
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>