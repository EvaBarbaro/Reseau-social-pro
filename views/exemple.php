<?php 
    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';
?>
<div class="d-flex">
<?php require_once __DIR__ . '/asideProfil.php'; ?>
    <div class="container">
        
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <!--<title>Bootstrap Example</title> -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
            <body>
                <div class="d-flex">

                        <div class="container">
                                <h2 class="mt-4">Toutes mes images</h2>            
                                    
                                        <div class="row">
                                        <?php
                                            $length = count($viewVars['imageList']);
                                            for ($index=0; $index < $length; $index++) { 
                                            $image = $viewVars['imageList'][$index];            
                                            //echo $index;
                                        ?>  
                                            <div class="col-md-3">
                                                <div class="thumbnail">      
                                                    <?php   echo     "<a href=".pathUrl()."public/albumImages/". $image['imageurl']." target='_blank'>"   ?>
                                                    <?php   echo     "<img src=".pathUrl()."public/albumImages/". $image['imageurl']." alt='Lights' style='width:100%'></a>"  ?>  
                                                            <div class="caption">
                                                                <p >    <?php  $t = $viewVars['imageList'][$index]['titre']; echo $t;   ?>  </p>
                                                                <p>
                                                                    <div class="btn-group ">
                                                                        <?php echo "<a href=".pathUrl()."monImageD/".$image['idimage']." class='btn btn-danger btn-xs'>Supprimer</a>" ?>
                                                                        <!-- <button type='submit' class='btn btn-danger'>Supprimer</button> -->
                                                                        <?php echo "<a href=".pathUrl()."monImageM/".$image['idimage']." class='btn btn-info btn-xs'>Modifier</a>" ?>
                                                                    </div>
                                                                </p>
                                                            </div>
                                                    </a>
                                                </div>                            
                                            </div>
                                        <?php    }   ?>
                                            



                                            
                                        </div>
                        
                        </div>
                    </div> 
            </body>   
        </html>

        <br>
                <h2 class="mt-4"></h2>
                <h2 class="mt-4">Insérer une nouvelle image</h2>
                
                <?php
                echo "<td><a href=".pathUrl()."imageEnCreation class='btn btn-block btn-primary'>Insérer</a></td>";
                ?>
    </div>
</div>              

