
  $(document).ready(function(){
        var homeClass = $('.home');
        var profileClass = $('.profil');

        if(location.pathname == '/Reseau-social-pro/socialHome') {
            homeClass.addClass('active');
            profileClass.removeClass('active');
        } else if (location.pathname == '/Reseau-social-pro/monCompte/1696278514562148') {
            profileClass.addClass('active');
            homeClass.removeClass('active');
        }  
        console.log( sessionStorage.getItem("idutilisateur"));
  });