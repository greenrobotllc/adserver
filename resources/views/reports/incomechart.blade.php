<div class="row">
	<div class="col-md-6">
	<h2>Income Performance Chart (Week)</h2>
	<h4>Total Income: ${{$total_weekly_income}}</h4>

		                  <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px;"></div>
	</div>
	<div class="col-md-6">
	<h2>View Chart (Week)</h2>
	<h4>Total Views: {{$lsm_view_week + $adsense_view_week + $other_view_week}}</h4>
		<div class="chart tab-pane" id="view-chart" style="position: relative; height: 300px;"></div>	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){
//prepare data
var lsm = {};
var adsense = {};

@foreach($lsm_earn_week as $lew)
lsm['{{$lew->date}}']={{$lew->income}};
@endforeach

@foreach($adsense_earn_week as $aew)
adsense['{{$aew->date}}']={{$aew->income}};
@endforeach
//done
    var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    data: [
    @for($x=7; $x>=0; $x--)
          {y: '{{date('Y-m-d', strtotime("-".$x." Days"))}}', item1: lsm['{{date('Y-m-d', strtotime("-".$x." Days"))}}'], item2:adsense['{{date('Y-m-d', strtotime("-".$x." Days"))}}']},

    @endfor

    ],
    xkey: 'y',
    ykeys: ['item1', 'item2'],
    labels: ['LSM', 'Adsense'],
    lineColors: ['#D81B60', '#00a65a'],
    hideHover: 'auto'
  });



    var donut = new Morris.Donut({
    element: 'view-chart',
    resize: true,
    colors: ["#D81B60", "#00a65a", "#ff851b"],
    data: [
      {label: "LSM Views", value: {{$lsm_view_week}}},
      {label: "Adsense Views", value: {{$adsense_view_week}}},
      {label: "Other Views", value: {{$other_view_week}}}
    ],
    hideHover: 'auto'
  });

  });
</script>