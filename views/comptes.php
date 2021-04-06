<div class="container">
	<h2 class="mt-4">Toutes les entreprises</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th>Prénom</th>
            <th width="70px">Modifier</th>
		</tr>
        <?php
        $length = count($viewVars['compteList']);

        for ($index=0; $index < $length; $index++) { 
            $compte = $viewVars['compteList'][$index];
            echo "<tr>";
            echo "<td>".$compte['nom']."</td>";
            echo "<td>".$compte['prenom']."</td>";
            echo "<td><a href='".pathUrl()."monCompte/".$compte['idcompte']."/mesInformations' class='btn btn-info'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>