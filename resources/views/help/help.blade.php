@include('top')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            Help
            <small>Control panel</small>
          </h1>
      </section>
        <section class="content">
          <div class="box">
       
        <div class="box-body">
         
          <div class="row">
            <div class="col-md-12">
            <h2>Documentation</h2>
              <p>Following are the documentation to setup this app</p></div>
            <!-- SET RPM -->
            <div class="col-md-12">
              <hr>
              <h3>How to make App on Google Developer Console?</h3>
               <p>
               <ol>
                 <li>Go to https://console.developers.google.com</li>
                                  <br/><br/><br/>

                 <li>Create a new Project and You will see this screen 
                    <div class="col-sm-12">
                       <img class="col-sm-5 img-responsive" src="{{asset('img/help/q1-1.png')}}">
                    </div>
                    <hr>
                  </li>
                                   <br/><br/><br/>

                 <li>Now Click on <b>Enable API and get credentials like keys</b>  and you will see this screen
                   <div class="col-sm-12">
                      <img class="col-sm-5 img-responsive" src="{{asset('img/help/q1-2.png')}}">
                   </div>
                    <hr>
                 </li>
                                  <br/><br/><br/>

                 <li>
                    Click on Adsense Management API and enable this plugin
                    <hr>
                 </li>
                                  <br/><br/><br/>

                 <li>Click on credentials
                   <div class="col-sm-12">
                      <img class="col-sm-5 img-responsive" src="{{asset('img/help/q1-3.png')}}">
                   </div>
                    <hr>                 
                 </li>
                                  <br/><br/><br/>

                 <li>Click on New Credentials and then Click on OAuth client ID
                   <div class="col-sm-12">
                      <img class="col-sm-5 img-responsive" src="{{asset('img/help/q1-4.png')}}">
                   </div>
                    <hr>                 
                 </li>
                                  <br/><br/><br/>

                 <li>
                   Now Select Web Application and fill the url and redirect url as your local or server has and then download the JSON config or select client id and secret id 
                   <div class="col-sm-12">
                    <img class="col-sm-5 img-responsive" src="{{asset('img/help/q1-5.png')}}">
                 </div>
                    <hr>                 
                 </li>
                                <br/><br/><br/>

                 <li>
                   Now you are done! Just setup your app with this. Open code 
                  <code>/adserver/config/google_client_secret.json</code>
                  Replace your 
                  <ul>
                    <li>Client id</li>
                    <li>Client Secret</li>
                    <li>Redirect Uris</li>
                  </ul>
                 </li>
                                  <br/><br/><br/>
                 <li>That's it</li>
               </ol>
              </p>
            </div>


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

