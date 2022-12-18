<?php


function page1()
{

$arr = [];

$arr[] = [
  'table' => 'termin',
  'data' => [
      'id' => ai(),
      'pilihan' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'pilihan' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'no',
      'Pilihan',
      'tanggal dibuat',
      'tanggal diupdate',
  ],
    "title" => [
        "view" => "Grup Kontak",
        "edit" => "Ubah Grup Kontak",
        "new" => "Tambahkan Grup Kontak"
    ],
  'command' => 'php gugus template termin --crud termin',
//   'commandupdate' => 'false',
];

$arr[] = [
  'table' => 'gudang',
  'data' => [
      'id' => ai(),
      'nama' => char(255),
      'kode' => char(255),
      'alamat' => char(255),
      'keterangan' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'nama' => 'text',
      'kode' => 'text',
      'alamat' => 'editor',
      'keterangan' => 'editor',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'no',
      'Nama',
      'Kode',
      'Alamat',
      'Keterangan',
      'tanggal dibuat',
      'tanggal diupdate',
  ],
    "title" => [
        "view" => "Gudang",
        "edit" => "Ubah Gudang",
        "new" => "Tambahkan Gudang"
    ],
  'command' => 'php gugus template gudang --crud gudang',
//   'commandupdate' => 'false',
];

$arr[] = [
  'table' => 'kontak',
  'data' => [
      'id' => ai(),
      'nama_panggilan' => char(255),
      'tipe_kontak' => char(255),
      'group_kontak' => char(255),
      'panggilan' => char(255),
      'nama_awal' => char(255),
      'nama_tengah' => char(255),
      'nama_akhir' => char(255),
      'handphone' => char(255),
      'identitas' => char(255),
      'id_identitas' => char(255),
      'email' => char(255),
      'info_lain' => char(255),
      'nama_perusahaan' => char(255),
      'telp' => char(255),
      'fax' => char(255),
      'npwp' => char(255),
      'alamat_pembayaran' => text(),
      'alamat_pengirim' => text(),
      'bank' => textlong(),
      'akun_piutang' => char(255),
      'akun_hutang' => char(255),
      'syarat_pembayaran_utama' => char(255),
      'kode' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'nama_panggilan' => 'text',
      "tipe_kontak" => [
            "type" => "multicheck",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "tipekontak",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
        "group_kontak" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "goupkontak",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
      'panggilan' => 'text',
      'nama_awal' => 'text',
      'nama_tengah' => 'text',
      'nama_akhir' => 'text',
      'handphone' => 'text',
      'identitas' => 'text',
      'email' => 'text',
      'info_lain' => 'text',
      'nama_perusahaan' => 'text',
      'telp' => 'text',
      'fax' => 'text',
      'npwp' => 'text',
      'alamat_pembayaran' => 'text',
      'alamat_pengirim' => 'text',
      'bank' => 'text',
      "akun_piutang" => [
              "type" => "select",  // type digunakan untuk menentukan tipe form
              "data" => [                     // data merupakan setting dari selection
                  "db" => "akun",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                  "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                  "name" => "nama_akun"   // name digunakan untuk tampilan dari option
              ]
          ],
          "akun_hutang" => [
                  "type" => "select",  // type digunakan untuk menentukan tipe form
                  "data" => [                     // data merupakan setting dari selection
                      "db" => "akun",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                      "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                      "name" => "nama_akun"   // name digunakan untuk tampilan dari option
                  ]
              ],
      'syarat_pembayaran_utama' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'Nama Panggilan',
      'Tipe Kontak',
      'Group Kontak',
      'Panggilan',
      'Nama Awal',
      'Nama Tengah',
      'Nama Akhir',
      'Handphone',
      'Identitas',
      'Email',
      'Info Lain',
      'Nama Perusahaan',
      'Telp',
      'Fax',
      'NPWP',
      'Alamat Pembayaran',
      'Alamat Pengirim',
      'Bank',
      'Akun Piutang',
      'Akun Hutang',
      'Syarat Pembayaran Utama',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Kontak",
        "edit" => "Ubah Kontak",
        "new" => "Tambahkan Kontak"
    ],
  'command' => 'php gugus template kontak --crud kontak',
  'commandupdate' => 'false',
];


// pembelian

$arr[] = [
  'table' => 'datapembelian',
  'data' => [
      'id' => ai(),
      'pembelian_id' => char(255),
      'produk' => char(255),
      'qty' => char(255),
      'satuan' => char(255),
      'harga' => char(255),
      'diskon' => char(255),
      'diskon_nominal' => char(255),
      'jumlah' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'no_nota' => 'text',
      'tanggal' => 'date',
      "termin" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "termin",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
      'jatuh_tempo' => 'date',
      "kode" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "kontak",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "kode"   // name digunakan untuk tampilan dari option
            ]
        ],
      'nama' => 'text',
      'alamat' => 'text',
      'ongkir' => 'text',
      'pembayaran' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'No Nota',
      'Tanggal',
      'Termin',
      'Jatuh Tempo',
      'Kode',
      'Nama',
      'Alamat',
      'Ongkir',
      'Pembayaran',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Data Pembelian",
        "edit" => "Ubah Data Pembelian",
        "new" => "Tambahkan Data Pembelian"
    ],
  'command' => 'php gugus template datapembelian --crud datapembelian',
  'commandupdate' => 'false',
];

