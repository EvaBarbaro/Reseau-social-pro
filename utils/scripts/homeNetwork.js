$(document).ready(function(){
    var url = window.location.href;
    var filename = url.substring(0,url.lastIndexOf('monReseau'));
   
    $(".dropdown-item").find("img").on( "click", function() {
      
        if($(this).attr("id")=="public"){
            $(".dropdown").children(":first").find("img").attr("src",filename+"public/img/public.png");
        }
        else {
            $(".dropdown").children(":first").find("img").attr("src",filename+"public/img/amis.png");
        }
        
      }); 

      $(".card-footer").find("img").on( "click", function() {
      
        if($(this).attr("id")=="unlike.png"){
            $(this).attr("src",filename+"public/img/like.png");
            $(this).attr("id","like.png");
        }
        else {
            $(this).attr("src",filename+"public/img/unlike.png");
            $(this).attr("id","unlike.png");
        }
        
      }); 
});