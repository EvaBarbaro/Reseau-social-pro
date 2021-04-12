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
        else if($(this).attr("id")=="like.png") {
            $(this).attr("src",filename+"public/img/unlike.png");
            $(this).attr("id","unlike.png");
        }
        
      }); 
     
});
function test(a){
    alert("clicked");
    alert(a);

    var xhttp = new XMLHttpRequest();
    alert("1");
    xhttp.onreadystatechange = function() {
        alert("2");
      if (this.readyState == 4 && this.status == 200) {
        alert(this.readyState);
      // document.getElementById("demo").innerHTML = this.responseText;
      }else {
          alert(this.status);
      }
    };
    alert("3");
    xhttp.open("GET", filename+"monReseau/test"+str, true);
    alert("4");
    xhttp.send();
    alert("5");

   
 }