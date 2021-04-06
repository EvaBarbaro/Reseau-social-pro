<div class="container">
	<h2 class="mt-4">Toutes les images</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th width="70px">Supprimer</th>
            <th width="70px">Modifier</th>
		</tr>
        <?php
        $length = count($viewVars['imageList']);

        for ($index=0; $index < $length; $index++) { 
            $image = $viewVars['imageList'][$index];

            echo "<form action='http://localhost/apache/Reseau-social-pro/monReseau/delete' method='POST'>";
            echo "<input type='hidden' value='". $image['idimage']."' name='idimage' />";
            echo "<tr>";
            echo "<td>".$image['titre'] . "</td>";
            echo "<td><button type='submit' class='btn btn-danger'>Supprimer</button>";
            echo "</form>";
            echo "<td><a href='./monImage/".$image['idimage']."' class='btn btn-info'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>