<?php
	//session_start();
	include("konekcija/konekcija.php");
	include("config/functions.php");
?>
<div class="header" id="head">	
		<div class="container"> 
			<div class="header-top row">
				<div id="logo" class="logo col-lg-3">
					<a href="index.html"><img src="images/logo.png" alt=""/></a>
				</div>
			<div class="top-menu">
				<span class="menu"></span>
				<!--NAV MENU-->
				<ul>
					<nav id="nav" class="cl-effect-5">
					<?php
						if($konekcija)
						{
							if(isset($_SESSION['korisnik']))
							{
								$meni = vratiSve("navs");
								foreach($meni as $red)
								{
									echo "<li><a href='$red->href'><span data-hover='$red->naziv'>$red->naziv</span></a></li>";
								}
								echo "<li><a href='config/odjava.php' class='btn btn-danger'><span data-hover='Odjava'>Odjava</span></a></li>";
							}
							else
							{
								$meni = vratiSve("navs");
								foreach($meni as $red)
								{
									echo "<li><a href='$red->href'><span data-hover='$red->naziv'>$red->naziv</span></a></li>";
								}
								echo "<li><a href='login.php'><span data-hover='Login'>Login</span></a></li><li><a href='registracija.php' class='btn btn-danger'><span data-hover='Registracija'>Registracija</span></a></li>";
							}
						}
					?>
					
					<!-- <li><a href="index.php"><span data-hover="Početna">Početna</span></a></li>
					<li><a href="prodavnica.php"><span data-hover="Prodavnica">Prodavnica</span></a></li>
					<li><a href="index.php#work"><span data-hover="Galerija"><span>Galerija</span></a></li>
					<li><a href="index.php#contact"><span data-hover="Poruči kartu">Poruči kartu</span></a></li>
					
					<li><a href="config/odjava.php" class="btn btn-danger"><span data-hover="Odjava">Odjava</span></a></li>
					
					<li><a href="login.php"><span data-hover="Login">Login</span></a></li>
					<li><a href="registracija.php" class="btn btn-danger"><span data-hover="Registracija">Registracija</span></a></li>
					 -->
					</nav>
				</ul>
				<!--NAV END-->
				</div>
				<!--script-nav-->
			<script>
			$("span.menu").click(function(){
			$(".top-menu ul").slideToggle("slow" , function(){
			});
			});
			</script>
				<div class="clearfix"></div>
			</div>  
			<div class="index-banner">
			<div class="wmuSlider example1">
					<div class="wmuSliderWrapper">
						<article style="position: absolute; width: 100%; opacity: 0;"> 
						<!--WRAPPER-->
						<div class="banner-wrap">
							<div class="banner_center">
								<h1>Pozdrav</h1> 
								<h2><a href="dokumentacija.pdf" style="color:#fff">Dokumentacija <span>Vanja Veapi</span></a></h2>
							</div>
						</div>
						
						</article>
						<article style="position: relative; width: 100%; opacity: 1;"> 
							<div class="banner-wrap">
								<div class="banner_center">
								<h1>Pozdrav</h1> 
								<h2><a href="dokumentacija.pdf" style="color:#fff">Dokumentacija <span>Vanja Veapi</span></a></h2>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;">
							<div class="banner-wrap">
							<div class="banner_center">
							<h1>Pozdrav</h1> 
								<h2><a href="dokumentacija.pdf" style="color:#fff">Dokumentacija <span>Vanja Veapi</span></a></h2>
								</div>
							</div>
						</article>
					</div>
					<!--WRAPPER END-->
				</div>
				<script src="js/jquery.wmuSlider.js"></script> 
				<script>
					$('.example1').wmuSlider();         
				</script> 	           	      
		</div>
		</div>     
	</div>