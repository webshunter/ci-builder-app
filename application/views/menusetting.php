
<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Setting Menu</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>
  </div>

  <?php
    $this->load->model('Tabledx');
    $tr = new Tabledx;
    $tr->table("leveluser");

    $datamenu = [
      "Dasbor",
      "Laporan",
      "Kontak",
      "Daftar Akun",
      "Produk",
      "Daftar Lain",
      "Produksi",
      "Biaya",
      "Pembelian",
      "Penjualan",
      "User",
      "Profile"
    ];

  ?>


  <div class="content">
      <div class="container-fluid">

        <div class="bg-white" style="padding: 10px;">
          <table class="table">
            <tr class="text-center">
              <th>Menu</th>
              <th>Icon</th>
              <th>Setting</th>
            </tr>
            <?php foreach ($datamenu as $kyt => $values): ?>
              <tr>
                <td>
                  <input type="text" class="form-control" name="title" readonly value="<?= $values ?>">
                </td>
                <td>
                  <input type="text" class="form-control" data-name="icon" data-icon="<?= $values ?>" name="title" value="<?= setting("menu-setting")->$values->icon ?>">
                </td>
                <td>
                  <?=
                      form::input([
                          "type" => "text",
                          "fc" => "no_nota",
                          "attr" => ' data-name="level" data-icon="'.$values.'" ',
                          "placeholder" => "level",
                          "value" => setting("menu-setting")->$values->level
                      ])
                  ?>
                </td>
                <td>
                  <div class="row">
                    <?php foreach ($tr->getResult() as $key => $value): ?>
                      <div class="col-sm-3">
                        <button type="button" style="width:100%" class="btn btn-primary" name="button" data-toggle="modal" data-target="#<?= $value->pilihan.$kyt; ?>"><i class="fas fa-cog"></i> <?= $value->pilihan; ?></button>
                      </div>
                      <!-- The Modal -->

                      <?php
                        $lkp = $value->pilihan;

                        $lpss = setting("menu-setting")->$values;

                        $rr = $value->pilihan;

                        $rdd = $lpss->$rr;


                       ?>

                      <div class="modal" id="<?= $value->pilihan.$kyt; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="">Create</label>
                                <input class="form-control" type="text" data-a="create" data-c="<?= $values ?>" data-b="<?= $rr ?>" name="<?= $value->pilihan ?>[create]" value="<?= $rdd->create ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Edit</label>
                                <input class="form-control" type="text" data-a="update" data-c="<?= $values ?>" data-b="<?= $rr ?>" name="<?= $value->pilihan ?>[update]" value="<?= $rdd->update ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Delete</label>
                                <input class="form-control" type="text" data-a="delete" data-c="<?= $values ?>" data-b="<?= $rr ?>" name="<?= $value->pilihan ?>[delete]" value="<?= $rdd->delete ?>">
                              </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>


                    <?php endforeach; ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">


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


  document.body.className += " sidebar-collapse";


var edt = null;

  Array.from(document.querySelectorAll('[data-icon]')).forEach((item, i) => {

    item.addEventListener('keydown', function(){
      var val = this.value;
      var dat = this.getAttribute('data-icon');
      var elm = this;

      var cek = document.getElementById(dat+'-icon');
      if (cek == undefined) {
        var smp = div().css({
          xIndex: 99999,
          position: 'fixed',
          padding: '10px',
          background: 'white',
          boxShadow: '0 0 10px rgba(125,125,125,0.3)',
          borderRadius: '20px',
          top: '180px',
          right: '50px',
          opacity: '0',
          transition: '0.3s'
        })
        .id(dat+'-icon')
        .class("d-flex align-items-center")
        .text('on prosses')
        .child(
          div().class('lds-dual-ring')
        )

        edt = smp;

        document.body.appendChild(smp.get());

      }

      setTimeout(function(){
          edt.css({
            opacity: '1'
          })
        elm.focus();
      },0)

    }, false);
    item.addEventListener('keyup', delay(function(){
      var val = this.value;
      var dat = this.getAttribute('data-icon');
      var name = this.getAttribute('data-name');
      $.ajax({
        url: "<?= site_url("home/simpanicon") ?>",
        method: "POST",
        dataType: "text",
        data: {
          val: val,
          dat: dat,
          name: name
        },success:function(res){
          console.log(res);
          edt.css({
            opacity: '0'
          })
          setTimeout(function(){
            document.getElementById(dat+'-icon').remove();
          },200)

        }
      })
    },1000), false);

  });



  $('.x').on("keyup",".txtbox",function(e){
      if (e.keyCode == 13) {//here you use e.which then it will good
          alert("hi");
        }
    });


  Array.from(document.querySelectorAll('[data-a]')).forEach((item, i) => {

    item.addEventListener('keydown', function(){
      var val = this.value;
      var dat1 = this.getAttribute('data-a');
      var dat2 = this.getAttribute('data-b');
      var dat3 = this.getAttribute('data-c');
      var elm = this;

      var cek = document.getElementById(dat1+'-icon');
      if (cek == undefined) {
        var smp = div().css({
          xIndex: 99999999,
          position: 'fixed',
          padding: '10px',
          background: 'white',
          boxShadow: '0 0 10px rgba(125,125,125,0.3)',
          borderRadius: '20px',
          top: '180px',
          right: '50px',
          opacity: '0',
          transition: '0.3s'
        })
        .id(dat1+'-icon')
        .class("d-flex align-items-center")
        .text('on prosses')
        .child(
          div().class('lds-dual-ring')
        )

        edt = smp;

        document.body.appendChild(smp.get());

      }

      setTimeout(function(){
          edt.css({
            opacity: '1'
          })
        elm.focus();
      },0)

    }, false);

    item.addEventListener('keyup', delay(function(){

      var val = this.value;
      var dat1 = this.getAttribute('data-a');
      var dat2 = this.getAttribute('data-b');
      var dat3 = this.getAttribute('data-c');
      var elm = this;

      $.ajax({
        url: "<?= site_url("home/simpanopsi") ?>",
        method: "POST",
        dataType: "text",
        data: {
          val: val,
          dat1: dat1,
          dat3: dat3,
          dat2: dat2
        },success:function(res){
          console.log(res);
          edt.css({
            opacity: '0'
          })
          setTimeout(function(){
            document.getElementById(dat1+'-icon').remove();
          },200)

        }
      })
    },1000), false);

  });




</script>
