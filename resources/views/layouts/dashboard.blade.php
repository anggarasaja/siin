<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIIN</title>

    <!-- Bootstrap -->
    <!-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- NProgress -->
    <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- iCheck -->
    <!-- <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
    <!-- bootstrap-progressbar -->
    <!-- <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->
    <!-- JQVMap -->
    <!-- <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
    <!-- Datepicker -->
    <!-- <link href="css/datepicker/bootstrap-datepicker.min.css" rel="stylesheet"/> -->
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->

    {!! Html::style('vendors/bootstrap/dist/css/bootstrap.min.css'); !!}
    {!! Html::style('vendors/font-awesome/css/font-awesome.min.css'); !!}
    {!! Html::style('vendors/nprogress/nprogress.css'); !!}
    {!! Html::style('vendors/iCheck/skins/flat/green.css'); !!}
    {!! Html::style('css/datepicker/bootstrap-datepicker.min.css'); !!}
    {!! Html::style('build/css/custom.min.css'); !!}
    {!! Html::style('css/sweetalert.css'); !!}

    @stack('styles')
    
    {!! Html::script('vendors/jquery/dist/jquery.min.js'); !!}
    {!! Html::script('js/moment/moment.min.js'); !!}
    {!! Html::script('js/datepicker/bootstrap-datepicker.min.js'); !!}
    {!! Html::script('vendors/bootstrap/dist/js/bootstrap.min.js'); !!}
    {!! Html::script('vendors/fastclick/lib/fastclick.js'); !!}
    {!! Html::script('vendors/nprogress/nprogress.js'); !!}
    {!! Html::script('js/sweetalert.js'); !!}
    @include('Alerts::alerts')
    
    @stack('scripts-head')



    <!-- Chart.js -->
    <!-- <script src="../vendors/Chart.js/dist/Chart.min.js"></script> -->
    <!-- gauge.js -->
    <!-- <script src="../vendors/gauge.js/dist/gauge.min.js"></script> -->
    <!-- bootstrap-progressbar -->
    <!-- <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
    <!-- iCheck -->
    <!-- <script src="../vendors/iCheck/icheck.min.js"></script> -->
    <!-- Skycons -->
    <!-- <script src="../vendors/skycons/skycons.js"></script> -->
    <!-- Flot -->
    <!-- <script src="../vendors/Flot/jquery.flot.js"></script> -->
    <!-- <script src="../vendors/Flot/jquery.flot.pie.js"></script> -->
    <!-- <script src="../vendors/Flot/jquery.flot.time.js"></script> -->
    <!-- <script src="../vendors/Flot/jquery.flot.stack.js"></script> -->
    <!-- <script src="../vendors/Flot/jquery.flot.resize.js"></script> -->
    <!-- Flot plugins -->
    <!-- <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script> -->
    <!-- <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script> -->
    <!-- <script src="../vendors/flot.curvedlines/curvedLines.js"></script> -->
    <!-- DateJS -->
    <!-- <script src="../vendors/DateJS/build/date.js"></script> -->
    <!-- JQVMap -->
    <!-- <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script> -->
    <!-- <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
    <!-- <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script> -->


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><img src="{{URL::asset('images/iconwhite.png')}}" style="width:42px;margin-top:-6px;margin-left:3px">&nbsp;&nbsp;<span>RISTEKDIKTI</span>
              </a>
            </div>
            <div class="clearfix">
              
            </div>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="/dashboard"><i class="fa fa-bar-chart-o"></i> Visualisasi Data</span></a></li>
                  <li><a href="/rml"><i class="fa fa-cloud"></i> API Services</a></li>
                  <li><a href="{{ URL::to('user') }}"><i class="fa fa-users"></i> Manajemen Pengguna</a></li>
                </ul>
              </div>
            </div> 
          </div>
        </div>

        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i>
                </a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{URL::asset('img/pui.png')}}" alt="">{{Auth::user()->username}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ url('user/'.Auth::user()->id) }}"> Profil</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Pengaturan</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Bantuan</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <div class="right_col" role="main">

          @yield('content')
        </div>
        <footer>
          <div class="pull-right">
            SIIN - RISTEK DIKTI
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    @stack('scripts')
    {!! Html::script('build/js/custom.min.js'); !!}
  </body>
</html>
