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
<?php session_start();?>
<pre>
        <b><p style="color:red;" >Variable SESSION</p></b>    <?php var_dump($_SESSION); ?> 
        <b><p style="color:red;">Variable viewvars</p> </b>    <?php var_dump($viewVars); ?> 
        <b><p style="color:red;"> Variable POST</p></b>   <?php var_dump($_POST); ?> 
        <b><p style="color:red;">Variable getAll</p></b>   <?php var_dump($_GET); ?> 
        <b><p style="color:red;">Variable FILES</p> </b>    <?php var_dump($_FILES); ?> 
</pre> 







    <h2 class="mt-4">Toutes mes images</h2>                                               
    <div class="row">
        <?php
        $length = count($viewVars['imageList']);
        for ($index=0; $index < $length; $index++) { 
            $image = $viewVars['imageList'][$index]; 
             echo $image[$index];  
        ?>  
        <div class="col-md-3">
            <div class="thumbnail">   
                <?php echo $index ?>  
                <?php   echo     "<a href=".pathUrl()."public/albumImages/". $image['imageurl']." target='_blank'>"   ?>
                <?php   echo     "<img src=".pathUrl()."public/albumImages/". $image['imageurl']." alt='Lights' style='width:100%'></a>"  ?>  
                    <div class="caption">
                        <p >    <?php  $t = $viewVars['imageList'][$index]['titre']; echo $t;   ?>  </p>
                        <p >    <?php  $u = $viewVars['imageList'][$index]['idimage']; echo $u;   ?>  </p>
                        <p>
                            <div class="btn-group ">
                                <?php echo "<a href=".pathUrl()."monImageD/".$image['idimage']." class='btn btn-danger btn-xs' >Supprimer</a>" ?>
                                <!-- <pre><?php var_dump($image) ?></pre> -->
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
                                                    </div><!--  div modal-header  -->

                                                    <form enctype="multipart/form-data" action=<?= pathUrl()."monImage/delete" ?> method="POST" class="col"> 
                                                        <!-- <input type="hidden" name="idimage" value="<?= $viewVars['image']['idimage'] ?>">  -->
                                                        <!-- <input type="hidden" name="imageurl" value="<?= $viewVars['image']['imageurl'] ?>"> -->
                                                        <!-- <input type="hidden" name="idcompte" value="<?= $viewVars['image']['idcompte'] ?>">  -->

                                                        <p >    <?php  echo $u   ?>  </p>
                                                        <p >    <?php  echo "/ / / / /" ?>  </p>
                                                        <input type="hidden" name="idimage" value="<?= $image['idimage'] ?>">
                                                        <?php echo $image['idimage'] ?>
                                                        <input type="hidden" name="idcompte" value="<?= $image['idcompte'] ?>">
                                                        <?php echo $image['idimage'] ?>
                                                            <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer la suppression </button>
                                                    </form>

                                                    <div class="modal-body">
                                                        <p>Some text in the modal.</p>
                                                    </div><!--  div modal-body  -->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div><!--  div modal-footer  -->

                                                </div><!--  div modal-content  -->
                                            </div><!--  div modal-dialog  -->
                                        </div><!--  div modal-fade  -->
                                                                            
                                    </div><!--  div container  -->
                                    <!-- <button type='submit' class='btn btn-danger'>Supprimer</button> -->
                                <?php echo "<a href=".pathUrl()."monImageM/".$image['idimage']." class='btn btn-info btn-xs'>Modifier</a>" ?>
                            </div><!--  div btn-group  -->
                        </p>
                    </div><!--  div caption  -->
                                                    <!-- </a> -->
            </div><!-- div-thumbnail -->                            
        </div><!-- div-col-md-3 -->
        <?php    }   ?>
    </div><!-- div-row -->
</div><!-- div-container -->
</div><!-- div-d-flex --> 
</body>   
</html>
<br>
<h2 class="mt-4"></h2>
<h2 class="mt-4">Insérer une nouvelle image</h2>
<?php echo "<td><a href=".pathUrl()."imageEnCreation class='btn btn-block btn-primary'>Insérer</a></td>"; ?>
</div><!--  div container  -->

</div><!--  div d-flex  -->             

