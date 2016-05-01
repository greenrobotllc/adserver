@include('top')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Adsense Ad Compare
            <small>Control panel</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-md-6">
            <label>System Generated Code</label>
            <textarea class="form-control" rows="20">{{$adsense}}</textarea>
          </div>
          <div class="col-md-6">
            <label>Unmodified code</label>
            <textarea class="form-control" rows="20">{{$adsense_unmodified}}</textarea>
          </div>
            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@include('footer')