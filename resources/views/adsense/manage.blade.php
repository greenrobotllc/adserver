@include('top')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
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
           <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Adsense Listing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" method="POST" action="{{URL::to('adsense')}}">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label" required>Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" minlength="3"  maxlenght="50" required>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="rpm" class="col-sm-2 control-label">AdZone</label>
                      <div class="col-sm-10">
                        <select name="adzone" class="form-control">
                        @foreach($zones as $z)
                          <option value="{{$z->id}}">{{$z->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="adcode" class="col-sm-2 control-label">Ad Code</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" style="height:230px;" name="adcode" minlength="10" placeholder="<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
<!-- AD -->
<ins class='adsbygoogle'
     style='display:inline-block;width:XXXpx;height:XXXpx'
     data-ad-client='ca-pub-XXXXXXXXXXXXXXXX'
     data-ad-slot='XXXXXXXXXX'></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <button type="submit" class="btn btn-info">Add new Adsense</button>
                      </div>

                    </div>
                    
                </form>
                </div>
              </div>
              <hr >
              <table id="data" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Add id</th>
                  <th>Name</th>
                  <th>AdZone</th>
                  <th>Weight</th>
                  <th>Total Views</th>
                  <th>Last Updated</th>
                  <th>Controls</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $d)
                <tr id="cus_{{$d->id}}">
                  <td>{{$d->id}}</td>
                  <td>{{$d->name}}</td>
                  <td>{{$d->zonename}}</td>
                  <td>{{$d->weight}}</td>
                  <td>{{$d->views}}</td>
                  <td>{{$d->updated_at}}</td>
                  <td><a href="#" data-toggle="modal" onclick="setData({{$d->id}})" data-target="#myModal">View</a> - <a href="#" data-toggle="modal" onclick="setEdit({{$d->id}})" data-target="#editModal">Edit</a> - <a href="#" onclick="delete_data({{$d->id}})">Delete</a></td>
                </tr>
                @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         
            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@include('footer')
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="width:770px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Ad</h4>
      </div>
      <div class="modal-body">
        Loading...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Ad</h4>
      </div>
      <div class="edit-modal-body" id="editModalBody">
        Loading...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveadds">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">

 url_for_ad = "{{URL::to('adsenseview')}}";
 url_for_ad_delete = "{{URL::to('adsense')}}";
 url_for_ad_edit = "{{URL::to('adsenseeditview')}}";
 token = "{{ csrf_token() }}";
</script>

<script type="text/javascript" src="{{asset('plugins/noty/packaged/jquery.noty.packaged.min.js')}}"></script>

<script type="text/javascript" src="{{asset('plugins/noty/themes/bootstrap.js')}}"></script>


<script type="text/javascript" src="{{asset('js/pages/otherads.js')}}"></script>


<script type="text/javascript" src="{{asset('js/jquery.datatables.js')}}"></script>
