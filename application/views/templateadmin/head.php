<?php
        $statususer = generate_session('login');

        $active = explode("/",$_SERVER['PATH_INFO']);
        if (!isset($active[2])) {
          $active = $active[1];
        }else{
          $active = $active[2];
        }

        $menu = [
          "Dasbor" => "home",
          "Post" => "post",
        ];

        $icon = [
          "Dasbor" => "fa fa-desktop",
          "Post" => "fas fa-book",
        ];

        $auth = [];

        $auth["Dasbor"] = 'admin';
        $auth["Post"] = 'admin';

        $icon["Kategori"] = 'fas fa-tag';
        $menu["Kategori"] = 'kategori';
        $auth["Kategori"] = 'admin';

        $icon["Tipe Konten"] = 'fas fa-tag';
        $menu["Tipe Konten"] = 'tipekontent';
        $auth["Tipe Konten"] = 'admin';

        $icon["User"] = 'fas fa-user';
        $menu["User"] = 'user';
        $auth["User"] = 'admin';

        $icon["Oto"] = 'fas fa-user';
        $menu["Oto"] = 'oto';
        $auth["Oto"] = 'admin';

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

            if ($active == 'homesr') {
              // return redirect('home');
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
            // callbacktoadmin(generate_session('login'), $menu, $auth);
          }
        }

        // lihat nilai active

    ?>


