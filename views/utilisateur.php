<div class="container">
	<h2 class="mt-4">Toutes les entreprises</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th width="70px">Supprimer</th>
            <th width="70px">Modifier</th>
		</tr>
        <?php
        $length = count($viewVars['utilisateurList']);

        for ($index=0; $index < $length; $index++) { 
            $utilisateur = $viewVars['utilisateurList'][$index];

            echo "<form action='http://localhost:8080/apache/Reseau-social-pro/monCompte/delete' method='POST'>";
            echo "<input type='hidden' value='". $utilisateur['idutilisateur']."' name='idutilisateur' />";
            echo "<tr>";
            echo "<td>".$utilisateur['nomutilisateur'] . "</td>";
            echo "<td><button type='submit' class='btn btn-danger'>Supprimer</button>";
            echo "</form>";
            echo "<td><a href='./monCompte/".$utilisateur['idutilisateur']."' class='btn btn-info'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>