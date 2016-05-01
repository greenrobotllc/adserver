$(document).ready(function(){
	 $('#data').DataTable();

$('#myModal').on('hide.bs.modal', function (e) {
  $(".modal-body").html("Loading..."); // stops modal from being shown
});
$('#myModal').on('show.bs.modal', function (e) {
  $(".modal-body").html("Loading..."); // stops modal from being shown
});
$('#editModal').on('hide.bs.modal', function (e) {
  $("#editModalBody").html("Loading..."); // stops modal from being shown
});
$('#editModal').on('show.bs.modal', function (e) {
  $("#editModalBody").html("Loading..."); // stops modal from being shown
});


});


function setData(id)
{
	$.ajax({
  method: "POST",
  url: url_for_ad,
  data: { id: id, "_token":token }
})
  .done(function( msg ) {
     $(".modal-body").html(msg);
  });
}

function setEdit(dataid)
{
  $.ajax({
  method: "POST",
  url: url_for_ad_edit,
  data: { id: dataid, "_token":token }
})
  .done(function( msg ) {
     $(".edit-modal-body").html(msg);
     // $("#editModal").modal('show');
  });

}



