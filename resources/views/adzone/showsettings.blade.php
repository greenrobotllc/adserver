
              <div class="row">
                <div class="col-md-10">
                  <form class="form-horizontal" id="edit_add" method="POST">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label" required>Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" value="{{$data->name}}" class="form-control" id="name" placeholder="Name" minlength="3" maxlenght="50" required>
                      </div>
                    </div>
                     

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="id" value="{{$data->id}}">

                      </div>

                    </div>
                    
                </form>
                </div>
              </div>


<script type="text/javascript">
	
	$("#saveadds").click(function(e)
	{
    $("#saveadds").attr('disabled','disabled');
		e.preventDefault();
		var form = $("#edit_add");
		$.ajax({
 				 method: "PUT",
 				 url: "{{URL::to('adzone')}}",
 				 data: form.serialize(),
				}).done(function( msg ) {
					$("#editModal").modal('hide');
          $("#saveadds").removeAttr('disabled');
     				noty({layout: 'center',theme:'relax',timeout: 1500,text: msg, type: 'success'});
              setTimeout(function(){
                 window.location.reload(1);
              }, 2000);
  				}).error(function() {
          $("#saveadds").removeAttr('disabled');
  				noty({layout: 'center',theme:'relax',timeout: 1500,text: "Unable to Update Data", type: 'error'})
  				});
	});
</script>