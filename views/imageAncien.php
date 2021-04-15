<?php 
    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';
?>
<div class="d-flex">
<?php require_once __DIR__ . '/asideProfil.php'; ?>
    <div class="container">
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
                                                                        <?php echo "<a href=".pathUrl()."monImageD/".$image['idimage']." class='btn btn-danger btn-xs' >Supprimer</a>" ?>
                                                                        
                                                                        <div class="container">
                                                                            
                                                                            <!-- Trigger the modal with a button -->
                                                                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">Open Modal</button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="myModal" role="dialog">
                                                                                <div class="modal-dialog">
                                                                                
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Modal Header</h4>
                                                                                    </div>

                                                                                    <form enctype="multipart/form-data" action=<?= pathUrl()."monImage/delete" ?> method="POST" class="col"> 
                                                                                    


                                                                                    <input type="hidden" name="idimage" value="<?= $image['idimage'] ?>">
                                                                                    <input type="hidden" name="idcompte" value="<?= $image['idcompte'] ?>">
                                                                                        <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer la suppression </button>
                                                                                    </form>

                                                                                    <div class="modal-body">
                                                                                        <p>Some text in the modal.</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
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

