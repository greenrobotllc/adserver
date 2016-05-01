
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" id="edit_add" method="POST">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label" required>Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" value="{{$data->name}}" class="form-control" id="name" placeholder="Name" minlength="3" maxlenght="50"  required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="rpm" class="col-sm-2 control-label">RPM</label>
                      <div class="col-sm-10">
                        <input type="number" step="0.001" min="0" class="form-control" name="rpm" id="rpm" placeholder="RPM" value="{{$data->rpm}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="adcode" class="col-sm-2 control-label">Ad Code</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="adcode"  placeholder="Ad Code" minlength="5" required>{{$data->adcode}}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="slug" value="{{$data->slug}}">

                      </div>

                    </div>
                    
                </form>
                </div>
              </div>


<script type="text/javascript">
	
	$("#saveadds").click(function(e)
	{
		e.preventDefault();
		var form = $("#edit_add");
		$.ajax({
 				 method: "PUT",
 				 url: "{{URL::to('editcustomadd')}}",
 				 data: form.serialize(),
				}).done(function( msg ) {
					$("#editModal").modal('hide');
     				noty({layout: 'center',theme:'relax',timeout: 1500,text: msg, type: 'success'});
  				}).error(function() {
  				noty({layout: 'center',theme:'relax',timeout: 1500,text: "Unable to Delete Data", type: 'error'});
  				});
	});
</script>