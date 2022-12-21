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
        <a class="nav-link" id="logoutaction" data-link="<?= site_url('login/logout'); ?>" href="">
            <i class="fas fa-sign-out-alt"></i><span> log out </span>
        </a>
    </li>
    </ul>
</nav>
<!-- logout action with sweetalert -->
<script>
     _id('logoutaction').onclick = function(event){
        event.preventDefault();
        var link = event.target.getAttribute('data-link')
        swal({
          title: "Logout App",
          text: "klik ok untuk logout dari app",
          type: "info",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        }, function () {
          setTimeout(function () {
            location.href = link;
          }, 1000);
        });
      }
</script>