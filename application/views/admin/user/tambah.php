<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambahkan user</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('toko') }}">Home</a></li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('admin/user/simpan') ?>" method="post" enctype="multipart/form-data">
                        
                <?=
                    form::input([
                        "title" => "foto",
                        "type" => "file",
                        "fc" => "foto",
                        "placeholder" => "tambahkan foto",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "nama",
                        "type" => "text",
                        "fc" => "nama",
                        "placeholder" => "tambahkan nama",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "level",
                        "type" => "text",
                        "fc" => "level",
                        "placeholder" => "tambahkan level",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "username",
                        "type" => "username",
                        "fc" => "username",
                        "placeholder" => "tambahkan username",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "password",
                        "type" => "password",
                        "fc" => "password",
                        "placeholder" => "tambahkan password",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "passwordview",
                        "type" => "text",
                        "fc" => "passwordview",
                        "placeholder" => "tambahkan passwordview",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "created_at",
                        "type" => "text",
                        "fc" => "created_at",
                        "placeholder" => "tambahkan created_at",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "updated_at",
                        "type" => "text",
                        "fc" => "updated_at",
                        "placeholder" => "tambahkan updated_at",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "delete_set",
                        "type" => "text",
                        "fc" => "delete_set",
                        "placeholder" => "tambahkan delete_set",
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/user'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>