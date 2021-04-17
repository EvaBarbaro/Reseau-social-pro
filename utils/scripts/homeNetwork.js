sessionStorage.clear();  
var url = window.location.href;
var filename = url.substring(0,url.lastIndexOf('monReseau'));
var idEntreprise = url.substring(url.lastIndexOf('monReseau')+10,url.lastIndexOf('monReseau')+26);
var networkLink = filename+"monReseau/"+idEntreprise;
sessionStorage.setItem("visibilite", "reseau");
sessionStorage.setItem("order", "publications");

$(document).on('click', "#reset", function () {

  $("#networkHomePage").load(networkLink+"/"+sessionStorage.getItem("visibilite")+"/"+sessionStorage.getItem("order")+ " #test");

});     


  $(document).on('click', ".dropdown-item", function () {
 
    // filtre = toutes les publications
    if($(this).attr("id")=="allPubs"){
      sessionStorage.setItem("visibilite","reseau");
      
      $("#networkHomePage").load(url+ " #test");
    
    }   
  
    // filtre = toutes les publications publics
    else if($(this).attr("id")=="publicPubs"){
      sessionStorage.setItem("visibilite","public");
     
      $("#networkHomePage").load(networkLink+"/public/"+sessionStorage.getItem("order")+ " #test");
    
    } 
    // filtre = toutes les publications amis
    else if($(this).attr("id")=="amisPubs"){
      sessionStorage.setItem("visibilite","amis");
     
      $("#networkHomePage").load(networkLink+"/amis/"+sessionStorage.getItem("order")+ " #test");
    
    } 
    // Trie = affichage des publications selon les dates
    else if($(this).attr("id")=="datePubs"){
      sessionStorage.setItem("order","publications");
    
      $("#networkHomePage").load(networkLink+"/"+sessionStorage.getItem("visibilite")+"/publications"+ " #test");
    
    } 
    // Trie = affichage des publications selon les likes
    else if($(this).attr("id")=="likePubs"){
      sessionStorage.setItem("order","popularite");
   
      $("#networkHomePage").load(networkLink+"/"+sessionStorage.getItem("visibilite")+"/popularite"+ " #test");
    
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

   

  $(document).on('click', "#updateCom", function () {
    if($(this).parents(".card-header").siblings(".card-body").find("p#cardText").length){

  var description = $(this).parents(".card-header").siblings(".card-body").find("p#cardText").html();
  var idcommentaire = $(this).parents(".card-header").siblings(".card-body").find("p#cardText").attr("value");
  $(this).parents(".card-header").siblings(".card-body").find("p#cardText").replaceWith( "<form method='POST' name='updateCom"+idcommentaire+"'><input type='hidden' value="+idcommentaire+" name='idcommentaire'><input type='text' name='updateComInput' value='"+description+"' class='form-control'></form>" );
}
else {

  var description =  $(this).parents(".card-header").siblings(".card-body").find("input[type=text]").attr("value");
  $(this).parents(".card-header").siblings(".card-body").find("form").replaceWith( "<p class='card-text' id='cardText' value='"+description+"'>"+description+"</p>" );
}});  

$(document).on('keyup', "input[type=text]", function (e) { 
  var code = e.key; 
  if(code==="Enter"){
  
 /* if($(this).attr("name").includes("updateComInput") ){
  //  $(this).parent("form").submit();
  } */
}
});  
$(document).on('submit', "form", function (e) {
     
 //e.preventDefault();

      var sendFile=false;
      var dataString = $(this).serialize();
      var link="";
      var modal=false;
      if($(this).attr("name").includes("likeUnlikePub")) {
     
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
       
      }
      else if($(this).attr("name").includes("updateCom")) {
        e.preventDefault();
        link="/updateCommentaire"; 
       // alert(sessionStorage.getItem("visibilite"));
        //alert(sessionStorage.getItem("order"));
        
        
      }
   
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
        console.log("visibilité= "+sessionStorage.getItem("visibilite"));
        console.log("order= "+sessionStorage.getItem("order"));
        var visibilite = sessionStorage.getItem("visibilite");
        var order = sessionStorage.getItem("order");
      $("#networkHomePage").load(networkLink+"/"+visibilite+"/"+order+ " #test");  
          });
      }
      });