<!-- <?php  session_start();  ?> -->



<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."public/img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>
    

        <pre>
        <b><p style="color:blue;" >Variable SESSION</p></b>    <?php var_dump($_SESSION); ?> 
        <b><p style="color:red;">Variable viewvars et image</p> </b>    <?php var_dump($viewVars); ?> 
        <b><p style="color:red;"> Variable POST</p></b>   <?php var_dump($_POST); ?> 
        <b><p style="color:red;">Variable getAll</p></b>   <?php var_dump($_GET); ?> 
        <b><p style="color:red;">Variable FILES</p> </b>    <?php var_dump($_FILES); ?> 
        </pre>


        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Voulez-vous vraiment supprimer l'image</h1>

            <form enctype="multipart/form-data" action=<?= pathUrl()."monImage/delete" ?> method="POST" class="col">
                <input type="hidden" name="idimage" value="<?= $viewVars['image']['idimage'] ?>">
                
                <div class="form-group row">
                    <label for="titre" class="col-sm-4 col-form-label">Titre de l'image</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="titre" id="titre" 
                    value="<?= $viewVars['image']['titre'] ?>" required>
                    </div>
                </div>
                
                <input type="hidden" name="imageurl" value="<?= $viewVars['image']['imageurl'] ?>">

                <input type="hidden" name="idcompte" value="<?= $viewVars['image']['idcompte'] ?>">
                
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
        </div>
</div>



