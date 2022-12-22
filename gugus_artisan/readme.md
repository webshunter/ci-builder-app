# artisan documentation
tata cara penggunaan artisan.
### pembuatan datatable baru
untuk membuat datatable baru pertama anda harus membuat config setingnya terlebih dahulu dengan cara buat file .set di folder dbset, berikut contoh configurasinya
```
$arr[] = [ 
    'table' => 'project', 
    'data' => [ 
        'id' => ai(), 
        'nama' => char(255),  
        'tanggal' => char(255),  
        'keterangan' => textlong(),  
        'status' => char(255),  
        'created_at' => timestamp(), 
        'updated_at' => timestampupdate(), 
        'delete_set' => char(1, '0'),
    ], 
    'form' => [ 
        'id' => 'no', 
        'nama' => 'text', 
        'tanggal' => 'text', 
        'keterangan' => 'text', 
        'status' => 'text',
        'created_at' => 'no',
        'updated_at' => 'no',
        'delete_set' => 'no',
    ], 
    'name' => [ 
        'no', 
        'nama', 
        'tanggal', 
        'keterangan', 
        'status', 
        'created_at', 
        'updated_at', 
    ], 
    "title" => [
          "view" => "Project",
          "edit" => "Ubah Project",
          "new" => "Tambahkan Project"
      ],
    'command' => 'php artisan template project --crud project',
    'value' => [
      [
          "nama" => "Karya Karma Perkasa",
          "tanggal" => "2021-10-15",
          "keterangan" => "",
          "status" => "1",
          "delete_set" => "0",
      ]
    ]
  ]; 
```

untuk membuat side menu dengan menambahkan setting berikut pada dbset

```
$arr[] = [ 
    'table' => 'menu', 
    'data' => [ 
        'id' => ai(), 
        'type' => char(255),  
        'urut' => char(255),  
        'header' => char(255),  
        'nama' => char(255),  
        'link' => char(255),  
        'parent' => char(255),
        'icon' => char(255),
    ], 
    'form' => [ 
    ], 
    'name' => [  
    ], 
    "title" => [
          "view" => "Project",
          "edit" => "Ubah Project",
          "new" => "Tambahkan Project"
      ],
    'value' => [
      [
          "type" => "1",
          "urut" => "1",
          "header" => "",
          "nama" => "dashboard",
          "link" => "admin/home",
          "icon" => "fas fa-home",
          "parent" => ""
      ],
      [
          "type" => "1",
          "urut" => "2",
          "header" => "Master",
          "nama" => "Master",
          "icon" => "fas fa-book",
          "link" => "#",
          "parent" => ""
      ],
      [
          "type" => "2",
          "urut" => "1",
          "header" => "",
          "nama" => "Status",
          "link" => "admin/master_status",
          "icon" => "fas fa-tag",
          "parent" => "Master"
      ],
      [
          "type" => "1",
          "urut" => "3",
          "header" => "",
          "nama" => "Project",
          "link" => "admin/project",
          "icon" => "fas fa-tag",
          "parent" => ""
      ],
    ]
  ]; 
```

