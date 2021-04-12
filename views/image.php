<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="container">
	<h2 class="mt-4">Toutes les images</h2>
	<table class="table table-bordered table-striped mt-4">
		<tr>
			<th>Nom</th>
            <th>Image</th>
            <th width="70px">Supprimer</th>
            <th width="70px">Modifier</th>
		</tr>


        
        <?php
        $length = count($viewVars['imageList']);
       

        for ($index=0; $index < $length; $index++) { 
            $image = $viewVars['imageList'][$index];

            echo "<form action=".pathUrl()."monImage/delete method='POST'>";
            echo "<input type='hidden' value='". $image['idimage']."' name='idimage' />";
            echo "<tr>";
            echo "<td>".$image['titre'] . "</td>";
            echo "<td><img src=".pathUrl()."/public/albumImages/". $image['imageurl']." alt='logo' id='logoImg' width='80'  class='img-thumbnail mt-4'></td>";
            echo "<td><button type='submit' class='btn btn-danger'>Supprimer</button>";
            echo "</form>";
            echo "<td><a href=".pathUrl()."monImage/".$image['idimage']." class='btn btn-info'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <h2 class="mt-4"></h2>
    <h2 class="mt-4">Insérer une nouvelle image</h2>
    
    <?php
      //echo "<td><a href='imageEnCreation.php"."' class='btn btn-block btn-primary'>Insérer</a></td>";
      echo "<td><a href=".pathUrl()."imageEnCreation class='btn btn-block btn-primary'>Insérer</a></td>";
    ?>


</div>