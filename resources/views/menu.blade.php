      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <small>Administrator</small>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li {{ (strcmp($page,'home')==0)? 'class=active':''}}>
              <a href="{{URL::to('admin')}}">
                <i class="fa fa-home"></i> <span>Home</span>
                <!-- <small class="label pull-right bg-yellow">12</small> -->
              </a>
            </li>
            <li {{ (strcmp($page,'report')==0)? 'class=active':''}}>
              <a href="{{URL::to('report')}}">
                <i class="fa fa-line-chart"></i> <span>Report</span>
              </a>
            </li>
            <li {{ (strcmp($page,'adzone')==0)? 'class=active':''}}>
              <a href="{{URL::to('adzone')}}">
                <i class="fa fa-clone"></i> <span>Ad Zones</span>
                <!-- <small class="label pull-right bg-yellow">12</small> -->
              </a>
            </li>
            <li {{ (strcmp($page,'refresh')==0)? 'class=active':''}}>
              <a href="{{URL::to('refresh')}}">
                <i class="fa fa-refresh"></i> <span>Refresh Ads</span>
                <!-- <small class="label pull-right bg-yellow">12</small> -->
              </a>
            </li>
            <li {{ (strcmp($page,'adsense')==0)? 'class=active':''}}>
              <a href="{{URL::to('adsense')}}">
                <i class="fa fa-code"></i> <span>Adsense Ad Code</span>
                <!-- <small class="label pull-right bg-yellow">12</small> -->
              </a>
            </li>
            <li {{ (strcmp($page,'LSM')==0)? 'class=active':''}}>
              <a href="{{URL::to('lsm')}}">
                <i class="fa fa-code"></i> <span>LSM Ad Code</span>
                <!-- <small class="label pull-right bg-yellow">12</small> -->
              </a>
            </li>
            <li {{ (strcmp($page,'othermanage')==0)? 'class=active':''}}>
              <a href="{{URL::to('otherads')}}">
                <i class="fa fa-code"></i> <span>Other Ad Network Code</span>
                <!-- <small class="label pull-right bg-yellow">99+</small> -->
              </a>
            </li>
<!--             <li {{ (strcmp($page,'lsm-ad-compare')==0)? 'class=active':''}}>
              <a href="{{URL::to('lsm-ad-compare')}}">
                <i class="fa fa-balance-scale"></i> <span>LSM Ad Compare</span>
              </a>
            </li>
            <li {{ (strcmp($page,'adsense-ad-compare')==0)? 'class=active':''}}>
              <a href="{{URL::to('adsense-ad-compare')}}">
                <i class="fa fa-balance-scale"></i> <span>Adsense Ad Compare</span>
              </a>
            </li> -->
            <li {{ (strcmp($page,'api')==0)? 'class=active':''}}>
              <a href="{{URL::to('api')}}">
                <i class="fa fa-terminal"></i> <span>API KEYS</span>
              </a>
            </li>

            <li {{ (strcmp($page,'googleapiconsole')==0)? 'class=active':''}}>
              <a href="{{URL::to('googleapiconsole')}}">
                <i class="fa fa-google"></i> <span>Google API Console Config</span>
              </a>
            </li>


            <li {{ (strcmp($page,'help')==0)? 'class=active':''}}>
              <a href="{{URL::to('help')}}">
                <i class="fa fa-life-ring"></i> <span>Help</span>
              </a>
            </li>


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>