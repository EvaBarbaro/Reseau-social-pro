var url = window.location.href;
var filename = url.substring(0,url.lastIndexOf('monReseau'));
var idEntreprise = url.substring(url.lastIndexOf('/')+1,url.lastIndexOf(''));
var networkLink = filename+"monReseau/"+idEntreprise;
$(document).ready(function(){

   
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
        else if($(this).attr("id")=="like.png") {
            $(this).attr("src",filename+"public/img/unlike.png");
            $(this).attr("id","unlike.png");
        }
        
      }); 
     
});
$(function() {
  $( "form" ).on( "submit", function(e) {
    //alert("submit");
    
       var dataString = $(this).serialize();
        var link="";
        if($(this).attr("name")=="likeUnlikePub") {
          
          link="/LikeUnlikePublication"; 
        }
        
    if(link!==""){
      alert("link= "+networkLink+link);
       $.ajax({
         type: "POST",
         url: networkLink+link,
         data: dataString,
         success: function () {
          $(document).load(window.location.href);
         }
       });
      }
       e.preventDefault();
     });
    
});