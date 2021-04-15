  $(document).ready(function(){
        var homeClass = $('.home');
        var profileClass = $('.profil');

        // var accountAttr = profileClass.find('a').attr('href');
        // var homeAttr = homeClass.find('a').attr('href');

        if(window.location.href == homeClass.find('a').attr('href')) {
            homeClass.addClass('active');
            profileClass.removeClass('active');
        } else {
            profileClass.addClass('active');
            homeClass.removeClass('active');
        }  

  });