@include('top')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Google API Console JSON
            <small>Control panel</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <form action="{{URL::to('googleapiconsole')}}" method="POST">
        <section class="content">
          <div class="col-md-12">
            <label>Your Google JSON (Paste Your Configration) <small title="HELP"><a href="{{URL::to('help')}}">How to get this file?</a></small></label>
             @if(Session::get('message'))
              <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                    {{Session::get('message')}}
                  </div>
                  @endif
                  @if(Session::get('error'))
                  <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>  <i class="icon fa fa-ban"></i> Error!</h4>
                   {{Session::get('error')}}
                  </div>
                  @endif
                   @if (count($errors) > 0)
              <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>  <i class="icon fa fa-ban"></i> Error!</h4>
                    <ul>

                    @foreach ($errors->all() as $message)
                    <li>{{$message}}</li>
                    @endforeach
                  </ul>
                  </div>
                   @endif
            <textarea name="data" class="form-control" rows="20" placeholder="PASTE CONTENT HERE">{{$content}}</textarea>
          </div>
          <!-- <div style="height: 10px;" class="col-md-12"></div> -->
          <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px">
            <center>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <button type="submit" class="btn btn-primary">SAVE Configrations</button>
                      </center>
          </div>

            </section><!-- /.Left col -->
</form>
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@include('footer')