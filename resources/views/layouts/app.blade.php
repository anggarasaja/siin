<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SIIN</title>

	<meta name="description" content="" >

	<meta name="author" content="Jewel Theme">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

  <link href="https://fonts.googleapis.com/css?family=Taviraj:500i" rel="stylesheet">
	<!-- Bootstrap  -->
  {!! Html::style('css/bootstrap.min.css'); !!}
	<!-- icon fonts font Awesome -->
  {!! Html::style('css/font-awesome.min.css'); !!}
  {!! Html::style('vendors/Hover-master/css/hover-min.css'); !!}
	<!-- Import Magnific Pop Up Styles -->

	<!-- Import Custom Styles -->
  {!! Html::style('css/style.css'); !!}

	<!-- Import Animate Styles -->
  {!! Html::style('css/animate.min.css'); !!}


	<!-- Import owl.carousel Styles -->
  {!! Html::style('css/owl.carousel.css'); !!}

	<!-- Import Custom Responsive Styles -->
   {!! Html::style('css/responsive.css'); !!}

   @stack('styles')

   @stack('scripts-head')

	
	<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  		<![endif]-->

  	</head>
  	<body class="header-fixed-top">

  		<div id="page-top" class="page-top"></div><!-- /.page-top -->

  		<section id="top-contact" class="top-contact">
  			<div class="container">
  				<div class="row">
  					<div class="col-sm-8 pull-left">
  						<ul class="contact-list">
  							<li>
  								<a class="site-name" href="/">
  									<img src="{{URL::asset('img/Logo_SIIN_white.png')}}" alt="Site Logo" style="max-width: 60px" class="img-logo">
  									<span style="    position: absolute;bottom: -6px;left: 90px;">Sistem Informasi IPTEK Nasional</span>
  								</a>
  							</li>
  						</ul>
  					</div>
            <div class="col-sm-4 pull-right">
              <div class="top-social">
                <ul>
                  <li>
                    <a href="http://www.dikti.go.id/"><img src="{{URL::asset('img/kemenristekdikti_white.png')}}" alt="Site Logo" class="img-logo" style="max-width: 50px"></a>
                  </li>
                 
                </ul>
              </div>
            </div>


  				</div><!-- /.row -->
  			</div><!-- /.container -->
  		</section><!-- /#top-contact -->



  		<header id="main-menu" class="main-menu">
  			<div class="container">
  				<div class="row">
  					<div class="col-sm-7">
  						<div class="navbar-header">
  							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
  								<i class="fa fa-bars"></i>
  							</button>
                <div class="menu-logo">
                  <a href="./"><img src="{{URL::asset('img/Logo_SIIN.png')}}" alt="menu Logo" class="img-logo"></a>
                </div><!-- /.menu-logo -->
              </div>
              <nav id="menu" class="menu collapse navbar-collapse">
               <ul id="headernavigation" class="menu-list nav navbar-nav">
                <li><a href="/" class="hvr-underline-from-center">Home</a></li>
                <li><a href="/search" class="hvr-underline-from-center">Pencarian</a></li>
                @if (Auth::guest())
                <li><a href="/login" class="hvr-underline-from-center">Login</a></li>
                <li><a href="/register" class="hvr-underline-from-center">Register</a></li>
                @else
                <li><a href="/dashboard" class="hvr-underline-from-center">Dashboard</a></li>
                <li><a href="{{ url('/logout') }}" class="hvr-underline-from-center">Logout</a></li>
                
                @endif
                <!--<li><a href="#portfolio">Projects</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#latest-post">Blog</a></li>
                <li><a href="#contact">Contact</a></li> -->
              </ul><!-- /.menu-list -->
            </nav><!-- /.menu-list -->
          </div>

          <!-- <div class="col-sm-5">
            <div class="menu-search pull-right">
             <form role="search" class="search-form" action="#" method="get">
              <input class="search-field" type="text" name="s" id="s" placeholder="Search Here" required>
              <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div> -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </header><!-- /#main-menu -->

@yield('content')

<footer>
  

  <div id="footer-bottom" class="footer-bottom text-center">
    <div class="container">
      <div id="copyright" class="copyright">
        &copy; SIIN - KEMENRISTEKDIKTI 2016 | Developed by Universitas Gunadarma
      </div><!-- /#copyright -->
    </div>
  </div><!-- /#footer-bottom -->
</footer>



<div id="scroll-to-top" class="scroll-to-top">
  <span>
    <i class="fa fa-chevron-up"></i>    
  </span>
</div><!-- /#scroll-to-top -->


<!-- Include jquery.min.js plugin -->
{!! Html::script('js/jquery-2.1.0.min.js'); !!}

<!-- Javascript Plugins  -->
{!! Html::script('js/plugins.js'); !!}

<!-- Custom Functions  -->
{!! Html::script('js/functions.js'); !!}

{!! Html::script('js/wow.min.js'); !!}




<script>

 $(document).ready(function() {

  // /* -------- One page Navigation ----------*/
  // $('#main-menu #menu').onePageNav({
  //   currentClass: 'active',
  //   changeHash: false,
  //   scrollSpeed: 1500,
  //   scrollThreshold: 0.5,
  //   scrollOffset: 95,
  //   filter: ':not(.sub-menu a, .not-in-home)',
  //   easing: 'swing'
  // }); 


  /*----------- Google Map - with support of gmaps.js ----------------*/

  function isMobile() { 
   return ('ontouchstart' in document.documentElement);
 }
});



</script>
@stack('scripts')

</body>
</html>