$arr[] = [
  'table' => 'datapenjualan',
  'data' => [
      'id' => ai(),
      'pembelian_id' => char(255),
      'produk' => char(255),
      'qty' => char(255),
      'satuan' => char(255),
      'harga' => char(255),
      'diskon' => char(255),
      'diskon_nominal' => char(255),
      'jumlah' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'no_nota' => 'text',
      'tanggal' => 'date',
      "termin" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "termin",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
      'jatuh_tempo' => 'date',
      "kode" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "kontak",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "kode"   // name digunakan untuk tampilan dari option
            ]
        ],
      'nama' => 'text',
      'alamat' => 'text',
      'ongkir' => 'text',
      'pembayaran' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'No Nota',
      'Tanggal',
      'Termin',
      'Jatuh Tempo',
      'Kode',
      'Nama',
      'Alamat',
      'Ongkir',
      'Pembayaran',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Data Pembelian",
        "edit" => "Ubah Data Pembelian",
        "new" => "Tambahkan Data Pembelian"
    ],
  'command' => 'php gugus template datapembelian --crud datapembelian',
  'commandupdate' => 'false',
];

$arr[] = [
  'table' => 'databank',
  'data' => [
      'id' => ai(),
      'kontak_id' => char(255),
      'nama_bank' => char(255),
      'kantor_cabang_bank' => char(255),
      'pemegang_akun_bank' => char(255),
      'nomor_rekening' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ]
];


$arr[] = [
  'table' => 'productbundle',
  'data' => [
      'id' => ai(),
      'produk_id' => char(255),
      'produk' => char(255),
      'qty' => char(255),
      'harga' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'no_nota' => 'text',
      'tanggal' => 'date',
      "termin" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "termin",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
      'jatuh_tempo' => 'date',
      "kode" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "kontak",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "kode"   // name digunakan untuk tampilan dari option
            ]
        ],
      'nama' => 'text',
      'alamat' => 'text',
      'ongkir' => 'text',
      'pembayaran' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'No Nota',
      'Tanggal',
      'Termin',
      'Jatuh Tempo',
      'Kode',
      'Nama',
      'Alamat',
      'Ongkir',
      'Pembayaran',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Data Pembelian",
        "edit" => "Ubah Data Pembelian",
        "new" => "Tambahkan Data Pembelian"
    ],
  'command' => 'php gugus template datapembelian --crud datapembelian',
  'commandupdate' => 'false',
];

$arr[] = [
  'table' => 'pembelian',
  'data' => [
      'id' => ai(),
      'no_nota' => char(255),
      'tanggal' => char(255),
      'termin' => char(255),
      'jatuh_tempo' => char(255),
      'kode' => char(255),
      'nama' => char(255),
      'alamat' => char(255),
      'ongkir' => char(255),
      'pembayaran' => char(255),
      'hutang' => char(255),
      'pajak' => char(255),
      'subtotal' => char(255),
      'total' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'no_nota' => 'text',
      'tanggal' => 'date',
      "termin" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "termin",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
      'jatuh_tempo' => 'date',
      "kode" => [
            "type" => "select",
            "data" => [
                "db" => "kontak",
                "data" => "id",
                "name" => "kode"
            ]
        ],
      'nama' => 'text',
      'alamat' => 'text',
      'ongkir' => 'text',
      'pembayaran' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'No Nota',
      'Tanggal',
      'Termin',
      'Jatuh Tempo',
      'Kode',
      'Nama',
      'Alamat',
      'Ongkir',
      'Pembayaran',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Pembelian",
        "edit" => "Ubah Pembelian",
        "new" => "Tambahkan Pembelian"
    ],
  'command' => 'php gugus template pembelian --crud pembelian',
  'commandupdate' => 'false',
];


