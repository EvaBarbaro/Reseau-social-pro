

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-6">

<!--<pre>
  <?php //var_dump($_SESSION); ?> 
</pre> -->
<!--
<pre>
        <b><p style="color:red;" >Variable SESSION</p></b>    <?php var_dump($_SESSION); ?> 
        <b><p style="color:red;">Variable viewvars</p> </b>    <?php var_dump($viewVars); ?> 
        <b><p style="color:red;"> Variable POST</p></b>   <?php var_dump($_POST); ?> 
        <b><p style="color:red;">Variable getAll</p></b>   <?php var_dump($_GET); ?> 
        <b><p style="color:red;">Variable FILES</p> </b>    <?php var_dump($_FILES); ?> 
</pre>
-->


  <a class="navbar-brand" href="<?php echo pathUrl().'monReseau/'.$_SESSION['identreprise']?>"><img 
                            src= <?= pathUrl().'public/logoImages/'.$_SESSION['logo'] ?> 
                            class="rounded-circle" width="70px"></a>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item home">
        <a class="nav-link" href="<?php echo pathUrl().'monReseau/'.$_SESSION['identreprise']?>">Accueil</a>
      </li>
      <li class="nav-item profil">
        <a class="nav-link"  href="<?php echo pathUrl().'monCompte/'.$_SESSION['idutilisateur']?>">Profil</a>
      </li>
      
    </ul>
  </div>
</nav>