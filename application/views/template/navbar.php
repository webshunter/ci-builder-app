<style>

.btn-sky-blue:hover{
  background-color: #49a4d6;
}

.btn-sky-blue{
  background-color: #49b5e7;
  padding: 10px 24px;
  border: none;
  outline: none;
  border-radius: 10px;
  transition: 0.4s;
  color: #fff;
}

.sky-blue{
  background: #fdfdfd !important;
}

.sky-blue .logo a{
  color: #333333 !important;
}

.sky-blue .nav-menu a{
  color: #333333;
}

#hero h1, #hero h2 ,#hero h3{
  color: #333333 !important;
}

</style>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top sky-blue">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="<?= base_url('') ?>"><img src="<?= cek(Perusahaans::get(),'logo') ?>" style="height: 80px; width: auto;"><span class="head-name" style="font-size: 18px;"><?= cek(Perusahaans::get(),'nama_perusahaan'); ?></span></a></h1>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li><a href="<?= base_url('') ?>">Home</a></li>
                <li><a href="<?= base_url('app') ?>">App</a></li>
                <li><a href="<?= base_url('blog') ?>">Blog</a></li>
                <li><a href="<?= base_url('about') ?>">About</a></li>
                <li><a href="<?= base_url('contact') ?>">Contact</a></li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->
