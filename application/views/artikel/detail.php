<?php
$this->load->view("template/header");
$this->load->view("template/navbar");
?>


<style>
    .img-x{
        width: 100% !important;
        max-width: 250px;
    }
</style>

<main id="main" class="mt-5">



    <!-- ======= Services Section ======= -->
    <section class="services section-bg">
        <div class="container">

            <div class="section-title">
                <h2><?= $data->judul; ?></h2>

            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="icon-box">
                        <h5>
                        <b>
                            <?= html_entity_decode($data->content) ?>
                        </b>
                        </h5>
                        <?= html_entity_decode($data->des) ?>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="icon-box" id="top-artikel">
                        <div class="row" id="artikel">
                        </div>
                        <div id="pagination">
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section><!-- End Services Section -->


</main><!-- End #main -->




<script>


	// artikel area
	var artikel = {
		draw: 1,
		start: 0,
		length: 5
	}

	var site_url = '<?= site_url('') ?>';

	var artikelUrl = '<?= site_url('')?>admin/artikel/table_show/show';

	// get text only
	function gabi_content(content) {
		var c = document.createElement('div');
		c.innerHTML = content;
		return c.textContent;
	}


	function pagination(aq){
		
		if (aq == undefined) {
			aq = 0;
		}

		var c = globalThis.data;
		var d = c.recordsFiltered;
		var e = 5;
		var f = Math.ceil(d / e);
		var dc = 10;
		var op = 10;
		
		console.log(aq);

		if (f <= (aq + op)) {
			op = f - aq;
		}


		var g = div();
		g.id('pagination')
		
		var u = ul().class('pagination')
		
		u.child(
			li().class('page-item').child(
				el('a').class('page-link').text('Previous')
				.click(function(){
					if ((aq - op) < 0) {
						alert('you in first page');
					}else{
						pagination(Number(aq) - op);
					}
				})
			)
		)

		if (f < op) {
			op = f
		}

		for (let w = 0 + aq; w < op + aq; w++) {
			u.child(
				li().class('page-item').child(
					el('a').data('a', w).class('page-link').href('#top-artikel').text(w+1)
					.click(function(){
						var l = this.getAttribute('data-a');
						artikel.start = Number(l) * 5;
						$('html, body').animate({scrollTop: $('#top-artikel').offset().top -100 }, 'slow');
						view();
					})
				)
			)
		}

		u.child(
			li().class('page-item').child(
				el('a').class('page-link').text('Next')
				.click(function(){
					if (f <= (aq + dc)) {
						alert('you on the last page')
					}else{
						pagination(Number(aq) + op);
					}
				})
			)
		)

		var s = el('nav')
		.attr('aria-label', 'Page navigation example')
		.child(u)

		g.child(
			s
		)

		domp('pagination', g);

	}


	function view(){
		axios.post(artikelUrl, artikel).then(function(res){
			
			var data = res.data;

			if (globalThis.data == undefined) {
				globalThis.data = data;
				pagination();
			}


			var em = data.data.map(function(el, e){

				return `
					<div class="col-lg-12 col-md-12">
						<div class="row">
							<div class="col-md-12">
							    <center><b>${el[1]}</b></center>
                                <br>
							</div>
							<div class="col-md-12">
								<h5>${el[2]}</h5>
								${el[4].substring(0, 50)}...
								<br><a href="${site_url}artikel/detail/${el[3]}">baca selengkapnya</a>
                                <hr>
                            </div>
						</div>
					</div>

				`;

			}).join('')


			document.getElementById('artikel').innerHTML = em;
			
		})
	}

	view()


</script>



<?php
$this->load->view("template/footer.php")
?>