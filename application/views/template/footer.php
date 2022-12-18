<!-- ======= Footer ======= -->



<footer id="footer">
    <div class="footer-top ">
        <div class="container ">
            <div class="row">

                <div class="col-lg-4 col-md-6 footer-contact">
                    <h3><?= cek(Perusahaans::get(),'nama_perusahaan'); ?></h3>
                    <p>
                        blog pemrograman indonesia. temukan source code yang anda butuhkan dan pelajari dengan mudah.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Kategori Menu</h4>
                </div>
                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Sosial Media</h4>
                    <p>Kunjungi sosial media kami.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
      <style media="screen">
      .copyright{
width: 100%;
text-align: center !important;
}
      </style>
        <div class="copyright d-flex justify-content-center">
            <?= cek(Perusahaans::get(),'copyright'); ?>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="https://infomalang.web.app/api/front/assets/vendor/jquery/jquery.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/php-email-form/validate.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/venobox/venobox.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/counterup/counterup.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="https://infomalang.web.app/api/front/assets/vendor/owl.carousel/owl.carousel.min.js"></script>

<!-- Template Main JS File -->
<script src="https://infomalang.web.app/api/front/assets/js/main.js"></script>

<script type="text/javascript">
  setInterval(()=>{
    $(".mobile-nav-toggle i").attr("class", "fas fa-bars");
    $(".back-to-top i").attr("class", "fas fa-angle-up");
  })
</script>

</body>

</html>
