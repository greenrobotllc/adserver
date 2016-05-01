<hr>
<div class="row">
<div class="col-md-12">
	<h3>AdZone Views (Today)</h3>
</div>
	<div class="col-md-12">
	<div class="dataTables_wrapper form-inline dt-bootstrap">
      <table id="data" class="table table-bordered table-hover">
        <thead>
	        <tr>
	          <th>Adzone id</th>
	          <th>Name</th>
	          <th>Total Views</th>
	        </tr>
        </thead>
        <tbody>
         @foreach($adzones_view_daily as $avd)
	        <tr>
	          <td>{{$avd->getadzone->id}}</td>
	          <td>{{$avd->getadzone->name}}</td>
	          <td>{{$avd->totalviews}}</td>
	        </tr>
        @endforeach
        </tbody>

      </table>
      </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	 $('#data').DataTable();
	});
</script>
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">

<script type="text/javascript" src="{{asset('js/jquery.datatables.js')}}"></script>
