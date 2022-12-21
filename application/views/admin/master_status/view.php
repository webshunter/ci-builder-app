<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Status</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <?php
                        link_button([
                            "link" => "admin/master_status/tambah_data",
                            "class" => "btn btn-primary",
                            "text" => "Tambah Data",
                        ]);
                    ?>
                </div>
                <div class="card-body">
                    <?= $datatable ?>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
<script>
var linkUrl = '<?= site_url('admin/master_status/tambah_data') ?>';

$(document).ready(function(){
    tableku.on( 'draw', function () {
        $(".dataTables_empty").html(`
          <a href="${linkUrl}" class="btn btn-primary mt-5 mb-5"><i class="fas fa-plus"></i> Tambah Data</a>
        `)
    })
})
</script>