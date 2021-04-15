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
    <style>
        .truc {
      color: black;
      background-color: rgba(50, 100, 100, .2);
      padding : 20px;
      border-radius: 5px;
      
    }
    .inner-div {
     margin: 0 auto;
     width: 100px; 
    }


     </style>
</head>
<body>
<div class="d-flex">

<div class="container">    

<br>
<div class="truc">
    <h2 class="mt-4">Insérer une nouvelle image</h2>
    <!-- <div class="truc"> -->
        <div  style='width: 80%' class="inner-div">
            <?php echo "<td ><a href=".pathUrl()."imageEnCreation class='btn  btn-block btn-primary btn-justified';>Insérer</a></td>"; ?>
        </div>
    <!-- </div>     -->
</div>
<br><br><br>



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

    <h2 class="mt-4">Toutes mes images</h2>
    <div class="truc">                                               
    <div class="row">
        <?php
        $length = count($viewVars['imageList']);
        for ($index=0; $index < $length; $index++) { 
            $image = $viewVars['imageList'][$index];    
        ?>  
        <div class="col-md-3">
            <div class="thumbnail">    
                <?php   echo     "<a href=".pathUrl()."public/albumImages/". $image['imageurl']." target='_blank'>"   ?>
                <?php   echo     "<img src=".pathUrl()."public/albumImages/". $image['imageurl']." alt='Lights' style='width:100%'></a>"  ?>  
                    <div class="caption">
                        <p >    <?php  $t = $viewVars['imageList'][$index]['titre']; echo $t;   ?>  </p>
                        <p>
                            <div class="btn-group ">
                                <?php //echo "<a href=".pathUrl()."monImageD/".$image['idimage']." class='btn btn-danger btn-xs' >Supprimer</a>" ?> 
                                    <div class="container">

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
        <?php    }   ?>
        </div><!-- div-truc --> 
    </div><!-- div-row -->
</div><!-- div-truc --> 
</div><!-- div-container -->
</div><!-- div-d-flex --> 
</body>   
</html>
</div><!--  div container  -->

</div><!--  div d-flex  -->             

