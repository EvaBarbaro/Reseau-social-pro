var url = window.location.href;
var filename = url.substring(0,url.lastIndexOf('monReseau'));
var idEntreprise = url.substring(url.lastIndexOf('monReseau')+10,url.lastIndexOf('monReseau')+26);
var networkLink = filename+"monReseau/"+idEntreprise;

$(document).ready(function(){

   
    $(".dropdown-item").on( "click", function() {
      
        if($(this).attr("id")=="allPubs"){
          alert(url);
          $("#networkHomePage").load(url);
          $('footer').first().remove();
        }   

        else if($(this).attr("id")=="publicPubs"){
          alert(networkLink+"/public/publications");
          $("#networkHomePage").load(networkLink+"/public/publications");
          $('footer').first().remove();
        } 

        else if($(this).attr("id")=="amisPubs"){
          alert(networkLink+"/amis/publications");
          $("#networkHomePage").load(networkLink+"/amis/publications");
          $('footer').first().remove();
        } 

        else if($(this).find("img").attr("id")=="public"){
            $(".dropdown").children(":first").find("img").attr("src",filename+"public/img/public.png");
            $("#statut").attr("value","public");
        }

        else {
            $(".dropdown").children(":first").find("img").attr("src",filename+"public/img/amis.png");
            $("#statut").attr("value","amis");
        }
        
      }); 

    $("#reset").on( "click", function() {
      alert("reset url = "+url);
            $("#networkHomePage").load(url);
            $('footer').first().remove();
          });     

/*    $(".modal-footer").find("button").on( "click", function() {
      if($(this).attr("id").includes("deleteComModal")){
        //alert($(this).attr('value'));
      }
    });*/
/*
      $(".card-footer").find("img").on( "click", function() {
      
        if($(this).attr("id")=="unlike.png"){
            $(this).attr("src",filename+"public/img/like.png");
            $(this).attr("id","like.png");
        }
        else if($(this).attr("id")=="like.png") {
            $(this).attr("src",filename+"public/img/unlike.png");
            $(this).attr("id","unlike.png");
        }
        
      }); */

     /* $('.modal').click(function(e)
      {
          e.preventDefault();
          $('.modal').find('form').submit();
          $('.modal').modal('hide');
      });*/
     /* $(document.body).on('hidden.bs.modal', function () {
        $('.modal').removeData('bs.modal')
    });
*/
/*
$(document.body).on('hidden.bs.modal', function () {
  document.body.style.overflow="visible"; 
});
$( ".modal" ).on('show.bs.modal', function(e){
 // e.preventDefault();
  document.body.style.overflow="hidden"; 
 // $('.modal').modal('show');
});
$( ".modal" ).find("button[type=submit]").on('click', function(e){

     document.body.style.overflow="initial"; 
});*/
      $( "form" ).submit(function(e) {
        ////alert("submit");
            var sendFile=false;
            var dataString = $(this).serialize();
            var link="";
            var modal=false;
            if($(this).attr("name").includes("likeUnlikePub")) {
             // //alert("like Pub");
              link="/LikeUnlikePublication"; 
              e.preventDefault();
            }
          else if($(this).attr("name").includes("likeUnlikeCom")) {
              
              link="/LikeUnlikeCommentaire"; 
             
              e.preventDefault();
            }
    
            else if($(this).attr("name").includes("AddCom")) {
              
              link="/createCommentaire"; 
             
              e.preventDefault();
            }
    
            else if($(this).attr("name")=="AddPub") {
              
              link="/createPublication";
    
              dataString = new FormData(this);
              sendFile=true;
              e.preventDefault();
            }

            else if($(this).attr("name").includes("deleteComForm")) {
              
              link="/deleteCommentaire";
              e.preventDefault();
              // modal=true;
            }
          //alert(networkLink+link);
        if(link!=="") {
            if(sendFile){
           var xhr = $.ajax({
             type: "POST",
             url: networkLink+link,
             data: dataString,
             processData: false,
             contentType: false,
             cache: false
            });
          } else {
            var xhr = $.ajax({
              type: "POST",
              url: networkLink+link,
              data: dataString
            });
          }
            xhr.done(function() {
              $("#networkHomePage").load(url);  
              $('footer').first().remove();
              console.log(dataString);
             // $("#networkHomePage").html("");
          
             /* $('.modal').modal('dispose');
              $('.modal-backdrop').remove();*/
            //  $('.modal').modal('hide');
             
             
           /*   let elem = document.elementFromPoint(x, y);
              document.body.style.top="";
              document.body.style.position="";
              const scrollY = document.body.style.top;
              const scrollX = document.body.style.position;*/
              //var myWindow = window.open("", "myWin");
       
      
             
      
//window.scrollTo(0, parseInt(scrollY || '0') * -1);
             // $('.modal').modal('hide');
           //  $('.modal').modal().hide();
           ////alert("networkLink= "+networkLink);
              

             // document.body.style.overflow="initial"; 

             // $('.modal').modal().hide();
              
              //if(modal===true){
               /* $('.modal').modal('dispose');
               var x = window.scrollX;
               var y = window.scrollY;*/
               
              // window.scrollTo(x, y);
             // }

             
             
           
             // $("#networkHomePage").load(networkLink);
              
              //window.location = window.location;
             /* $('.modal').preventDefault();
              $('.modal').modal('hide');*/
             // $('.modal').modal().hide();
              //$('.modal').modal('hide');
              /*$('.modal').modal('dispose');
              $('.modal-backdrop').remove();*/
            
              //$('.modal').find("button:nth-child(2)").attr("data-dismiss","modal");
             // $('.modal').modal().hide();
             /* $('.modal').modal('hide');
              $('.modal-backdrop').remove();*/
             /* $('script').each(function() {

                if (this.src === 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js') {
        
                  this.parentNode.removeChild( this );
                }
            });*/
            /*  $('meta').first().remove();
              $('title').first().remove();
              $("#networkHomePage:nth-child(1)").children().find('meta').remove();
              $("#networkHomePage:nth-child(1)").children().find('link').remove();*/
             
            })
          }
        });
});