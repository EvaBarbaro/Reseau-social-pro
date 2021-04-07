<pre>
<?php

print_r($viewVars['publicationList']);

echo "<br/>";
echo " pub1 liked = ".$viewVars['publicationList'][0]['publication_Liked_Par_Utilisateur']."<br/>";
echo " com 1 pub1 liked = ".$viewVars['publicationList'][0]['commentaires'][0]['commentaire_Liked_Par_Utilisateur'];
echo hexdec(uniqid());
?>
</pre>