<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Setting Template</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
                    <div class="card">
                        <div class="card-bodyt" >
                            <textarea id="editor"></textarea>
                        </div>
                    </div>
                    <script>
                        
                        (function ($) {
                            "use strict";
                            CodeMirror.fromTextArea(document.getElementById("editor"), {
                             lineNumbers: false,
                             matchBrackets: true,
                             styleActiveLine: true,
                             theme:"ambiance"
                           });
                        })(jQuery);
                    </script>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
            