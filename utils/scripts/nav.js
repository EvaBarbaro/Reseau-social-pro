  $(document).ready(function(){
        var homeClass = $('.home');
        var profileClass = $('.profil');
        if(window.location.href == homeClass.find('a').attr('href')) {
            homeClass.addClass('active');
            profileClass.removeClass('active');
        } else if (window.location.href == profileClass.find('a').attr('href')) {
            profileClass.addClass('active');
            homeClass.removeClass('active');
        }  

  });