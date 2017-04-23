@include('top')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          
        </section>

        <!-- Main content -->




        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
              @if($lsm_email)
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup>{{$lsm_rpm->last_rpm}}</h3>
                  <p>LifeStreet Media RPM</p>
                </div>
                @else
                <div class="inner">
                  <h3><sup style="font-size: 20px">Not Configured Yet</sup></h3>
                  <p>LifeStreet Media RPM</p>
                </div>
                @endif
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                @if($lsm_email)
                <a href="{{URL::to('refresh')}}" class="small-box-footer">Last Updated: {{$lsm_rpm->updated_at}}<i class="fa fa-refresh"></i></a>
                @endif
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
              @if($adsense_pub)
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup>{{$adsense_rpm->last_rpm}}</h3>
                  <p>Google Adsense RPM</p>
                </div>
                @else
                <div class="inner">
                  <h3><sup style="font-size: 20px">Not Configured Yet</sup></h3>
                  <p>Google Adsense RPM</p>
                </div>
                @endif
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                @if ($adsense_pub)
                <a href="{{URL::to('refresh')}}" class="small-box-footer">Last Updated: {{$adsense_rpm->updated_at}}<i class="fa fa-refresh"></i></a>
                @endif
              </div>
            </div><!-- ./col -->
			
			
			
			
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
              @if($mopub_api_key)
                <div class="inner">
                  <h3><sup style="font-size: 20px">$</sup>{{$mopub_rpm->last_rpm}}</h3>
                  <p>MoPub RPM</p>
                </div>
                @else
                <div class="inner">
                  <h3><sup style="font-size: 20px">Not Configured Yet</sup></h3>
                  <p>MoPub RPM</p>
                </div>
                @endif
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                @if ($mopub_api_key)
                <a href="{{URL::to('refresh')}}" class="small-box-footer">Last Updated: {{$mopub_rpm->updated_at}}<i class="fa fa-refresh"></i></a>
                @endif
              </div>
            </div><!-- ./col -->
			
			
			
			
			
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->

            </div><!-- ./col -->          
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
<div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">LifeStreet Media Login Details(for RPM)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{URL::to('savelsm')}}" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" value="{{$lsm_email}}" name="lsm_email" class="form-control" id="inputEmail3" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group" >
                      <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" value="{{$lsm_pass}}" name="lsm_pass" class="form-control" id="inputPassword3" placeholder="Password">
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <button type="submit" class="btn btn-info pull-right">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
            </div>
			
			
			
			<div class="col-md-6">
			              <!-- Horizontal Form -->
			              <div class="box box-info">
			                <div class="box-header with-border">
			                  <h3 class="box-title">Adsense Publisher ID(for RPM)</h3>
			                </div><!-- /.box-header -->
			                <!-- form start -->
			                <form class="form-horizontal" action="{{URL::to('saveadsense')}}" method="post">
			                  <div class="box-body">
			                    <div class="form-group">
			                      <label for="inputEmail3" class="col-sm-2 control-label">Publisher ID</label>
			                      <div class="col-sm-10">
			                        <input type="text" class="form-control" value="{{$adsense_pub}}" id="inputEmail3" placeholder="pub-xxxxxxxxxxxxxxxx" name="adsense_pub">
			                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

			                      </div>
			                    </div>

                    
			                  </div><!-- /.box-body -->
			                  <div class="box-footer">
			                    <button type="submit" class="btn btn-info pull-right">Save</button>
			                  </div><!-- /.box-footer -->
			                </form>
			              </div><!-- /.box -->
			            </div>
			
			
			
			
			<div class="col-md-6">
			              <!-- Horizontal Form -->
			              <div class="box box-info">
			                <div class="box-header with-border">
			                  <h3 class="box-title">MoPub API Details</h3>
			                </div><!-- /.box-header -->
			                <!-- form start -->
			                <form class="form-horizontal" action="{{URL::to('savemopub')}}" method="post">
			                  <div class="box-body">
			                    <div class="form-group">
			                      <label for="inputEmail3" class="col-sm-2 control-label">API key</label>
			                      <div class="col-sm-10">
			                        <input type="text" value="{{$mopub_api_key}}" name="mopub_api_key" class="form-control" id="inputEmail3" placeholder="MoPub API Key">
			                      </div>
			                    </div>
			                    <div class="form-group" >
			                      <label for="inputPassword3" class="col-sm-2 control-label">Campaign report ID</label>
			                      <div class="col-sm-10">
			                        <input type="text" value="{{$mopub_report_id}}" name="mopub_report_id" class="form-control" id="inputPassword3" placeholder="MoPub Report ID">
			                      </div>
			                    </div>
                    
			                  </div><!-- /.box-body -->
			                  <div class="box-footer">
			                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

			                    <button type="submit" class="btn btn-info pull-right">Save</button>
			                  </div><!-- /.box-footer -->
			                </form>
			              </div><!-- /.box -->
			            </div>
			
			
			


</div>


          <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Top 10 Custom Ads RPM</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Provider ID</th>
                          <th>Company</th>
                          <th>Slug</th>
                          <th>RPM</th>
                          <th>Last Updated</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($custom_add as $d)
                <tr id="cus_{{$d->id}}">
                  <td>{{$d->id}}</td>
                  <td>{{$d->name}}</td>
                  <td><code>{{$d->slug}}</code></td>
                  <td>${{$d->rpm}}</td>
                  <td>{{$d->updated_at}}</td>
                </tr>
                @endforeach
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Add New Custom Ad</a> -->
                  <a href="{{URL::to('otherads')}}" class="btn btn-sm btn-default btn-flat pull-right">View More Details</a>
                </div><!-- /.box-footer -->
              </div>
          <div class="row">
            <!-- Left col -->


          </div><!-- /.row (main row) -->

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.5/clipboard.min.js"></script>

@include('footer')
