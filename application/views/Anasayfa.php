<header class="page-header">
	<div class="container-fluid">
	  	<h2 class="panel-title">Kontrol Paneli</h2>
	</div>
</header> 
<div class="main-content">
	<?php 
        if ($this->session->userdata('level') == 'admin') { ?>
	<section class="dashboard-counts no-padding-bottom">
	    <div class="container-fluid">
	      <div class="row py-1">
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="item d-flex align-items-center">
							<div class="icon bg-violet"><i class="fa fa-book"></i></div>
							<a href="<?php echo base_url('index.php/kitap') ?>" class="text-secondary">
							<div class="title"><span>Toplam Kitap</span></div>
							</a>
							<span class="number"><?php echo $jml_book->jml_book; ?></span>
						</div>
					</div>
				</div>
	        </div>
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="item d-flex align-items-center">
							<div class="icon bg-green"><i class="fa fa-dollar"></i></div>
							<a href="<?php echo base_url('index.php/gecmis') ?>" class="text-secondary">
							<div class="title"><span>Kazanç</span></div>
							</a>
							<span class="number">₺<?php echo $jml_transaction->jml_transaction; ?></span>
						</div>
					</div>
				</div>
	        </div>
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="item d-flex align-items-center">
							<div class="icon bg-red"><i class="fa fa-exchange"></i></div>
							<a href="<?php echo base_url('index.php/gecmis') ?>" class="text-secondary">
							<div class="title"><span>Toplam Satış</span></div>
							</a>
							<span class="number"><?php echo $jml_pengguna->jml_pengguna; ?></span>
						</div>
					</div>
				</div>
	        </div>
		  </div>

		  <div class="row py-1">
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="item d-flex align-items-center">
							<div class="icon bg-warning"><i class="fa fa-bookmark" style="color: white;"></i></div>
							<a href="<?php echo base_url('index.php/kategori') ?>" class="text-secondary">
							<div class="title"><span>Kategoriler</span></div>
							</a>
							<span class="number"><?php echo $book_cat->book_cat; ?></span>
						</div>
					</div>
				</div>
	        </div>
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="item d-flex align-items-center">
							<div class="icon bg-gray"><i class="fa fa-user-secret"></i></div>
							<a href="<?php echo base_url('index.php/kullanici') ?>" class="text-secondary">
							<div class="title"><span>Sistem Kullanıcıları</span></div>
							</a>
							<span class="number"><?php echo $sys_user->sys_user; ?></span>
						</div>
					</div>
				</div>
	        </div>
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="item d-flex align-items-center">
							<div class="icon bg-info"><i class="fa fa-th-large" style="color: white;"></i></div>
							<a href="<?php echo base_url('index.php/kitap') ?>" class="text-secondary">
								<div class="title"><span>Stok</span></div>
							</a>
							<span class="number"><?php echo $book_stock->book_stock; ?></span>
						</div>
					</div>
				</div>
			  </div>
		  </div>

		  <div class="row py-1">
	        
	        <!-- Item -->
	        <div class="col-xl-4 col-sm-4">
				<div class="card rounded-0 shadow">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="icon bg-green"><i class="fa fa-hourglass"></i></div>
							<a href="<?php echo base_url('index.php/gecmis') ?>" class="text-secondary">
							<div class="title"><span>24 Saatlik Satış</span></div>
							</a>
							<span class="number">₺<?php echo $sales_p->sales_p; ?></span>
						</div>
					</div>
				</div>
	        </div>
	        
		  </div>
		</div>
	</section>
		<?php } elseif ($this->session->userdata('level') == 'kasiyer') { ?>
			<section class="dashboard-counts no-padding-bottom">
			<div class="container-fluid">
			<div class="row py-1">
				<!-- Item -->
				<div class="col-xl-4 col-sm-4">
					<div class="card rounded-0 shadow">
						<div class="card-body">
							<div class="item d-flex align-items-center">
								<div class="icon bg-green"><i class="fa fa-dollar"></i></div>
								<a href="<?php echo base_url('index.php/gecmis') ?>" class="text-secondary">
								<div class="title"><span>Kazanç</span></div>
								</a>
								<span class="number">₺<?php echo $jml_transaction->jml_transaction; ?></span>
							</div>
						</div>
					</div>
				</div>
				<!-- Item -->
				<div class="col-xl-4 col-sm-4">
					<div class="card rounded-0 shadow">
						<div class="card-body">
							<div class="item d-flex align-items-center">
								<div class="icon bg-red"><i class="fa fa-exchange"></i></div>
								<a href="<?php echo base_url('index.php/gecmis') ?>" class="text-secondary">
								<div class="title"><span>Toplam Satış</span></div>
								</a>
								<span class="number"><?php echo $jml_pengguna->jml_pengguna; ?></span>
							</div>
						</div>
					</div>
				</div>
				<!-- Item -->
				<div class="col-xl-4 col-sm-4">
					<div class="card rounded-0 shadow">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="icon bg-green"><i class="fa fa-hourglass"></i></div>
								<a href="<?php echo base_url('index.php/gecmis') ?>" class="text-secondary">
								<div class="title"><span>24 Saatlik Satış</span></div>
								</a>
								<span class="number">₺<?php echo $sales_p->sales_p; ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</section>
		<?php } ?>
	
</div>
