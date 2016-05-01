@include('top')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            API KEYS
            <small>Control panel</small>
          </h1>
      </section>
        <section class="content">
          <div class="box">
       
        <div class="box-body">
           URL:  <code>{{URL::to('/api')}}</code><br>

          APP TOKEN <code>{{$token}}</code> <br>
<!--           APP SECRET <code>{{$secret}}</code>-->
            <div class="row">
              <hr>
            <div class="col-md-4"></div>
          <!-- <div class="col-md-2 text-center">
            <a href="{{URL::to('api')}}" class="btn btn-block btn-primary">REGENERATE NOW</a>
          </div> -->
          <div class="col-md-4"></div>
          </div>
          <div class="row">
            <br>
<div class="col-md-2"></div>
            <div class="col-md-8">

            <table class="table table-condensed">
                    <tbody><tr>
                      <th>API</th>
                      <th>Status</th>
                    </tr>
                    <tr>
                      <td>Validation</td>
                      <td><i class="fa fa-fw fa-heartbeat" style="color:#4CAF50"></i> active </td>

                    </tr>
                    <tr>
                      <td>SET RPM</td>
                      <td><i class="fa fa-fw fa-heartbeat" style="color:#4CAF50"></i> active </td>

                    </tr>
                   <!--  <tr>
                      <td>Generate Keys</td>
                      <td><i class="fa fa-fw fa-heartbeat" style="color:#4CAF50"></i> active </td>

                    </tr> -->
                  </tbody></table></div>
                  <div class="col-md-2"></div>
          </div>
          <div class="row">
            <div class="col-md-12">
            <h2>Documentation</h2>
              <p>This API is used to set CUSTOM Add RPM. FIRST REQUEST MUST BE THE VALIDATION REQUEST</p></div>
         <!--    <div class="col-md-12">
              
              <h3>VALIDATION</h3>
              <p>
                <h4>Request Method</h4>
                <code>POST</code>
                <h4>Parameters</h4>
                <code>appkey = &lt; YOUR API PUBLIC KEY&gt; <br /> appsecret = &lt; YOUR API SECRET KEY&gt;</code>
                <h4>RESPONSE (json)</h4>
                <h5>On Success (200) <span class="fa fa-fw fa-circle" style="color:#4CAF50"></span></h5>
                <p>
                  <code>{"success":"API Credentials Verified","token":"XXXXXXXXXXXXXXXXXX"}</code>
                </p>
                <h5>On Error (403) <span class="fa fa-fw fa-circle" style="color:#F44336"></span></h5>
                <p><code>{"error": "Invalid API Credentials"}</code></p>
              </p>
            </div> -->
            <!-- SET RPM -->
            <div class="col-md-12">
              <hr>
              <h3>SET RPM</h3>
               <p>
                <h4>Request Method</h4>
                <code>POST</code>
                <h4>Parameters</h4>
                <code>addkey = &lt; YOUR CUSTOM ADD SLUG&gt; <br /> value= &lt; YOUR RPM VALUE value in USD($) format 0.10, 0.005 &gt;<br /> action= rpm <br/> token = XXXXXXXXXXXXXXXXXX</code>
                <h4>RESPONSE (json)</h4>
                <h5>On Success (200) <span class="fa fa-fw fa-circle" style="color:#4CAF50"></span></h5>
                <p>
                  <code>{"success":"RPM VALUE UPDATED"}</code>
                </p>
                <h5>On Error (400) <span class="fa fa-fw fa-circle" style="color:#F44336"></span></h5>
                <p><code>{"error": "Invalid API Request"}</code></p>
              </p>
            </div>
            <!-- GENERATE KEYS -->
<!--             <div class="col-md-12">
              <hr>
              <h3>Generate KEYS</h3>
               <p>
                <h4>Request Method</h4>
                <code>POST</code>
                <h4>Parameters</h4>
                <code>action= generate<br/> token = XXXXXXXXXXXXXXXXXX</code>
                <h4>RESPONSE (json)</h4>
                <h5>On Success (200) <span class="fa fa-fw fa-circle" style="color:#4CAF50"></span></h5>
                <p>
                  <code>{
    "api": {
        "app_key": "YOUR API PUBLIC KEY",
        "app_secret": "YOUR API SECRET KEY"
    }
}</code>
                </p>
                <h5>On Error (400) <span class="fa fa-fw fa-circle" style="color:#F44336"></span></h5>
                <p><code>{"error": "Invalid API Request"}</code></p>
              </p>
            </div> -->

          </div>
         

        </div>
        <!-- /.box-body -->

      </div>

        </section>

        <!-- Main content -->
    

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@include('footer')

