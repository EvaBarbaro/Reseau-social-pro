  $(document).ready(function(){
        var homeClass = $('.home');
        var profileClass = $('.profil');

        var accountAttr = profileClass.find('a').attr('href');

        if(window.location.href == homeClass.find('a').attr('href')) {
            homeClass.addClass('active');
            profileClass.removeClass('active');
        } else if (window.location.href == profileClass.find('a').attr('href') || window.location.href == accountAttr+'/mesInformations' || window.location.href == accountAttr+'/mesImages' || window.location.href == accountAttr+'/monMotDePasse' || window.location.href == accountAttr+'/maPhotoDeProfil') {
            profileClass.addClass('active');
            homeClass.removeClass('active');
        }  

  });