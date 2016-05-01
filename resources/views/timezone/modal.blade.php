<div class="modal modal-danger fade"  tabindex="-1" role="dialog" id="timezone-modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> -->
                    <h4 class="modal-title">Set Your TimeZone</h4>
                  </div>
                  <div class="modal-body">
                    <h1>Timezone</h1>
                    <form action="{{url('timezone')}}" method="POST" id="save_timezone_form">
                    @include("timezone.timezone")
                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button id="save_my_timezone" type="button" class="btn btn-outline">Save changes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

          <script type="text/javascript">
            $("#save_my_timezone").click(function(){
              $("#save_timezone_form").submit();
            });
          </script>