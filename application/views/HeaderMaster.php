<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bs/css/bootstrap.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bs/css/jquery.dataTables.min.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bs/css/bootstrap-datetimepicker.min.css')?>"/>
	<script src="<?php echo base_url('assets/bs/js/jquery-3.1.1.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bs/js/bootstrap.js')?>"></script>
	<script src="<?php echo base_url('assets/bs/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bs/js/bootstrap-datetimepicker.js')?>"></script>
	<script src="<?php echo base_url('assets/bs/js/locales/bootstrap-datetimepicker.fr.js')?>"></script>
	<style>
		.color1
		{
			
		}
	</style>

	<body>
		<nav class="color1 navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
				<a class="navbar-brand" href="#">Master SuperMarket </a>
				</div>
				
				<ul class="nav navbar-nav">
					<li><a href="<?php echo site_url("Master/index")?>">Master Produk</a></li>
					<li><a href="<?php echo site_url("Master/ListProduk")?>">List Produk</a></li>
					<li><a href="<?php echo site_url("Master_Karyawan/index")?>">Master Karyawan</a></li>
					<li><a href="<?php echo site_url("Master_Karyawan/ListKaryawan")?>">List Karyawan</a></li>
					<li><a href="<?php echo site_url("MasterPromosi/index")?>">Master Promosi</a></li>
					<li><a href="<?php echo site_url("MasterPromosi/ListPromosi")?>">List Promosi</a></li>
					<li><a href="<?php echo site_url("Chome/index")?>">Log Out</a></li>
				</ul>
			</div>
		</nav>
  
	</body>
</head>