<div id="td-close<?= $urutan ?>" class="row" data-no="<?= $urutan ?>">
  <div class="col-sm-12">
    <input type="hidden" name="databarangpembelian[<?= $urutan ?>][tipe_kontent]" value="<?= $tipe ?>">
    <?php if ($tipe == 1): ?>
      <?=
        form::editor([
          "type" => "text",
          "fc" => "databarangpembelian[$urutan][kontent]",
          "placeholder" => "tambahkan tag",
        ])
      ?>
    <?php elseif ($tipe == 2): ?>
      <?=
        form::input([
          "type" => "file",
          "fc" => "databarangpembelian[$urutan][kontent]",
          "required" => true,
          "tag" => true,
          "placeholder" => "inputkan file",
        ])
      ?>
    <?php elseif ($tipe == 3 || $tipe == 4): ?>
      <?=
        form::editor([
          "type" => "text",
          "fc" => "databarangpembelian[$urutan][kontent]",
          "tag" => true,
          "codeeditor" => true,
          "placeholder" => "tambahkan tag",
        ])
      ?>
    <?php elseif ($tipe == 5): ?>
        <?=
          form::input([
            "type" => "file",
            "fc" => "databarangpembelian[$urutan][kontent]",
            "required" => true,
            "show-image" => true,
            "placeholder" => "inputkan image",
          ])
        ?>
    <?php elseif ($tipe == 6): ?>
        <?=
          form::input([
            "type" => "text",
            "readonly" => true,
            "fc" => "databarangpembelian[$urutan][kontent]",
            "placeholder" => "inputkan image",
            "value" => "adpaylink",
          ])
        ?>
    <?php elseif ($tipe == 7): ?>
        <?=
          form::input([
            "type" => "text",
            "readonly" => true,
            "fc" => "databarangpembelian[$urutan][kontent]",
            "placeholder" => "inputkan image",
            "value" => "propeller",
          ])
        ?>
      <?php elseif ($tipe == 8): ?>
        <?=
          form::editor([
            "type" => "text",
            "fc" => "databarangpembelian[$urutan][kontent]",
            "tag" => true,
            "codeeditor" => true,
            "placeholder" => "tambahkan tag",
          ])
        ?>
      <?php elseif ($tipe == 9): ?>
        <?=
          form::editor([
            "type" => "text",
            "fc" => "databarangpembelian[$urutan][kontent]",
            "tag" => true,
            "codeeditor" => true,
            "placeholder" => "tambahkan tag",
          ])
        ?>
        <?php elseif ($tipe == 10): ?>
        <?=
          form::editor([
            "type" => "text",
            "fc" => "databarangpembelian[$urutan][kontent]",
            "tag" => true,
            "codeeditor" => true,
            "placeholder" => "tambahkan tag",
          ])
        ?>
    <?php endif; ?>
  </div>
  <button type="button" class="btn btn-primary" onclick="document.querySelector('#td-close<?= $urutan ?>').remove()" name="button">Hapus Content</button>
</div>
