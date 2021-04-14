$(document).ready(function() {
    for (var index = 0; index < $('.form-check').length; index++) {
        $("#checkStatut"+index).on('click', {'index': index}, function(event) {
            if ($("#checkStatut"+event.data.index).is(':checked')) {
                $("#checkStatut"+event.data.index).val(1);
            } else {
                $("#checkStatut"+event.data.index).val(0);
            }
        });
    }
});