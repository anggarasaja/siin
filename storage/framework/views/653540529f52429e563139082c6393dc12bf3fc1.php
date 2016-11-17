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

	<!-- Bootstrap  -->
  <?php echo Html::style('css/bootstrap.min.css');; ?>

	<!-- icon fonts font Awesome -->
  <?php echo Html::style('css/font-awesome.min.css');; ?>

	<!-- Import Magnific Pop Up Styles -->

	<!-- Import Custom Styles -->
  <?php echo Html::style('css/style.css');; ?>


	<!-- Import Animate Styles -->
  <?php echo Html::style('css/animate.min.css');; ?>



	<!-- Import owl.carousel Styles -->
  <?php echo Html::style('css/owl.carousel.css');; ?>


	<!-- Import Custom Responsive Styles -->
   <?php echo Html::style('css/responsive.css');; ?>


   <?php echo $__env->yieldPushContent('styles'); ?>

   <?php echo $__env->yieldPushContent('scripts-head'); ?>

	
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
  								<a class="site-name" href="#">
  									<span class="top-icon"><i class="fa fa-link"></i></span>
  									www.sitename.com
  								</a>
  							</li>
  							<li>
  								<a class="info" href="#">
  									<span class="top-icon"><i class="fa fa-envelope"></i></span>
  									info@sitename.com
  								</a>
  							</li>
  							<li>
  								<a class="phone-no" href="#">
  									<span class="top-icon"><i class="fa fa-phone"></i></span>
  									8888 888888
  								</a>
  							</li>
  						</ul>
  					</div>

  					<div class="col-sm-4 pull-right">
  						<div class="top-social">
  							<ul>
  								<li>
  									<a href="#" class="top-icon fa fa-facebook"></a>
  								</li>
  								<li>
  									<a href="#" class="top-icon fa fa-twitter"></a>
  								</li>
  								<li>
  									<a href="#" class="top-icon fa fa-linkedin"></a>
  								</li>
  							</ul>
  						</div>
  					</div>
  				</div><!-- /.row -->
  			</div><!-- /.container -->
  		</section><!-- /#top-contact -->



  		<section id="site-banner" class="site-banner text-center">
  			<div class="container">
  				<div class="site-logo">
  					<a href="./"><img src="<?php echo e(URL::asset('img/Logo_SIIN_small.png')); ?>" alt="Site Logo"></a>
  				</div><!-- /.site-logo -->
  			</div><!-- /.container -->
  		</section><!-- /#site-banner -->



  		<header id="main-menu" class="main-menu">
  			<div class="container">
  				<div class="row">
  					<div class="col-sm-7">
  						<div class="navbar-header">
  							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
  								<i class="fa fa-bars"></i>
  							</button>
                <div class="menu-logo">
                  <a href="./"><img src="<?php echo e(URL::asset('img/Logo_SIIN.png')); ?>" alt="menu Logo"></a>
                </div><!-- /.menu-logo -->
              </div>
              <nav id="menu" class="menu collapse navbar-collapse">
               <ul id="headernavigation" class="menu-list nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <?php if(Auth::guest()): ?>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
                <?php else: ?>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="<?php echo e(url('/logout')); ?>">Logout</a></li>
                
                <?php endif; ?>
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

<?php echo $__env->yieldContent('content'); ?>

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
<?php echo Html::script('js/jquery-2.1.0.min.js');; ?>


<!-- Javascript Plugins  -->
<?php echo Html::script('js/plugins.js');; ?>


<!-- Custom Functions  -->
<?php echo Html::script('js/functions.js');; ?>


<?php echo Html::script('js/wow.min.js');; ?>





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
<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>

