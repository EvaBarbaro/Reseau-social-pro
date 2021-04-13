<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="container">
	<h2 class="mt-4">Tous les utilisateurs</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th>Mail</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th width="70px">Modifier</th>
            <th width="70px">Supprimer</th>
		</tr>
        <?php
        $length = count($viewVars['utilisateurList']);

        for ($index=0; $index < $length; $index++) { 
            $utilisateur = $viewVars['utilisateurList'][$index];

        ?>
            <form action="<?= pathUrl()."monCompte/updateAdmin" ?>" method="POST">
                <input type='hidden' value=<?= $utilisateur['idutilisateur'] ?> name='idutilisateur' />
                <input type='hidden' value=<?= $utilisateur['identreprise'] ?> name='identreprise' />
            <tr>
                <td><input type="text" name="nomutilisateur" id="nomutilisateur" class="fakeTextInput" value="<?= $utilisateur['nomutilisateur']?>" readonly></td>
                <td><input type="text" name="mail" id="mail" class="fakeTextInput" value="<?= $utilisateur['mail']?>" readonly></td>
                <td>
                    <select name="role" class="form-select roleSelect" aria-label="Default select example">
                        <option <?php if($utilisateur['role'] == 'admin'){echo "selected";} ?> value="admin">Administrateur</option>
                        <option <?php if($utilisateur['role'] == 'modo'){echo "selected";} ?>  value="modo">Modérateur</option>
                        <option <?php if($utilisateur['role'] == 'user'){echo "selected";} ?>  value="user">Utilisateur</option>
                    </select>
                </td>
                <td>
                <div class="form-check">
                    <input name="statut" class="form-check-input" type="checkbox" id="checkStatut<?= $index?>" <?php if($utilisateur['statut'] == 1){echo "checked";} ?>>
                    <label class="form-check-label" for="checkStatut<?= $index?>">
                        Activé/Désactivé un compte
                    </label>
                </div>
                </td>
                <td><button type='submit' class='btn btn-info'>Modifier</button>
            </form>
            <form action=<?= pathUrl()."monCompte/delete" ?> method='POST'>
                <input type='hidden' value=<?= $utilisateur['idutilisateur'] ?> name='idutilisateur' />
                <input type='hidden' value=<?= $utilisateur['identreprise'] ?> name='identreprise' />
                <td><button type='submit' class='btn btn-danger'>Supprimer</button>
            </form>
            </tr>
        <?php
        }
        ?>
    </table>
</div>