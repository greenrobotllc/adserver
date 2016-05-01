<hr>
<div class="row">
<div class="col-md-12">
	<h3>Geographic RPM (Today)</h3>
</div>
	<div class="col-md-12">
	<div class="dataTables_wrapper form-inline dt-bootstrap">
      <table id="geoTodaydata" class="table table-bordered table-hover">
        <thead>
	        <tr>
	          <th>Country</th>
	          <th>Type</th>
	          <th>RPM</th>
	          <th>Earning</th>
	        </tr>
        </thead>
        <tbody>
         @foreach($map_data_today as $avd)
	        <tr>
	          <td>{{$avd->country}}</td>
	          <td>{{$avd->type}}</td>
	          <td>${{$avd->impressions}}</td>
	          <td>${{$avd->cost}}</td>

	        </tr>
        @endforeach
        </tbody>

      </table>
      </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	 $('#geoTodaydata').DataTable();
	});
</script>
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">

<script type="text/javascript" src="{{asset('js/jquery.datatables.js')}}"></script>
