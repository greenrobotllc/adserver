<div class="row">
	<div class="col-md-12">
	<h2>RPM Performance Chart (Week)</h2>

		                  <div class="chart tab-pane" id="rpm-chart" style="position: relative; height: 300px;"></div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){
//prepare data
var lsm = {};
var adsense = {};

@foreach($lsm_rpm_week as $lew)
lsm['{{$lew->date}}']={{$lew->rpm}};
@endforeach

@foreach($adsense_rpm_week as $aew)
adsense['{{$aew->date}}']={{$aew->rpm}};
@endforeach
//done
    var area = new Morris.Line({
    element: 'rpm-chart',
    resize: true,
    data: [
    @for($x=7; $x>=0; $x--)
          {y: '{{date('Y-m-d', strtotime("-".$x." Days"))}}', item1: lsm['{{date('Y-m-d', strtotime("-".$x." Days"))}}'], item2:adsense['{{date('Y-m-d', strtotime("-".$x." Days"))}}']},

    @endfor

    ],
    xkey: 'y',
    ykeys: ['item1', 'item2'],
    labels: ['LSM', 'Adsense'],
    lineColors: ['#00c0ef', '#00a65a'],
    hideHover: 'auto'
  });


  });
</script>