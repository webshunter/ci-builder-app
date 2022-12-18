<?php


function page2()
{
    
$arr = [];

$arr[] = [ 
  'table' => 'meta', 
  'data' => [ 
      'id' => ai(), 
      'meta' => char(255), 
      'created_at' => timestamp(), 
      'updated_at' => timestampupdate(), 
      'delete_set' => char(255, '0'), 
  ], 
  'form' => [ 
      'id' => 'no',
      'meta' => 'text', 
      'created_at' => 'no', 
      'updated_at' => 'no', 
      'delete_set' => 'no', 
  ], 
  'name' => [ 
      'No', 
      'Meta', 
      'Tanggal Dibuat', 
      'Tanggal Diupdate', 
  ], 
  "title" => [
        "view" => "Meta",
        "edit" => "Ubah Meta",
        "new" => "Tambahkan Meta"
    ],
  'command' => 'php gugus template meta --crud meta',
//   'commandupdate' => 'false',
];

$arr[] = [ 
  'table' => 'skill', 
  'data' => [ 
      'id' => ai(),
      'foto' => char(255),
      'skill' => char(255), 
      'deskripsi' => text(),
      'created_at' => timestamp(), 
      'updated_at' => timestampupdate(), 
      'delete_set' => char(255, '0'), 
  ], 
  'form' => [ 
      'id' => 'no',
      'foto' => 'file', 
      'skill' => 'text', 
      'deskripsi' => 'editor',
      'created_at' => 'no',
      'updated_at' => 'no', 
      'delete_set' => 'no', 
  ], 
  'name' => [ 
      'No', 
      'Foto',
      'Skill',
      'Deskripsi',
      'Tanggal Dibuat', 
      'Tanggal Diupdate', 
  ], 
  "title" => [
        "view" => "skill",
        "edit" => "Ubah skill",
        "new" => "Tambahkan skill"
    ],
  'command' => 'php gugus template skill --crud skill',
//   'commandupdate' => 'false',
];

return $arr;

}