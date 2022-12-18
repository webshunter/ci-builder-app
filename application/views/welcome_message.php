
<style>

	#hero{
		background-image: url('<?= cek(Perusahaans::get(),'bg') ?>');
		min-height: 100vh;
		background-repeat: no-repeat;
		background-position: center center;
	}


	@media screen and (max-width: 600px){
		.container-fluid{
	    padding: 0;
	  }
	  div, span, p, i, a{
	    font-size: 10pt;
	  }
	}

	.img-x{
		width: 100% !important;
		float: left;
		margin: 10px;
	}

	.ads-banner::before{
      content: "Ads";
      position: absolute;
      display: flex;
      width: 60%;
      height: 60%;
      text-align: center;
      align-items: center;
      justify-content: center;
      font-size: 50px;
      color: #ccc;
      border-radius: 10px;
      left: 20%;
      top: 20%;
      background: linear-gradient(270deg, #98b0aa, #e1eae8, #94a8a4);
      background-size: 600% 600%;
      -webkit-animation: adsbanner 4s ease infinite;
      -moz-animation: adsbanner 4s ease infinite;
      animation: adsbanner 4s ease infinite;
    }

     @-webkit-keyframes adsbanner {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
    }
    @-moz-keyframes adsbanner {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
    }
    @keyframes adsbanner {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
    }

    .ads-banner{
      position: relative;
      height: 200px;
    }


</style>
<!-- ======= Hero Section ======= -->
<section class="mt-5">

	<div class="container">
		<div class="row d-flex align-items-center justify-content-center mb-3">
			<div class="col-lg-4 pt-4">
				<h1><?= cek(Perusahaans::get(),'nama')?></h1>
				<p>
					Belajar website bersama indowebs lebih mudah.
					<br><a style="width: 150px;" href="<?= site_url('blog'); ?>" class="btn btn-primary mt-3">Lihat Blog</a>
				</p>
			</div>
			<div class="col-lg-6 pt-4">
				<img class="img-fluid" src="<?= base_url(cek(Perusahaans::get(),'bg-icon')) ?>" alt="indowebs code">
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-lg-12 text-center">
				<h2>Artikel Terbaru</h2>
			</div>
			<div class="col-lg-12 mt-5">
				<?php

				$tr = new Tabledx;
				$tr->table("post");
				$tr->condition([
				  "menu" => "1",
				  "kategori" => [
				    "opsi" => "=",
				    "val" => "1"
				  ],
				  "slug" => [
				    "opsi" => "NOT LIKE",
				    "val" => "%blog%"
				  ]
				]);
				$tr->limit(0, 6);
				$tr->order("no_post", "DESC");

				echo "<div class='row'>";

				foreach($tr->getResult() as $key => $rdata){

				  echo '<div class="col-lg-4 col-sm-6 col-12 mb-4">';
				  echo '  <div class="card h-100">';
				  echo '  <img src="assets/gambar/post/'.$rdata->thumbnails.'" style="width: 100%" alt="'.$rdata->judul.'" />';
				  echo '    <div class="card-body">';
				  echo '      <a href="/'.$rdata->slug.'"><h5 style="font-size: 16pt;">'.$rdata->judul.'</h5></a>';
				  echo '      <p>'.$rdata->deskripsi.'</p>';
				  echo '    </div>';
				  echo '    <a href="/'.$rdata->slug.'" class="btn btn-primary">View Detail</a>';
				  echo '  </div>';
				  echo '</div>';
				}

				echo "</div>";




				 ?>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-lg-12 text-center">
				<h3>Artikel</h3>
			</div>
		</div>
		<div class="row">
			<?php
				$tr = new Tabledx;
				$tr->table("kategori");
				$tr->condition([
				    "pilihan" => [
				        "opsi" => "NOT LIKE",
				        "val" => "%app%"
				    ]
				]);
			 ?>
				<?php foreach ($tr->getResult() as $key => $value): ?>
					 <a class="col-lg-4 col-6 mb-4" href="blog-<?= str_replace(" ", "-", $value->pilihan) ?>">
						 <div class="card">
						 	<div class="card-body text-center" style="font-size: 12pt;">
								<img style="max-width: 150px; width: 100%;" src="<?= base_url('assets/icon-menu.png') ?>" alt="<?= $value->pilihan ?>">


						 	</div>
<span class="btn btn-primary w-100">
								<?= $value->pilihan ?>
								</span>
						 </div>
					 </a>
				<?php endforeach; ?>
		</div>
	</div>

</section><!-- End Hero -->

