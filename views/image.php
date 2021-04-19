<?php 
    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';
?>
<div class="d-flex">
<?php require_once __DIR__ . '/asideProfil.php'; ?>
<div class="container">
        
<div class="d-flex">

<div class="container mt-4">    

<div class="truc">

<?php //session_start();?>
<!-- <pre>
        <b><p style="color:red;" >Variable SESSION</p></b>    <?php //var_dump($_SESSION); ?> 
        <b><p style="color:red;">Variable viewvars</p> </b>    <?php //var_dump($viewVars); ?> 
        <b><p style="color:red;"> Variable POST</p></b>   <?php //var_dump($_POST); ?> 
        <b><p style="color:red;">Variable GET</p></b>   <?php //var_dump($_GET); ?> 
        <b><p style="color:red;">Variable FILES</p> </b>    <?php // var_dump($_FILES); ?> 

        <b><p style="color:red;">Variable image</p> </b>    <?php // var_dump($image); ?> 
</pre>  -->

    <h2 class="mt-4">
        Toutes mes images
        <?php
            if ($viewVars['compte']['idcompte'] === $_SESSION['idutilisateur']) {
        ?>
        <button id="insertImageButton" class="btn btn-primary float-right" type="button" data-toggle="collapse" 
        data-target="#collapseImage" aria-expanded="false" aria-controls="collapseImage">
            Ajouter une image
        </button>
        <?php
            }
        ?>
    </h2>
    <div class="collapse" id="collapseImage">
    <div class="card card-body mb-4">
        <form enctype="multipart/form-data" action=<?= pathUrl()."monImage/create" ?> method="POST" class="col">
            <input type="hidden" name="idimage" value="<?= hexdec(uniqid()); ?>">

            <div class="form-group row">
                <label for="titre" class="col-sm-4 col-form-label">Titre de l'image</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de l'image" required>
                </div>
            </div>

    
            <div class="form-group row">
                <label for="imageurl" class="col-sm-4 col-form-label">Votre image</label>
                <div class="col-sm-8">
                <input type="file" name="imageurl" id="imageurl" placeholder="Votre image" required>
                </div>
            </div>

            <input type="hidden" name="idcompte" value=<?= $_SESSION['idutilisateur'] ?>>

            <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
        </form>
    </div>
    </div>
    <div class="truc">                                               
    <div class="row">
        <?php
        $length = count($viewVars['imageList']);
        for ($index=0; $index < $length; $index++) { 
            $image = $viewVars['imageList'][$index];    
        ?>  
        <div class="col-md-3">
            <div class="thumbnail">    
                <a href="<?= pathUrl()."public/albumImages/". $image['imageurl']?>" target='_blank'>
                <img src=<?= pathUrl()."public/albumImages/". $image['imageurl']?> alt='Lights' width=100% height="100vh"></a>
                    <div class="caption">
                        <p >    <?php  $t = $viewVars['imageList'][$index]['titre']; echo $t;   ?>  </p>
                        <p>
                            <div class="btn-group ">
                                <?php //echo "<a href=".pathUrl()."monImageD/".$image['idimage']." class='btn btn-danger btn-xs' >Supprimer</a>" ?> 
                                    <div class="container">
                                        <?php
                                            if ($image['idcompte'] === $_SESSION['idutilisateur']) {
                                        ?>
                                        <!-- Trigger the modal with a button modifier-->
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="<?= '#myModal'.$image['idimage'] 
                                        ?>">Suprimer</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="<?= 'myModal'.$image['idimage'] ?>" role="dialog">
                                            <div class="modal-dialog">
                                                                                
                                                <!-- Modal content-->
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <!-- <h4 class="modal-title">Modal Header</h4> -->
                                                    </div><!--  div modal-header  -->

                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            Voulez-vous vraiment <strong>supprimer</strong> l'image.
                                                        </div>
                                                    </div><!--  div modal-body  -->

                                                    



                                                    <form enctype="multipart/form-data" action=<?= pathUrl()."monImage/delete" ?> method="POST" class="col"> 

                                                        <input type="hidden" name="idimage" value="<?= $image['idimage'] ?>">
                                                        <input type="hidden" name="idcompte" value="<?= $image['idcompte'] ?>">
                                                        
                                                        <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer la suppression </button>
                                                    </form>

                                                    

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div><!--  div modal-footer  -->

                                                </div><!--  div modal-content  -->
                                            </div><!--  div modal-dialog  -->
                                        </div><!--  div modal-fade  -->

                        <!-- ------------------------------ limite entre les deux modales ------------------------------ -->
                                        
                                        <!-- Trigger the modal with a button modifier-->
                                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="<?= '#myModal2'.$image['idimage'] 
                                        ?>">Modifier</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="<?= 'myModal2'.$image['idimage'] ?>" role="dialog">
                                            <div class="modal-dialog">
                                                                                
                                                <!-- Modal content-->
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div><!--  div modal-header  -->

                                                    <div class="modal-body">
                                                        <div class="alert alert-info">
                                                            Voulez-vous vraiment <strong>modifier </strong>le titre de l'image.
                                                        </div>
                                                    </div><!--  div modal-body  -->

                                                    
                                                    <form enctype="multipart/form-data" action=<?= pathUrl()."monImage/update" ?> method="POST" class="col"> 
                                                    
                                                        <div class="form-group row">
                                                            <label for="titre" class="col-sm-4 col-form-label">Titre de l'image</label>
                                                            <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="titre" id="titre" value="<?= $image['titre'] ?>" required>     
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="imageurl" value="<?= $image['imageurl'] ?>">
                                                        <input type="hidden" name="idimage" value="<?= $image['idimage'] ?>">
                                                        <input type="hidden" name="idcompte" value="<?= $image['idcompte'] ?>">
                                                            <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer la modification </button>
                                                    </form>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div><!--  div modal-footer  -->

                                                </div><!--  div modal-content  -->
                                            </div><!--  div modal-dialog  -->
                                        </div><!--  div modal-fade  -->                              
                                    </div><!--  div container  -->
                                    <!-- <button type='submit' class='btn btn-danger'>Supprimer</button> -->
                                <!-- <?php //echo "<a href=".pathUrl()."monImageM/".$image['idimage']." class='btn btn-info btn-xs'>Modifier</a>" ?> -->
                            </div><!--  div btn-group  -->
                        </p>
                    </div><!--  div caption  -->
                <!-- </a> -->
            </div><!-- div-thumbnail -->                            
        </div><!-- div-col-md-3 -->
        <?php
                }
            }  
        ?>
        </div><!-- div-truc --> 
    </div><!-- div-row -->
</div><!-- div-truc --> 
</div><!-- div-container -->
</div><!-- div-d-flex -->
</div><!--  div container  -->

</div><!--  div d-flex  -->             

