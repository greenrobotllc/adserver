      <header class="main-header">
        <!-- Logo -->
        <a href="{{URL::to('admin')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Ad</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Ad</b>Server</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    <p>
                      Admin
                      <small>administrator</small>
                      <small>Timezone: {{\Config::get('app.timezone')}}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                  <div class="pull-left">
                      <a href="#" id="change_timezone" class="btn btn-default btn-flat">Change TimeZone</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{URL::to('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>