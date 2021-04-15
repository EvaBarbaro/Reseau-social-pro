  $(document).ready(function(){
        var accountClass = $('.account');
        var infosClass = $('.infos');
        var albumClass = $('.album');
        var passwordClass = $('.password');
        var usersClass = $('.users');
        var postClass = $('.post');
        
        if(window.location.href == accountClass.attr('href')) {
            accountClass.addClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
            passwordClass.removeClass('active');
            postClass.removeClass('active');
            usersClass.removeClass('active');
        } else if (window.location.href == infosClass.attr('href')) {
            infosClass.addClass('active');
            accountClass.removeClass('active');
            albumClass.removeClass('active');
            passwordClass.removeClass('active');
            postClass.removeClass('active');
            usersClass.removeClass('active');
        }  else if (window.location.href == albumClass.attr('href')) {
            albumClass.addClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            passwordClass.removeClass('active');
            postClass.removeClass('active');
            usersClass.removeClass('active');
        } else if (window.location.href == passwordClass.attr('href')) {
            passwordClass.addClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
            postClass.removeClass('active');
            usersClass.removeClass('active');
        } else if (window.location.href == usersClass.attr('href')) {
            usersClass.addClass('active');
            postClass.removeClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
            passwordClass.removeClass('active');
        } else if (window.location.href == postClass.attr('href')) {
            postClass.addClass('active');
            usersClass.removeClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
            passwordClass.removeClass('active');
        }
  });