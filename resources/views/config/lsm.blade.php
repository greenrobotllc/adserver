@include('top')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            LifeStreet Media
            <small>Control panel</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
                    <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-code"></i>
                  <h3 class="box-title">Import Your LSM Code</h3>
                </div><!-- /.box-header -->
                        @if (count($errors) > 0)
        <div class="callout callout-danger">
        {{ $errors->first('error') }}
      </div>
      @endif
                                  <form method="post" action="{{url('savelsmcode')}}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="box-body">
                  <div class="form-group">
                      <label>Header Script</label>
                      <input class="form-control" name="lsm_header" placeholder="<script src='//ads.lfstmedia.com/getad?site=XXXXXX' type='text/javascript'></script>" value="{{$header}}">
                    </div>
                    <div class="form-group">
                      <label>JS Ad Tag Code</label>
                      <textarea style="height:230px" class="form-control" name="lsm_code" rows="3" placeholder="<script type='text/javascript'>
    //<![CDATA[
        LSM_Slot({
            adkey: 'XXX',
            ad_size: 'XXX',
            slot: 'XXXX'
        });
    //]]>
</script>">{{$code}}</textarea>
                    </div>
                  
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                  </div>
                  </form>
              </div><!-- /.box -->
            </div>
            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@include('footer')