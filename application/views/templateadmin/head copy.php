<?php
        $statususer = generate_session('login');
        $active = explode("/",$_SERVER['PATH_INFO']);
        if (!isset($active[2])) {
          $active = $active[1];
        }else{
          $active = $active[2];
        }

        $menu = [
            "Home" => "home",
            "Data Barang" => [
              "Satuan Barang" => "satuan",
              "Data Barang" => "barang",
              "Supplier" => "supplier",
              "Data Harga" => "dataharga",
            ],
            "Pembelian" => [
              "Pembelian Baru" => "pembelian-baru",
              "List Pembelian" => "pembelian",
            ],
        ];

        $icon = [
            "Home" => "fa fa-home",
            "Data Barang" => "fas fa-tags",
            "Pembelian" => "fas fa-tags",
        ];

        $auth = [
            "Home" => "user",
            "Data Barang" => [
              "Satuan Barang" => 'user',
              "Data Barang" => 'user',
              "Supplier" => 'user',
              "Data Harga" => "user",
            ],
            "Pembelian" => [
              "Pembelian Baru" => "user",
              "List Pembelian" => "user",
            ],
        ];

        $menuactive = NULL;
        // cek active menu
        foreach(array_keys($menu) as $cc => $val){
            // cek if array
            if (is_array($menu[$val])) {
                $ccc = $val;
                foreach(array_keys($menu[$val]) as $ccs => $vals){
                    if ($menu[$val][$vals] == $active) {
                        $menuactive = $ccc;
                    }
                }
            }else{
                if ($active == $menu[$val]) {
                    $menuactive = $val;
                }
            }
        }

        // autenticarion if admin login first load path 0 from array with condition active menu


        function cekarraylistcontainactivekey($active = null, $data = [], $auth)
        {
            $obj1 = array_keys($data);

            $cc = null;

            foreach ($obj1 as $key => $value) {
                if (is_array($data[$value])) {
                    foreach(array_keys($data[$value]) as $key => $datas ) {
                        if ($data[$value][$datas] == $active) {
                            $cc = $auth[$value][$datas];
                        }
                    }
                }else{
                    if ($data[$value] == $active) {
                        $cc = $auth[$value];
                    }
                }

            }
            return $cc;
        }

        function callbacktoadmin($active = null, $data = [], $auth)
        {
            $obj1 = array_keys($data);

            $cc = null;

            if ($active == 'home') {
              return redirect('home');
            }else{
              foreach ($obj1 as $key => $value) {
                if (is_array($data[$value])) {
                  foreach(array_keys($data[$value]) as $key => $datas ) {
                    if ($auth[$value][$datas] == $active) {
                      return redirect('admin/'.$data[$value][$datas]);
                    }
                  }
                }else{
                  if ($auth[$value] == $active) {
                    return redirect('admin/'.$data[$value]);
                  }
                }

              }
            }
            return $cc;

        }

        $cek = cekarraylistcontainactivekey($active, $menu, $auth);

        if (generate_session('login') != $cek) {
          if ($active == 'home' || $active == "obatpenyakit") {

          }else{
            callbacktoadmin(generate_session('login'), $menu, $auth);
          }
        }


        // lihat nilai active

    ?>


