<hr>
<div class="row">
<div class="col-md-12">
    <h3>Ad Details RPM (Today)</h3>
</div>
    <div class="col-md-12">
    <div class="dataTables_wrapper form-inline dt-bootstrap">
      <table id="expdata" class="table table-bordered table-hover">
        <thead>
            <tr>
              <th>Ad id</th>
              <th>Name</th>
              <th>Type</th>
              <th>Weight</th>
              <th>RPM</th>
              <th>Adzone</th>
            </tr>
        </thead>
        <tbody>
         @foreach($adsense_ads as $ad)
            <tr>
              <td>{{$ad->getadsense->id}}</td>
              <td>{{$ad->getadsense->name}}</td>
              <td>Adsense</td>
              <td>{{$ad->weight*100}}%</td>
              <!-- <td>${{$adsense_rpm->last_rpm}}</td> -->
              <td>${{$ad->rpm}}</td>
              <td>{{$ad->getadzone->name}}</td>
            </tr>
        @endforeach

        @foreach($lsm_ads as $ad)
            <tr>
              <td>{{$ad->getlsm->id}}</td>
              <td>{{$ad->getlsm->name}}</td>
              <td>LSM (Life Street Media)</td>
              <td>{{$ad->weight*100}}%</td>
              <td>${{$lsm_rpm->last_rpm}}</td>
              <td>{{$ad->getadzone->name}}</td>
            </tr>
        @endforeach


        @foreach($mopub_ads as $ad)
            <tr>
              <td>{{$ad->getmopub->id}}</td>
              <td>{{$ad->getmopub->name}}</td>
              <td>MoPub</td>
              <td>{{$ad->weight*100}}%</td>
              <td>${{$ad->rpm}}</td>
              <td>{{$ad->getadzone->name}}</td>
            </tr>
        @endforeach

        @foreach($liberty_ads as $ad)
            <tr>
              <td>{{$ad->getliberty->id}}</td>
              <td>{{$ad->getliberty->name}}</td>
              <td>Liberty</td>
              <td>{{$ad->weight*100}}%</td>
              <td>${{$ad->rpm}}</td>
              <td>{{$ad->getadzone->name}}</td>
            </tr>
        @endforeach

        @foreach($other_ads as $ad)
            <tr>
              <td>{{$ad->getother->id}}</td>
              <td>{{$ad->getother->name}}</td>
              <td>Other Ads</td>
              <td>{{$ad->weight*100}}%</td>
              <td>${{$ad->getother->rpm}}</td>
              <td>{{$ad->getadzone->name}}</td>
            </tr>
        @endforeach
        </tbody>

      </table>
      </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#expdata').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#expdata tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );
</script>
<style type="text/css">
    tr.group
    {
            font-weight: 900;
    background-color: #ccc !important;
    }
</style>