@include('top')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Adsense
            <small>Control panel</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-code"></i>
                  <h3 class="box-title">Import Your Adsense Code</h3>
                </div><!-- /.box-header -->
                 @if (count($errors) > 0)
        <div class="callout callout-danger">
        {{ $errors->first('error') }}
      </div>
      @endif
                                  <form method="post" action="{{url('saveadsensecode')}}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="box-body">
                    <div class="form-group">
                      <!-- <label>Textarea</label> -->
                      <textarea class="form-control" style="height:230px;" name="adsense_code" rows="3" placeholder="<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
<!-- AD -->
<ins class='adsbygoogle'
     style='display:inline-block;width:XXXpx;height:XXXpx'
     data-ad-client='ca-pub-XXXXXXXXXXXXXXXX'
     data-ad-slot='XXXXXXXXXX'></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
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