$arr[] = [
  'table' => 'penjualan',
  'data' => [
      'id' => ai(),
      'no_nota' => char(255),
      'tanggal' => char(255),
      'termin' => char(255),
      'jatuh_tempo' => char(255),
      'kode' => char(255),
      'nama' => char(255),
      'alamat' => char(255),
      'ongkir' => char(255),
      'pembayaran' => char(255),
      'hutang' => char(255),
      'pajak' => char(255),
      'subtotal' => char(255),
      'total' => char(255),
      'keterangan' => text(),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'no_nota' => 'text',
      'tanggal' => 'date',
      "termin" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "termin",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "pilihan"   // name digunakan untuk tampilan dari option
            ]
        ],
      'jatuh_tempo' => 'date',
      "kode" => [
            "type" => "select",  // type digunakan untuk menentukan tipe form
            "data" => [                     // data merupakan setting dari selection
                "db" => "kontak",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                "name" => "kode"   // name digunakan untuk tampilan dari option
            ]
        ],
      'nama' => 'text',
      'alamat' => 'text',
      'ongkir' => 'text',
      'pembayaran' => 'text',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'No Nota',
      'Tanggal',
      'Termin',
      'Jatuh Tempo',
      'Kode',
      'Nama',
      'Alamat',
      'Ongkir',
      'Pembayaran',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Pembelian",
        "edit" => "Ubah Pembelian",
        "new" => "Tambahkan Pembelian"
    ],
  'command' => 'php gugus template penjualan --crud penjualan',
  'commandupdate' => 'false',
];

$arr[] = [
  'table' => 'biaya',
  'data' => [
      'id' => ai(),
      'akun_pembayaran' => char(255),
      'Penerima' => char(255),
      'tanggal_transaksi' => char(255),
      'cara_pembayaran' => char(255),
      'no_biaya' => char(255),
      'tanggal_jt' => char(255),
      'syarat_pembayaran' => char(255),
      'tag' => char(255),
      'alamat' => text(),
      'data_biaya' => textlong(),
      'subtotal' => char(255),
      'pajak' => char(255),
      'akun_pemotong' => char(255),
      'potongan' => char(255),
      'total' => char(255),
      'pembayaran' => char(255),
      'hutang' => char(255),
      'memo' => char(255),
      'lampiran' => char(255),
      'created_at' => timestamp(),
      'updated_at' => timestampupdate(),
      'delete_set' => char(255, '0'),
  ],
  'form' => [
      'id' => 'no',
      'akun_pembayaran' => 'text',
     "akun_pembayaran" => [
            "type" => "select",
            "data" => [
                "db" => "akun",
                "data" => "id",
                "name" => "nama_akun"
            ]
        ],
      'Penerima' => 'text',
      'tanggal_transaksi' => 'date',
       "cara_pembayaran" => [
            "type" => "select",
            "data" => [
                "db" => "paymen_method",
                "data" => "id",
                "name" => "pilihan"
            ]
        ],
      'no_biaya' => 'text',
      'tag' => 'text',
      'alamat' => 'text',
      'data_biaya' => 'text',
      'memo' => 'editor',
      'lampiran' => 'file',
      'created_at' => 'no',
      'updated_at' => 'no',
      'delete_set' => 'no',
  ],
  'name' => [
      'No',
      'Akun Pembayaran',
      'Penerima',
      'Tanggal Transaksi',
      'Cara Pembayaran',
      'No Biaya',
      'Tag',
      'Alamat',
      'Data Biaya',
      'Memo',
      'Lampiran',
      'Tanggal Dibuat',
      'Tanggal Diupdate',
    ],
    "title" => [
        "view" => "Biaya",
        "edit" => "Ubah Biaya",
        "new" => "Tambahkan Biaya"
    ],
  'command' => 'php gugus template biaya --crud biaya',
  'commandupdate' => 'false',
];

// data pembelian



return $arr;

}
