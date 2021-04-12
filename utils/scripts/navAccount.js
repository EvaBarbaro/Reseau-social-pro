  $(document).ready(function(){
        var accountClass = $('.account');
        var infosClass = $('.infos');
        var albumClass = $('.album');
        var passwordClass = $('.password');
        var photoClass = $('.profilImage');
        
        if(window.location.href == accountClass.attr('href')) {
            accountClass.addClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
            passwordClass.removeClass('active');
            photoClass.removeClass('active');
        } else if (window.location.href == infosClass.attr('href')) {
            infosClass.addClass('active');
            accountClass.removeClass('active');
            albumClass.removeClass('active');
            passwordClass.removeClass('active');
            photoClass.removeClass('active');
        }  else if (window.location.href == albumClass.attr('href')) {
            albumClass.addClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            passwordClass.removeClass('active');
            photoClass.removeClass('active');
        } else if (window.location.href == passwordClass.attr('href')) {
            passwordClass.addClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
            photoClass.removeClass('active');
        } else if (window.location.href == photoClass.attr('href')) {
            photoClass.addClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            passwordClass.removeClass('active');
            albumClass.removeClass('active');
        }

  });