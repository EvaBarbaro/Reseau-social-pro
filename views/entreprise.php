<div class="container">
	<h2 class="mt-4">Toutes les entreprises</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th width="70px">Supprimer</th>
            <th width="70px">Modifier</th>
		</tr>
        <?php
        $length = count($viewVars['entrepriseList']);

        for ($index=0; $index < $length; $index++) { 
            $entreprise = $viewVars['entrepriseList'][$index];

            echo "<form action='http://localhost:8080/apache/Reseau-social-pro/monReseau/delete' method='POST'>";
            echo "<input type='hidden' value='". $entreprise['identreprise']."' name='identreprise' />";
            echo "<tr>";
            echo "<td>".$entreprise['designation'] . "</td>";
            echo "<td><button type='submit' class='btn btn-danger'>Supprimer</button>";
            echo "</form>";
            echo "<td><a href='./monReseau/".$entreprise['identreprise']."' class='btn btn-info'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>