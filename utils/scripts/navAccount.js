  $(document).ready(function(){
        var accountClass = $('.account');
        var infosClass = $('.infos');
        var albumClass = $('.album');
        
        if(window.location.href == accountClass.attr('href')) {
            accountClass.addClass('active');
            infosClass.removeClass('active');
            albumClass.removeClass('active');
        } else if (window.location.href == infosClass.attr('href')) {
            infosClass.addClass('active');
            accountClass.removeClass('active');
            albumClass.removeClass('active');
        }  else if (window.location.href == albumClass.attr('href')) {
            albumClass.addClass('active');
            accountClass.removeClass('active');
            infosClass.removeClass('active');
        } 

  });