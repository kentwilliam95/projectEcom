<!DOCTYPE html>
<html lang="en">


<head>
	<?php
	function formatRp($angka)
	{
		$jadi = "Rp. " . number_format($angka,2,',','.');
		return $jadi;
	}
	?>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Hitler">
    <meta name="keywords" content="">

    <title>
        Proyek E-Commerce
    </title>
	
    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
	<?php echo link_tag('assets/css/font-awesome.css'); ?>
	<?php echo link_tag('assets/css/bootstrap.min.css'); ?>
	<?php echo link_tag('assets/css/animate.min.css'); ?>
	<?php echo link_tag('assets/css/owl.carousel.css'); ?>
	<?php echo link_tag('assets/css/owl.theme.css'); ?>

    <!-- theme stylesheet -->
    <link href="<?php echo base_url();?>assets/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/js/respond.min.js"></script>

    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.png">

<style>
	.img-produk {
    height:200px;
    width:100%;
    margin-top: 30px;
    
    
    
	}

	</style>

</head>

<body>

    <!-- *** TOPBAR ***
 _________________________________________________________ -->
	<?php if($log){?>
		<div id="top">
			<div class="container">
				<div class="col-md-6 offer" data-animate="fadeInDown">
					<a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
				</div>
				<div class="col-md-6" data-animate="fadeInDown">
					<ul class="menu">
						<li><a href="<?php echo site_url('chome/logout'); ?>">Logout</a>
						</li>
						<li><a href="contact.html">Contact</a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	<?php } else {?>
		<div id="top">
			<div class="container">
				<div class="col-md-6 offer" data-animate="fadeInDown">
					<a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $50!</a>
				</div>
				<div class="col-md-6" data-animate="fadeInDown">
					<ul class="menu">
						<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
						</li>
						<li><a href="register.html">Register</a>
						</li>
						<li><a href="contact.html">Contact</a>
						</li>
						<li><a href="#">Recently viewed</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
				<div class="modal-dialog modal-sm">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="Login">Customer login</h4>
						</div>
						<div class="modal-body">
							<form action="<?php echo site_url('chome/login'); ?>" method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="email-modal" name="email" placeholder="email">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password-modal" name="pass" placeholder="password">
								</div>

								<p class="text-center">
									<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
								</p>

							</form>

							<p class="text-center text-muted">Not registered yet?</p>
							<p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

						</div>
					</div>
				</div>
			</div>

    </div>
 <?php }?>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index" data-animate-hover="bounce">
                    <img src="<?php echo base_url();?>Produk/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="<?php echo base_url();?>Produk/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="basket.html">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">0 items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index">Home</a>
                    </li>
					
							
														
													
					<?php foreach($kategori as $k){ ?>
					<li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?php echo $k->kategori_produk; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
										<?php foreach($subkategori as $s){?>
											<?php if($s->kategori_produk==$k->kategori_produk){?>	
											<div class="col-sm-3">
												<h5><?php echo $s->jenis_produk;?></h5>
												<ul>
													<?php foreach($barang as $b){?>
													<?php if($b->kategori_produk==$k->kategori_produk && $b->jenis_produk ==$s->jenis_produk){ ?>
													<li><a class="linkProduk" id="<?php echo $b->merek_produk."|".$b->jenis_produk;?>"href=""><?php echo $b->merek_produk;?></a>
													</li>
													<?php } ?>
													<?php } ?>
												</ul>
											</div>
											<?php } ?>
										<?php } ?>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
					<?php } ?>
					
                    
                              
                   
                </ul>

            </div>
            <!--/.nav-collapse -->

           <div class="navbar-buttons">
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="<?php echo site_url('chome/tobasket'); ?>" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"><?php echo $isicart;?> items in cart</span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

			<div class="navbar-collapse collapse right" id="basket-overview">
				<a href="<?php echo site_url('chome/towish'); ?>" class="btn btn-primary navbar-btn"><span class="hidden-sm">to Wishlist</span></a>
			</div>
            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" id="txtSearch" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

			<button class="btn btn-primary searchButton"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->


    <div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
						<?php foreach($promo as $p){ ?>
							<div class="item ">
								
								<img id=<?php echo $p->IDHPROMOSI; ?> style= "width: 100%;height: 100%;"src="<?php echo base_url();?>Produk/<?php echo $p->GAMBARPROMO; ?>" alt="" class="img-responsive bannerPromo">
								
							</div>
						<?php } ?>
                       
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">We love our customers</a></h3>
                                <p>We are known to provide best possible service ever</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Best prices</a></h3>
                                <p>You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Free returns on everything for 3 months.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>Hot this week</h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="product-slider">
						<?php $counter=0;?>
						<?php foreach($produkHot as $h){ ?>
							<?php $diskon=0; $found = false;?>
							<?php foreach ($promoYangBerlaku as $p) {?>
								<?php if($p->ID_PRODUK==$h->ID_PRODUK){ $found = true; $diskon =$p->DISKON_PROMOSI; break;} ?>
							<?php } ?>
							<!-- JIKA DISKON -->
							<?php if($found) { ?>
								
									<div class="product">
										<div class="flip-container">
											<div class="flipper">
												<div class="front">
													<a href="">
														<?php $ctr=0;?>
														<?php foreach($gambar as $g){?>
															<?php if($ctr==$counter) {?>
																<img id="<?php echo $h->ID_PRODUK; ?>" src="<?php echo base_url();?>Produk/<?php echo $g->NAMA_GAMBAR.$g->EXTENSI; ?>" alt="" class="img-responsive detailBarang img-produk">
															<?php	} ?>
															<?php $ctr++;?>
														<?php } ?>
													</a>
												</div>
												<div class="back">
													<a href="">
														<?php $ctr=0;?>
														<?php foreach($gambar as $g){?>
															<?php if($ctr==$counter) {?>
																<img id="<?php echo $h->ID_PRODUK; ?>" src="<?php echo base_url();?>Produk/<?php echo $g->NAMA_GAMBAR.$g->EXTENSI; ?>" alt="" class="img-responsive detailBarang img-produk">
															<?php	} ?>
															<?php $ctr++;?>
														<?php } ?>
													</a>
												</div>
											</div>
										</div>
										<a href="" class="invisible">
											<?php $ctr=0;?>
											<?php foreach($gambar as $g){?>
												<?php if($ctr==$counter) {?>
													<img id="<?php echo $h->ID_PRODUK; ?>" src="<?php echo base_url();?>Produk/<?php echo $g->NAMA_GAMBAR.$g->EXTENSI; ?>" alt="" class="img-responsive detailBarang img-produk">
												<?php	} ?>
												<?php $ctr++;?>
											<?php } ?>
										</a>
										<div class="text">
											<h3><a href="" id="<?php echo $h->ID_PRODUK; ?>" class="detailBarang"><?php echo $h->NAMA_PRODUK; ?></a></h3>
											<p class="price"><del><?php echo formatRp($h->HARGA_JUAL); ?></del> <?php echo formatRp($h->HARGA_JUAL-($h->HARGA_JUAL*$diskon /100)); ?></p>
											<p class="buttons">
												
													
													<a href="" id="<?php echo $h->ID_PRODUK; ?>"class="btn btn-default detailBarang">View detail</a>
												
												<form  style="text-align:center" method="post" accept-charset="utf-8" action="<?php echo site_url('chome/basket'); ?>">
													<input type="hidden" name="nama_produk" value="<?php echo $h->NAMA_PRODUK; ?>" />
													<button class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
												</form>
												
												<form style="text-align:center" method="post" accept-charset="utf-8" action="<?php echo site_url('chome/addwish'); ?>">
													<input type="hidden" name="id_produk" value="<?php echo $h->ID_PRODUK; ?>" />
													<button class="btn btn-primary" name='add'>Add to Wishlist</button>
												</form>
											</p>
										</div>
										<!-- /.text -->
										
										<div class="ribbon sale">
											<div class="theribbon">SALE</div>
											<div class="ribbon-background"></div>
										</div>
										<!-- /.ribbon -->
									</div>
									<!-- /.product -->
								
								<!-- JIKA TIDAK DISKON -->
							<?php } else { ?>
								
									<div class="product">
										<div class="flip-container">
											<div class="flipper">
												<div class="front">
													<a href="">
														<?php $ctr=0;?>
														<?php foreach($gambar as $g){?>
															<?php if($ctr==$counter) {?>
																<img id="<?php echo $h->ID_PRODUK; ?>" src="<?php echo base_url();?>Produk/<?php echo $g->NAMA_GAMBAR.$g->EXTENSI; ?>" alt="" class="img-responsive detailBarang img-produk">
															<?php	} ?>
															<?php $ctr++;?>
														<?php } ?>
													</a>
												</div>
												<div class="back">
													<a href="">
														<?php $ctr=0;?>
														<?php foreach($gambar as $g){?>
															<?php if($ctr==$counter) {?>
																<img id="<?php echo $h->ID_PRODUK; ?>" src="<?php echo base_url();?>Produk/<?php echo $g->NAMA_GAMBAR.$g->EXTENSI; ?>" alt="" class="img-responsive detailBarang img-produk">
															<?php	} ?>
															<?php $ctr++;?>
														<?php } ?>
													</a>
												</div>
											</div>
										</div>
										<a href="" class="invisible">
											<?php $ctr=0;?>
											<?php foreach($gambar as $g){?>
												<?php if($ctr==$counter) {?>
													<img id="<?php echo $h->ID_PRODUK; ?>" src="<?php echo base_url();?>Produk/<?php echo $g->NAMA_GAMBAR.$g->EXTENSI; ?>" alt="" class="img-responsive detailBarang img-produk">
												<?php	} ?>
												<?php $ctr++;?>
											<?php } ?>
										</a>
										<div class="text">
											<h3><a href="" id="<?php echo $h->ID_PRODUK; ?>" class="detailBarang"><?php echo $h->NAMA_PRODUK; ?></a></h3>
											<p class="price"><?php echo formatRp($h->HARGA_JUAL); ?></p>
											<p class="buttons">
												
													
													<a href="" id="<?php echo $h->ID_PRODUK; ?>"class="btn btn-default detailBarang">View Detail</a>
												
												<form  style="text-align:center" method="post" accept-charset="utf-8" action="<?php echo site_url('chome/basket'); ?>">
													<input type="hidden" name="nama_produk" value="<?php echo $h->NAMA_PRODUK; ?>" />
													<button class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
												</form>
												
												<form style="text-align:center" method="post" accept-charset="utf-8" action="<?php echo site_url('chome/addwish'); ?>">
													<input type="hidden" name="id_produk" value="<?php echo $h->ID_PRODUK; ?>" />
													<button class="btn btn-primary" name='add'>Add to Wishlist</button>
												</form>
											</p>
										</div>
										<!-- /.text -->
									</div>
									<!-- /.product -->
								
							<?php } ?>
						<?php $counter++; } ?>
						
                        
						
						
                    
                        

                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________ -->
            <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Get Inspired</h3>
                        <p class="lead">Get the inspiration from our world class designers</p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="#">
                                    <img src="<?php echo base_url();?>Produk/getinspired1.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="<?php echo base_url();?>Produk/getinspired2.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="<?php echo base_url();?>Produk/getinspired3.jpg" alt="Get inspired" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** GET INSPIRED END *** -->

            <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->


         
            <!-- /.container -->

            <!-- *** BLOG HOMEPAGE END *** -->


        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>

                        <ul>
                            <li><a href="text.html">About us</a>
                            </li>
                            <li><a href="text.html">Terms and conditions</a>
                            </li>
                            <li><a href="faq.html">FAQ</a>
                            </li>
                            <li><a href="contact.html">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="register.html">Regiter</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Top categories</h4>

                        <h5>Men</h5>

                        <ul>
                            <li><a href="category.html">T-shirts</a>
                            </li>
                            <li><a href="category.html">Shirts</a>
                            </li>
                            <li><a href="category.html">Accessories</a>
                            </li>
                        </ul>

                        <h5>Ladies</h5>
                        <ul>
                            <li><a href="category.html">T-shirts</a>
                            </li>
                            <li><a href="category.html">Skirts</a>
                            </li>
                            <li><a href="category.html">Pants</a>
                            </li>
                            <li><a href="category.html">Accessories</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Obaju Ltd.</strong>
                            <br>13/25 New Avenue
                            <br>New Heaven
                            <br>45Y 73J
                            <br>England
                            <br>
                            <strong>Great Britain</strong>
                        </p>

                        <a href="contact.html">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>Get the news</h4>

                        <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

			    <button class="btn btn-default" type="button">Subscribe!</button>

			</span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        <h4>Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2015 Your name goes here.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious.com</a>
                         <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url();?>assets/js/waypoints.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/modernizr.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.js"></script>
    <script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/front.js"></script>

	<script>
		$('.bannerPromo').click(
		function(){
			
			$.ajax({
				url:'<?php echo base_url("index.php/chome/getPromoId"); ?>',
				type:       'POST',
				data:{id:this.id},
				cache:      false,
				success: function(hasil){
					window.location.href = "<?php echo site_url('/chome/searchProdukByPromo');?>";

				}
			});
		});
		$('.linkProduk').click(
		function(){
			
			$.ajax({
				url:'<?php echo base_url("index.php/chome/getId"); ?>',
				type:       'POST',
				data:{id:this.id},
				cache:      false,
				success: function(hasil){
					window.location.href = "<?php echo site_url('/chome/searchProdukByMerk');?>";

				}
			});
		});
		
		$('.searchButton').click(
		

		function(){
			var search = document.getElementById("txtSearch").value;
			$.ajax({
				url:'<?php echo base_url("index.php/chome/getId"); ?>',
				type:       'POST',
				data:{id:search},
				cache:      false,
				success: function(hasil){
					window.location.href = "<?php echo site_url('/chome/searchProdukByNama');?>";

				}
			});
		});
		$('.detailBarang').click(
		function(){
			
			$.ajax({
				url:'<?php echo base_url("index.php/chome/getIdToDetail"); ?>',
				type:       'POST',
				data:{id:this.id},
				cache:      false,
				success: function(hasil){
					window.location.href = "<?php echo site_url('/chome/showProductDetail');?>";

				}
			});
		});
	</script>
</body>

</html>