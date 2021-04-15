$(document).ready(function(){

    var click = true;

    for (var index = 0; index < $('.formUpdatePost').length; index++) {
        $('#updateTitlePost'+index).on('click', function(event){
            console.log(event.target.nextElementSibling);
            if (click) {
                $(event.target.nextElementSibling).attr("readonly", false);
                $(event.target.nextElementSibling).removeClass("fakeTextInput");
                click = false;
            } else if (click == false) {
                $(event.target.nextElementSibling).attr("readonly", true);
                $(event.target.nextElementSibling).addClass("fakeTextInput");
                click = true;
            }
        });
    }
 });