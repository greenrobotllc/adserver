$(document).ready(function(){
	 $('#data').DataTable();
$('#myModal').on('hide.bs.modal', function (e) {
  $(".modal-body").html("Loading..."); // stops modal from being shown
});
$('#myModal').on('show.bs.modal', function (e) {
  $(".modal-body").html("Loading..."); // stops modal from being shown
});



// editModal


$('#editModal').on('hide.bs.modal', function (e) {
  $("#editModalBody").html("Loading..."); // stops modal from being shown
});
$('#editModal').on('show.bs.modal', function (e) {
  $("#editModalBody").html("Loading..."); // stops modal from being shown
});
});

function delete_data(dataid)
{
	noty({
	text: 'Are you sure you want to delete this add?',
	layout: 'center',
	 type: 'alert',
	  timeout: 3,
	buttons: [
		{addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {

				// this = button element
				// $noty = $noty element

				$noty.close();
				// 
				$.ajax({
 				 method: "DELETE",
 				 url: url_for_ad_delete,
 				 data: { id: dataid, "_token":token }
				}).done(function( msg ) {
     				noty({layout: 'center',theme:'relax',timeout: 1500,text: msg, type: 'success'});
     				$("#cus_"+dataid).hide();
  				}).error(function() {
  				noty({layout: 'center',theme:'relax',timeout: 1500,text: "Unable to Update Data", type: 'error'});
  				});
			}
		},
		{addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
				$noty.close();
				noty({layout: 'center',theme:'relax',timeout: 1500,text: 'Ad not Deleted', type: 'info'});
			}
		}
	]
});
}


function setData(dataid)
{
	$.ajax({
  method: "POST",
  url: url_for_ad,
  data: { id: dataid, "_token":token }
})
  .done(function( msg ) {
     $(".modal-body").html(msg);
      $(".modal-body").find("script").each(function(i) {
                    eval($(this).text());
                });
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
  });

}

//Co