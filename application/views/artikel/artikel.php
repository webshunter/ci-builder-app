<?php
$this->load->view("template/header");
$this->load->view("template/navbar");
?>

<style media="screen">
.icon-box{
padding: 10px !important;
}

.icon-box p{
font-size: 12px !important;
}
</style>

<main id="main" class="mt-5">
    <!-- ======= Services Section ======= -->
    <section class="services section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Cari Obat</h2>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="icon-box">
                        <div style="padding: 20px;">
                          <input type="text" id="search" class="form-control" placeholder="pencarian...">
                          <select class="form-control mt-3" name="">
                            <option value="">Tipe Obat</option>
                          </select>
                          <button class="btn btn-primary mt-3" onclick="searchFunc(document.getElementById('search').value)">submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div id="detail" class="row">
                    </div>
                    <div id="pagination">
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->
</main><!-- End #main -->


<script>


  var id = null;

	// artikel area
	var artikel = {
		draw: 1,
		start: 0,
		length: 9
	}

  var tags = location.hash.replace('#', '');

	if (tags != "") {
		artikel.start = tags.replace('page-', '');
	}


	var site_url = '<?= site_url('') ?>';

	var artikelUrl = '<?= site_url('')?>admin/apiobat/table_show2/show';

	// get text only
	globalThis.gabi_content = function(content) {
		var c = document.createElement('div');
		c.innerHTML = content;
		return c.textContent;
	}

	globalThis.pagination = function(aq){

		if (aq == undefined) {
			aq = 0;
		}

		var c = globalThis.data;
		var d = c.recordsFiltered;
		var e = artikel.length;
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
						globalThis.pagination(Number(aq) - op);
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
					el('a').data('a', w).class('page-link').css({cursor:'pointer'}).text(w+1)
					.click(function(){
						var l = this.getAttribute('data-a');
						artikel.start = Number(l) * 5;
            location.hash = 'page-'+artikel.start;
            globalThis.view();
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
						globalThis.pagination(Number(aq) + op);
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


	globalThis.view = function(func = ''){
		axios.post(artikelUrl, artikel).then(function(res){

			var data = res.data;

			if (globalThis.data == undefined) {
				globalThis.data = data;
				globalThis.pagination();
			}


			var em = data.data.map(function(el, e){

				return `
					<div class="col-lg-4 col-md-6 col-6">
              <div class="icon-box">
                  <center>
                    <div class='img-view' style="width: 100%; height: 100px; display: inline-block; background-image: url('${el[1]}'); background-size: cover; background-repeat:no-repeat; background-position: center;"></div>
                    <p style="margin-top:10px;" style="font-size: 12px;"><b>${el[2]}</b></p>
                  </center>
              </div>
					</div>
				`;

			}).join('')

      if (em == '') {
        em += `
					<div class="col-lg-12 col-md-12 col-12">
              <div class="icon-box">
                  <div style="padding: 20px 0;">
                    <center>
                      <i class="fas fa-archive" style="font-size: 55px"></i>
                      <br>
                      <h1>Data Belum Tersedia</h1>
                    </center>
                  </div>
              </div>
					</div>
				`;
      }

			document.getElementById('detail').innerHTML = em;

      setTimeout(function() {
        if(func != ''){
          func();
        }
      }, 100);

		})
	}

  globalThis.aturan = function(func = ''){
    document.getElementById('detail').innerHTML = ``;
    setTimeout(function() {
      if(func != ''){
        func();
      }
    }, 100);
  }

  globalThis.obatTerpilih = function(a){
  }

  globalThis.aturanObat = function(a){
  }

  globalThis.saveobat = function(idobat){
    axios.post(site_url+'admin/obatpenyakit/saveobat', {id: id, idobat: idobat}).then(function(els){
      globalThis.tableku.ajax.reload()
      $('.modal').modal('toggle');
    })
  }


  globalThis.view();


  function searchFunc(a) {
    artikel['search'] = {
      value: a
    }
    globalThis.view();
  }


  $(document).ready(function(){
		setTimeout(function(){
			$('html, body').animate({scrollTop: 0}, 'slow');
		},100)

	});

</script>

<?php
  $this->load->view("template/footer.php")
?>
