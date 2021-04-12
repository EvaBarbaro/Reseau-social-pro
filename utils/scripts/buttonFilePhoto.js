$('#newPhotoFile').click(function() {
  $('#photoFile').click();
});

$("#photoFile").change = function() {
  $("#formPhotoFile").submit();
};