<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard One | Notika - Notika Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		============================================ -->
    <link href="<?= base_url(cek(Perusahaans::get(),'icon').'?v='.date('ymd')) ?>" rel="icon">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/datatable-bootstrap-4/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url('')?>assets/admin/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    
    <script src="<?= base_url('')?>assets/admin/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/dist/js/adminlte.js"></script>
    <script src="<?= base_url('')?>assets/admin/dist/js/demo.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/dist/js/pages/dashboard2.js"></script>
    <script src="<?= base_url('')?>assets/datatable-bootstrap-4/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('')?>assets/datatable-bootstrap-4/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('')?>sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= base_url('')?>assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


    <script src="<?= base_url('')?>assets/file.js?v=3"></script>

    <!-- bootstrap JS
		============================================ -->

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="<?= base_url('');?>assets/notika/http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <h3 style="color: white;"><img src="<?= base_url('assets/logo.png');  ?>" style="height: 50px; width: auto;">&nbsp;&nbsp;&nbsp;<?= Perusahaans::get()->nama_perusahaan; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item dropdown">
                                <a href="<?= site_url('admin/login/out') ?>" role="button" aria-expanded="false"
                                    class="nav-link dropdown-toggle"><span><i
                                    class="fas fa-sign-out-alt"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->

        <!-- mobile -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <?php foreach(array_keys($menu) as $key => $val) : ?>
                                <?php if(is_array($menu[$val])) : ?>
                                <li><a data-toggle="collapse" data-target="#Charts" href="#"><?= $val ?></a>
                                    <ul class="collapse dropdown-header-top">
                                        <?php foreach(array_keys($menu[$val]) as $keyd => $vald) : ?>
                                            <li><a href="<?= site_url('admin/'.$menu[$val][$vald]);?>"><?= $vald; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <?php else: ?>
                                    <?php if($statususer == $auth[$val]) : ?>
                                      <?php if ($val == "Jadwal Webinar"): ?>
                                          <li>
                                            <a href="<?= site_url('/').$menu[$val]; ?>"><i class="<?= $icon[$val] ?>"></i>
                                              <?= $val ?>
                                            </a>
                                          </li>
                                        <?php else: ?>
                                          <li>
                                            <a href="<?= site_url('admin/').$menu[$val]; ?>"><i class="<?= $icon[$val] ?>"></i>
                                              <?= $val ?>
                                            </a>
                                          </li>
                                      <?php endif; ?>
                                    <?php endif ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- desktop area -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">

                        <?php foreach(array_keys($menu) as $key => $val) : ?>
                            <?php if($val == $menuactive) : ?>
                                    <?php if(is_array($menu[$val])) : ?>
                                            <?php
                                                $cekstat = null;
                                                foreach(array_keys($menu[$val]) as $elm => $ecw){
                                                    if ($auth[$val][$ecw] == $statususer) {
                                                        $cekstat = $statususer;
                                                    }
                                                }

                                            ?>
                                            <?php if($statususer == $cekstat) : ?>
                                                <li class="active">
                                                    <a data-toggle="tab" href="#<?= str_replace(" ","-",$val); ?>"><i class="<?= $icon[$val] ?>"></i>
                                                        <?= $val ?>
                                                    </a>
                                                </li>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <?php if($statususer == $auth[$val]) : ?>
                                              <?php if ($val == "Home"): ?>
                                                  <li class="active">
                                                    <a href="<?= site_url('/').$menu[$val]; ?>"><i class="<?= $icon[$val] ?>"></i>
                                                      <?= $val ?>
                                                    </a>
                                                  </li>
                                                <?php else: ?>
                                                  <li class="active">
                                                    <a href="<?= site_url('admin/').$menu[$val]; ?>"><i class="<?= $icon[$val] ?>"></i>
                                                      <?= $val ?>
                                                    </a>
                                                  </li>
                                              <?php endif; ?>
                                            <?php endif ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if(is_array($menu[$val])) : ?>
                                            <?php
                                                $cekstat = null;
                                                foreach(array_keys($menu[$val]) as $elm => $ecw){
                                                    if ($auth[$val][$ecw] == $statususer) {
                                                        $cekstat = $statususer;
                                                    }
                                                }

                                            ?>
                                            <?php if($statususer == $cekstat) : ?>
                                            <li>
                                                <a data-toggle="tab" href="#<?= str_replace(" ","-",$val); ?>"><i class="<?= $icon[$val] ?>"></i>
                                                    <?= $val ?>
                                                </a>
                                            </li>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <?php if($statususer == $auth[$val]) : ?>
                                              <?php if ($val == "Home"): ?>
                                                  <li>
                                                    <a href="<?= site_url('/').$menu[$val]; ?>"><i class="<?= $icon[$val] ?>"></i>
                                                      <?= $val ?>
                                                    </a>
                                                  </li>
                                                <?php else: ?>
                                                  <li>
                                                    <a href="<?= site_url('admin/').$menu[$val]; ?>"><i class="<?= $icon[$val] ?>"></i>
                                                      <?= $val ?>
                                                    </a>
                                                  </li>
                                              <?php endif; ?>
                                            <?php endif ?>
                                    <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content custom-menu-content">

                        <?php foreach(array_keys($menu) as $key => $val) : ?>
                            <?php if($val == $menuactive) : ?>
                                    <?php if(is_array($menu[$val])) : ?>
                                        <!--  -->
                                        <div id="<?= str_replace(" ","-",$val); ?>" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                                            <ul class="notika-main-menu-dropdown">
                                                <!--  -->
                                                <?php foreach(array_keys($menu[$val]) as $keyd => $vald) : ?>
                                                    <?php if($statususer == $auth[$val][$vald]) : ?>
                                                        <li><a href="<?= site_url('admin/'.$menu[$val][$vald]);?>"><?= $vald; ?></a></li>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                                <!--  -->
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if(is_array($menu[$val])) : ?>
                                        <!--  -->
                                        <div id="<?= str_replace(" ","-",$val); ?>" class="tab-pane in notika-tab-menu-bg animated flipInX">
                                            <ul class="notika-main-menu-dropdown">
                                                <!--  -->
                                                <?php foreach(array_keys($menu[$val]) as $keyd => $vald) : ?>
                                                    <?php if($statususer == $auth[$val][$vald]) : ?>
                                                        <li><a href="<?= site_url('admin/'.$menu[$val][$vald]);?>"><?= $vald; ?></a></li>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                                <!--  -->
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
