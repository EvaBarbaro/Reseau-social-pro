<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="d-flex">
<?php
    require_once __DIR__ . '/asideProfil.php';
?>
    <div class="container">
        <h2 class="mt-4">Toutes les images</h2>
        <!--<table class="table table-bordered table-striped mt-4">  -->
            


            
            <?php
            $length = count($viewVars['imageList']);
        

            for ($index=0; $index < $length; $index++) { 
                $image = $viewVars['imageList'][$index];
                
                echo $index;
            ?>   
            
                <div class="container">
                    
                   
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                    <?php                                                                  ?>        
                    <?php   echo     "<a href=".pathUrl()."/public/albumImages/". $image['imageurl']." target='_blank'>"   ?>

                    <?php   echo      "<img src=".pathUrl()."/public/albumImages/". $image['imageurl']." alt='Lights' style='width:100%'>"  ?>  

                    <?php   //echo      "<img src='/w3images/lights.jpg' alt='Lights' style='width:100%'>"  ?>

                                        <div class="caption">
                                            <p >
                                            <?php
                                            $t = $viewVars['imageList'][$index]['titre'];
                                            echo $t;                                           
                                            ?>
                                            </p>
                                        </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
          //    echo "</form>";       
          //    echo "</tr>";
            }
            ?>
        <!--</table> 
        <br>
        <h2 class="mt-4"></h2>
        <h2 class="mt-4">Insérer une nouvelle image</h2>
        
        


    </div>
</div>