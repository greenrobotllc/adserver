@include('top')
<!-- AMMAP -->
<link rel="stylesheet" href="{{asset('plugins/ammap/ammap.css')}}" type="text/css">
<script src="{{asset('plugins/ammap/ammap.js')}}" type="text/javascript"></script>
        <!-- map file should be included after ammap.js -->
<script src="{{asset('plugins/ammap/worldLow.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/ammap/black.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('plugins/ammap/custom.js')}}"></script>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reports
            <small>Control panel</small>
          </h1>
          
        </section>

        <!-- Main content -->




        <section class="content">
        <div class="box">
        <div class="box-body">
        <div class="row" style="padding-bottom: 10px">
          <div class="col-md-12">
            <div class="pull-right">
            <div class="col-md-4"><button id="btn_today" data-name="onoffSwitch" class="ova activated ova--ujarak ova--border-thin ova--text-thick">Today</button></div>
<div class="col-md-4 center hidden-xs hidden-sm">
              <div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
    <label class="onoffswitch-label" for="myonoffswitch"></label>
</div>
</div>
<div class="col-md-4">
<button id="btn_yesterday" data-name="onoffSwitch" class="ova ova--ujarak ova--border-thin ova--text-thick">Yesterday</button>
</div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right" style="display: none">
                  <li><a href="#yest" data-toggle="tab">Yesterday</a></li>
                  <li  class="active"><a href="#toda" data-toggle="tab">Today</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="toda">
                      <!-- todays -->
                     @include('reports.earnings')
                     <!--rports end-->
                     @include('reports.views')
                     @include('reports.geographic')
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="yest">
                     <!-- yesterday -->
                    @include('reports.yesterday.earnings')
                    @include('reports.yesterday.views')
                    @include('reports.yesterday.geographic')
                  </div>
                  <!-- /.tab-pane -->
                  
                </div>
                <!-- /.tab-content -->
            </div>
          </div>
        </div>
          <!-- nav-tabs-custom -->
          <!-- Small boxes (Stat box) -->
         
         
          <!-- report charts -->
          @include('reports.incomechart')
          @include('reports.rpm')          
          @include('reports.adzoneviews')
          @include('reports.addetails')
          <!-- Main row -->
          <div class="row"></div>

          <div class="row">
            <!-- Left col -->


          </div><!-- /.row (main row) -->

          </div>
</div>
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->  
<script type="text/javascript">

  function toggleSelf(param = false)
  {
        // $("div[data-name=today]").toggle();
      if (!param)
      {
        if ($("button[id=btn_today]").hasClass('activated'))
        {
          param = "yesterday";
        }else{
          param = "today";
        }
      }else{
        if (param == "yesterday" && $("button[id=btn_today]").hasClass('activated'))
        {
         $("input[name=onoffswitch]").click();
        }else if (param == "today" && $("button[id=btn_yesterday]").hasClass('activated'))
        {
          $("input[name=onoffswitch]").click();
        }
      }
      if (param == "today")
      {
        $('#btn_today').addClass('activated');
        $('#btn_yesterday').removeClass('activated');
        $('a[href=#toda]').click();
      }else{
        $('#btn_today').removeClass('activated');
        $('#btn_yesterday').addClass('activated');
        $('a[href=#yest]').click();
      }
      // $("div[data-name=yesterday]").toggle();
  }

  $("input[name=onoffswitch]").click(function(){
    toggleSelf();
  });

$("button[id=btn_yesterday]").click(function(){
  toggleSelf("yesterday");
});
$("button[id=btn_today]").click(function(){
  toggleSelf("today");
});

</script>





@include('footer')          
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
