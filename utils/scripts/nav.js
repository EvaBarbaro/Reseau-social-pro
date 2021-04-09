  $(document).ready(function(){
        var homeClass = $('.home');
        var profileClass = $('.profil');

        var accountAttr = profileClass.find('a').attr('href');

        console.log(window.location.href);
        console.log(accountAttr+'/mesInformations');
        console.log(accountAttr+'/mesImages');

        if(window.location.href == homeClass.find('a').attr('href')) {
            homeClass.addClass('active');
            profileClass.removeClass('active');
        } else if (window.location.href == profileClass.find('a').attr('href') || window.location.href == accountAttr+'/mesInformations' || window.location.href == accountAttr+'/mesImages') {
            profileClass.addClass('active');
            homeClass.removeClass('active');
        }  

  });