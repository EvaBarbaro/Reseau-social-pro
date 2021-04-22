sessionStorage.clear();  
$("#alert").hide();
var url = window.location.href;
var filename = url.substring(0,url.lastIndexOf('monReseau'));
var idEntreprise = url.substring(url.lastIndexOf('monReseau')+10,url.lastIndexOf('monReseau')+26);
var networkLink = filename+"monReseau/"+idEntreprise;
sessionStorage.setItem("visibilite", "reseau");
sessionStorage.setItem("order", "publications");

$(document).on('click', "#reset", function () {

  $("#Pub").load(networkLink+"/"+sessionStorage.getItem("visibilite")+"/"+sessionStorage.getItem("order")+ " #loadPub");

});     


  $(document).on('click', ".dropdown-item", function () {
 
    // filtre = toutes les publications
    if($(this).attr("id")=="allPubs"){
      sessionStorage.setItem("visibilite","reseau");
      
      $("#Pub").load(url+ " #loadPub");
    
    }   
  
    // filtre = toutes les publications publics
    else if($(this).attr("id")=="publicPubs"){
      sessionStorage.setItem("visibilite","public");
     
      $("#Pub").load(networkLink+"/public/"+sessionStorage.getItem("order")+ " #loadPub");
    
    } 
    // filtre = toutes les publications amis
    else if($(this).attr("id")=="amisPubs"){
      sessionStorage.setItem("visibilite","amis");
     
      $("#Pub").load(networkLink+"/amis/"+sessionStorage.getItem("order")+ " #loadPub");
    
    } 
    // Trie = affichage des publications selon les dates
    else if($(this).attr("id")=="datePubs"){
      sessionStorage.setItem("order","publications");
    
      $("#Pub").load(networkLink+"/"+sessionStorage.getItem("visibilite")+"/publications"+ " #loadPub");
    
    } 
    // Trie = affichage des publications selon les likes
    else if($(this).attr("id")=="likePubs"){
      sessionStorage.setItem("order","popularite");
   
      $("#Pub").load(networkLink+"/"+sessionStorage.getItem("visibilite")+"/popularite"+ " #loadPub");
    
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

$(document).on('click', "svg", function () {
  if($(this).attr("id").includes("iconAmis")){
  $("#alert").html("vous êtes déjà amis");
  $("#alert").show();
  $("#Member").load(networkLink+"/"+visibilite+"/"+order+ " "+"#loadMember");
}});
/*$(document).on('keyup', "input[type=text]", function (e) { 
  var code = e.key; 
  if(code==="Enter"){
  
 /* if($(this).attr("name").includes("updateComInput") ){
  //  $(this).parent("form").submit();
  } 
}
});  */
$(document).on('submit', "form", function (e) {
     
 //e.preventDefault();

      var sendFile=false;
      var dataString = $(this).serialize();
      var link="";
      var partToUpdate;
      var updatedContent;
      var partToUpdate2;
      var updatedContent2;
      var hideSinglePub="";
      if($(this).attr("name").includes("likeUnlikePub")) {
     
        link="/LikeUnlikePublication"; 
        e.preventDefault();
        var idpublication=$(this).find("input[type=hidden]").attr("value");
        partToUpdate= $(this).find("#LikePub");
     
        updatedContent="#loadLikePub"+idpublication;
  
      }
      else if($(this).attr("name").includes("deletePubForm")) {
        
        link="/deletePublication";
        e.preventDefault();
        var idpublication=$(this).attr("value");
      
        
        partToUpdate= $("#Pub");

        updatedContent= "#loadPub";

      }
      else if($(this).attr("name")==("addAmis")) {
        $("#alert").hide();
        link="/InviteAmis";
        e.preventDefault();
       
      
        
        partToUpdate= $("#Member");

        updatedContent= "#loadMember";

      }
     else if($(this).attr("name").includes("likeUnlikeCom")) {
        
        link="/LikeUnlikeCommentaire"; 
       
        e.preventDefault();
        var idcommentaire=$(this).find("input[type=hidden]").attr("value");
        partToUpdate= $(this).find("#LikeCom");
      
        updatedContent="#loadLikeCom"+idcommentaire;
      }

      else if($(this).attr("name").includes("AddCom")) {
        
        link="/createCommentaire"; 
       
        e.preventDefault();
        var idpublication=$(this).find("input[type=hidden]").attr("value");
        
        partToUpdate= $(this).parents().siblings().find("#ComPub"+idpublication);
     
        updatedContent="#loadComPub"+idpublication;
        partToUpdate2= $(this).parents().find("#ComsPub"+idpublication);
        
        updatedContent2="#loadComsPub"+idpublication;
     
      }

      else if($(this).attr("name")=="AddPub") {
        sessionStorage.setItem("order", "publications");
        sessionStorage.setItem("visibilite", "reseau");
        link="/createPublication";

        dataString = new FormData(this);
        sendFile=true;
        e.preventDefault();
        partToUpdate=$("#Page");
        updatedContent="#loadPage";
      }

      else if($(this).attr("name").includes("deleteComForm")) {
        
        link="/deleteCommentaire";
        e.preventDefault();
        var idpublication=$(this).attr("value");
        console.log("parents");
        console.log($(this).parents(".card rounded-0"));
        
        partToUpdate= $(this).parents().siblings().find("#ComPub"+idpublication);
     
        updatedContent="#loadComPub"+idpublication;
        partToUpdate2= $(this).parents().find("#ComsPub"+idpublication);
        updatedContent2="#loadComsPub"+idpublication;
      }
      else if($(this).attr("name").includes("updateCom")) {
        e.preventDefault();
        link="/updateCommentaire"; 
        var idpublication=$(this).parents(".card-body").attr("value");
        partToUpdate= $(this).parents().siblings().find("#ComPub"+idpublication);
     
        updatedContent="#loadComPub"+idpublication;
        partToUpdate2= $(this).parents().find("#ComsPub"+idpublication);
        updatedContent2="#loadComsPub"+idpublication;
        
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
        if (link==="/createCommentaire") {
          $(".collapse").collapse("hide");
        }
       
        partToUpdate.load(networkLink+"/"+visibilite+"/"+order+ " "+updatedContent);
        if( (link==="/createCommentaire") || (link==="/deleteCommentaire") || (link==="/updateCommentaire")){
         
         
          partToUpdate2.load(networkLink+"/"+visibilite+"/"+order+ " "+updatedContent2);

        }
          });
      }
      });