<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= cek(Perusahaans::get(),'nama'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/datatable-bootstrap-4/bootstrap.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/datatable-bootstrap-4/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/datatable-bootstrap-4/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/css/sweetalert.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= site_url() ?>assets/admin/tagsinput.css">

    <style>

      .navbar-primary ul li a{
        color: white !important;
      }

      .rounded-tumb a {
        border: 1px solid white;
        margin-left: 10px !important;
        border-radius: 8px;
        transition: 1s;
      }

      .CodeMirror-code span{
          color: white;
      }

      .rounded-tumb a:hover{
        background: #6a62da;
      }

      .select2-container.select2-container-disabled .select2-choice {
        background-color: #ddd;
        border-color: #a8a8a8;
      }

      .content-header{
        background: white;
        margin-bottom: 20px;
        box-shadow: 0px 0px 5px rgba(125,125,125, 0.5);
      }

      .brand-text{
        font-weight: bold !important;
        font-size: 12pt !important;;
      }

      .scroll-table{
        overflow-x: auto;
      }

      .form-group label{
        font-weight: 500 !important;
      }

      .content{
        margin-top: 28px !important;
        margin-left: 18px !important;
        margin-right: 18px !important;
      }

      .select2-container{
        width: 100% !important;;
      }

      .icheck-primary.d-inline{
        margin-left: 10px;
      }

      .navbar-primary{
        background-color: #4c8bf5;
      }

      .brand-link{
        background: #4c8bf5 !important;
      }

      .nav-link.edp.active{
        background: #4c8bf5;
        color: white;
        border-radius: 20px;
      }

      .btn-primary{
        background-color: #4c8bf5;
      }

      .nav-sidebar > .nav-item > .nav-link.active{
        background-color: #4c8bf5 !important;
      }


      .lds-dual-ring {
        display: inline-block;
        width: 40px;
        height: 40px;
      }
      .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 34px;
        height: 34px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #333;
        border-color: #333 transparent #333 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
      }
      @keyframes lds-dual-ring {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }

      .select2 > *:focus, .select2:focus .select2 > *, .select2 {
          outline-width: 0px !important;
      }

      .CodeMirror {
        border: 1px solid #eee;
        height: auto;
      }
      
      .CodeMirror {
        font-family: Arial, monospace;
        font-size: 12px;
        }

    </style>
    

    <script src="/assets/jquery/jquery.min.js"></script>
    <script src="/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/assets/admin/dist/js/adminlte.js"></script>
    <script src="/assets/admin/dist/js/demo.js"></script>
    <script src="/assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="/assets/admin/plugins/raphael/raphael.min.js"></script>
    <script src="/assets/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="/assets/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="/assets/admin/plugins/chart.js/Chart.min.js"></script>
    <script src="/assets/datatable-bootstrap-4/jquery.dataTables.min.js"></script>
    <script src="/assets/datatable-bootstrap-4/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/datatable-bootstrap-4/dataTables.responsive.min.js"></script>
    <script src="/assets/js/sweetalert.js"></script>
    <script src="/assets/admin/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="/assets/admin/plugins/moment/moment.min.js"></script>
    <script src="/assets/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="/assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/assets/admin/tagsinput.js"></script>
    <script src="/assets/file.js?v=3"></script>
    <script src="/assets/js/chart.js"></script>
    <!-- include summernote css/js -->
    <link href="<?= site_url() ?>assets/mirror/summernote.min.css" rel="stylesheet">

      <script>

        function formatRupiah(angka, prefix) {
          var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);
          // tambahkan titik jika yang di input sudah menjadi angka ribuan
          if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
          }
          rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
          return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }

        $.fn.vall = function(a = 0) {
          a = Number(a);
          var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
          var ids = '#'+id+'_nbr4';
          $("#"+id).val(a);
          var s = a.toFixed(2);
          s = s+'';
          s = s.replace(/\./g, ',');
          $(ids).val(formatRupiah(s));
          return this;
        }

        function setVal(id, val){
          var id = id.replace(/\]/g, "b").replace(/\[/g, "a");
          $("#"+id).vall(val);
        }

        function getVal(id){
          var id = id.replace(/\]/g, "b").replace(/\[/g, "a")
          return Number($("#"+id).val());
        }

        function getId(id){
          return id.replace(/\]/g, "b").replace(/\[/g, "a");
        }

        function delay(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }

        $.fn.slug = function(b = 'slug'){
          this.keyup(function(){
            var vall = $(this).val();
            vall = vall
            .replace(/ /g, "-")
            .replace(/\\/g, "-")
            .replace(/\//g, "-")
            .replace(/\./g, "-")
            .replace(/\</g, "-")
            .replace(/\>/g, "-")
            .replace(/\'/g, "-")
            .replace(/\"/g, "-")
            .replace(/\?/g, "-")
            .replace(/\:/g, "-")
            .replace(/\;/g, "-")
            .replace(/\+/g, "-")
            .replace(/\=/g, "-")
            .replace(/\#/g, "-")
            .replace(/\!/g, "-")
            .replace(/\@/g, "-")
            .replace(/\%/g, "-")
            .replace(/\^/g, "-")
            .replace(/\&/g, "-")
            .replace(/\*/g, "-")
            .replace(/\(/g, "-")
            .replace(/\)/g, "-")
            .replace(/\|/g, "-")
            .replace(/\}/g, "-")
            .replace(/\{/g, "-")
            .replace(/\[/g, "-")
            .replace(/\]/g, "-")
            .replace(/\`/g, "-")
            .replace(/\~/g, "-")

            console.log(vall);

            $('#'+b).val(vall);
          })
          this.on('change', function(){
            var vall = $(this).val();
            vall = vall
            .replace(/ /g, "-")
            .replace(/\\/g, "-")
            .replace(/\//g, "-")
            .replace(/\./g, "-")
            .replace(/\</g, "-")
            .replace(/\>/g, "-")
            .replace(/\'/g, "-")
            .replace(/\"/g, "-")
            .replace(/\?/g, "-")
            .replace(/\:/g, "-")
            .replace(/\;/g, "-")
            .replace(/\+/g, "-")
            .replace(/\=/g, "-")
            .replace(/\#/g, "-")
            .replace(/\!/g, "-")
            .replace(/\@/g, "-")
            .replace(/\%/g, "-")
            .replace(/\^/g, "-")
            .replace(/\&/g, "-")
            .replace(/\*/g, "-")
            .replace(/\(/g, "-")
            .replace(/\)/g, "-")
            .replace(/\|/g, "-")
            .replace(/\}/g, "-")
            .replace(/\{/g, "-")
            .replace(/\[/g, "-")
            .replace(/\]/g, "-")
            .replace(/\`/g, "-")
            .replace(/\~/g, "-")
            $('#'+b).val(vall);
          })
        }

        $.fn.numKeyUp = function(func) {
          var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
          var ids = '#'+id+'_nbr4';

          $(document).on("keyup", ids, delay(function(){

            func($("#"+id).val(), $(this))

          }, 500))
        }

        function numKeyUp(id, func){
          var id = id.replace(/\]/g, "b").replace(/\[/g, "a")
          var ids = '#'+id;
          $(ids).numKeyUp(func);
        }

        $.fn.select2Change = function(a = '') {
          var id = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")
          var ids = this.attr('id').replace(/\]/g, "b").replace(/\[/g, "a")+'-readonly';

          $("#"+ids).val(a);

          var c = $("#"+ids).val();

      		$("#"+id).val(a);
          $("#"+id).select2().trigger('change');
          return this;
        }

      </script>
      <style media="screen">
      .CodeMirror-code span{
        color: white;
      }
      </style>
      <link href="<?= site_url() ?>assets/mirror/summernote.min.css" rel="stylesheet">
      <script src="/assets/mirror/summernote.min.js"></script>


    <script>
      var datalogin = '<?= base64_encode(json_encode(generate_session('datalogin'))) ?>';
    </script>
    <script src="/assets/js/proto.js"></script>
    <script src="<?= site_url() ?>audit-dev/db.js?v=<?= date('ymdhis'); ?>"></script>
    <script src="<?= site_url() ?>audit-dev/table.js?v=<?= date('ymdhis'); ?>"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
          </ul>
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <span style="margin-top: -10px;"><?= datalogin('nama'); ?></span> <i class="fas fa-chevron-down"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?= site_url('admin/profile') ?>" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <div class="media-body" style="color: #333;">
                        <p>Profile</p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= site_url('admin/profile') ?>" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <div class="media-body" style="color: #333;">
                      <p>Ubah Profile</p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
              </div>
            </li>
            <li class="navbar-nav rounded-tumb">
                <a class="nav-link" href="<?= site_url('login/logout'); ?>">
                  <i class="fas fa-sign-out-alt"></i><span> log out </span>
                </a>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside style="background-color: #2a3143;" class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="" class="brand-link">
            <img src="<?= cek(Perusahaans::get(),'logo'); ?>" alt="<?= cek(Perusahaans::get(),'nama'); ?>" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light" style="font-size: 18px;"><?= cek(Perusahaans::get(),'nama'); ?></span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
              <div class="image">
                <img src="<?= cek(Perusahaans::get(),'logo'); ?>" class="img-circle elevation-2" alt="User Image"> 
              </div>
              <div class="info">
                <a href="#" class="d-block"><?= datalogin('nama'); ?></a>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  
                  <?php if(generate_session('dev') == true) : ?>

                <?php foreach(array_keys($menu) as $key => $val) : ?>
                  <?php if($menu[$val] == "#sub") : ?>
                  <li class="nav-item has-treeview" style="border-bottom: 1px solid rgba(255,255,255,0.5)">
                    <a  class="nav-link" style="font-size: 14pt; font-weight: bold;" href="#">
                        <?= $val; ?>
                    </a>
                  </li>
                  <?php else : ?>
                  <?php if($val == $menuactive) : ?>
                          <?php if(is_array($menu[$val])) : ?>
                                  <?php
                                      $cekstat = null;
                                      foreach(array_keys($menu[$val]) as $elm => $ecw){
                                          if (preg_match("/$statususer/i", $auth[$val][$ecw])) {
                                              $cekstat = $statususer;
                                          }
                                      }
                                  ?>
                                  <?php if($statususer == $cekstat) : ?>
                                      <li class="nav-item has-treeview active">
                                          <a class="nav-link" data-toggle="tab" href="<?= str_replace(" ","-",$val); ?>"><i class="nav-icon <?= $icon[$val] ?>"></i>
                                              <p>
                                              <?= $val ?>
                                              </p>
                                          </a>
                                      </li>
                                  <?php endif ?>
                              <?php else : ?>
                                  <?php if(preg_match("/$statususer/i", $auth[$val])) : ?>
                                    <?php if ($val == "Home"): ?>
                                        <li class="nav-item has-treeview active">
                                          <a class="nav-link  active" href="<?= site_url('/').$menu[$val]; ?>"><i class="nav-icon <?= $icon[$val] ?>"></i>
                                            <p>
                                            <?= $val ?>
                                            </p>
                                          </a>
                                        </li>
                                      <?php else: ?>
                                        <li class="nav-item has-treeview active">
                                          <a class="nav-link  active" href="<?= site_url('admin/').$menu[$val]; ?>"><i class="nav-icon <?= $icon[$val] ?>"></i>
                                            <p>
                                            <?= $val ?>
                                            </p>
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
                                  <?php if(preg_match("/$statususer/i",$cekstat)) : ?>
                                  <li class="nav-item has-treeview">
                                      <a class="nav-link" data-toggle="tab" href="<?= str_replace(" ","-",$val); ?>"><i class="nav-icon <?= $icon[$val] ?>"></i>
                                          <p>
                                          <?= $val ?>
                                          </p>
                                      </a>
                                  </li>
                                  <?php endif ?>
                              <?php else : ?>
                                  <?php if(preg_match("/$statususer/i", $auth[$val])) : ?>
                                    <?php if ($val == "Home"): ?>
                                        <li class="nav-item has-treeview">
                                          <a class="nav-link" href="<?= site_url('/').$menu[$val]; ?>"><i class="nav-icon <?= $icon[$val] ?>"></i>
                                            <p>
                                            <?= $val ?>
                                            </p>
                                          </a>
                                        </li>
                                      <?php else: ?>
                                        <li class="nav-item has-treeview">
                                          <a class="nav-link" href="<?= site_url('admin/').$menu[$val]; ?>"><i class="nav-icon <?= $icon[$val] ?>"></i>
                                            <p>
                                            <?= $val ?>
                                            </p>
                                          </a>
                                        </li>
                                    <?php endif; ?>
                                  <?php endif ?>
                          <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php endif; ?>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
