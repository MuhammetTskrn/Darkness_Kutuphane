<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kitap Mağazası Yönetim Sistemi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontastic.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" id="theme-stylesheet">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/DataTables/datatables.min.css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "decimal": "",
                    "emptyTable": "Tabloda veri bulunmuyor",
                    "info": "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
                    "infoEmpty": "Kayıt yok",
                    "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "_MENU_ kayıt göster",
                    "loadingRecords": "Yükleniyor...",
                    "processing": "İşleniyor...",
                    "search": "Ara:",
                    "zeroRecords": "Eşleşen kayıt bulunamadı",
                    "paginate": {
                        "first": "İlk",
                        "last": "Son",
                        "next": "Sonraki",
                        "previous": "Önceki"
                    },
                    "aria": {
                        "sortAscending": ": artan sütun sıralamasını aktifleştir",
                        "sortDescending": ": azalan sütun sıralamasını aktifleştir"
                    }
                },
                "dom": '<"top"f>rt<"bottom"p>',
                "pageLength": 10,
                "ordering": true,
                "searching": true
            });
        });
    </script>
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="<?php echo base_url('index.php/kontrol');?>" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Darkness</span></div>
                  <div class="brand-text brand-small">D</div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item"><a href="<?php echo base_url('index.php/yonetici/logout') ?>" class="nav-link logout">Çıkış Yap<i class="fa fa-power-off"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex"> 
        <!-- Side Navbar -->
        <nav class="side-navbar text-light bg-dark">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="<?php echo base_url(); ?>assets/img/avatar.png" alt="User Icon" class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4 text-light"><?= $this->session->userdata('fullname') ?></h1>
              <p><?= $this->session->userdata('level') ?></p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus-->
          <hr>
          <ul class="list-unstyled">
            <li>
                <a class="active" href="<?php echo base_url('index.php/kontrol');?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Kontrol Paneli</span>
                </a>
            </li>
            <?php if($this->session->userdata('level') == 'admin'){ ?>
            <li>
                <a href="<?php echo base_url('index.php/kategori');?>">
                    <i class="fa fa-bookmark"></i>
                    <span>Kategoriler</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('index.php/kitap');?>">
                    <i class="fa fa-book"></i>
                    <span>Kitaplar</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('index.php/kullanici');?>">
                    <i class="fa fa-users"></i>
                    <span>Kullanıcılar</span>
                </a>
            </li>
            <?php } ?>
            <li>
                <a href="<?php echo base_url('index.php/islem');?>">
                    <i class="fa fa-dollar"></i>
                    <span>Satışları Yönet</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('index.php/gecmis');?>">
                    <i class="fa fa-history"></i>
                    <span>Satış Geçmişi</span>
                </a>
            </li>
          </ul>
        </nav>
        <div class="content-inner">
            <?php

                $this->load->view($content);

            ?>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?php echo base_url(); ?>assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="<?php echo base_url(); ?>assets/js/front.js"></script>
  </body>
</html>