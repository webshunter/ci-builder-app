<?php

require_once 'fontawesome/fontFunc.php';
require_once 'table_opsi_set.php';
require_once 'database.php';


function crdb()
{

    // login sistem
    // --------------------------------------
        // coming soon

        // login sistem cant return data 
        /*
            [
                ......
                    "datalogin" => [
                        "id" => "value",
                        "username" => "value",
                        "position" => "",
                        "allconf can build from this" => "",
                    ]
                ......
            ]
        */

    // landing setting up
    // --------------------------------------

        // coming soon
    
    // -----------------------------------------------------------------------------------------------------------------------------------//

    // datatable setting up

    // #1. set all data on crude here 
    // create database name ------------------------- // 
    /*
        [
            ....
                "table" => "table name"
            ....
        ]
    */
    
    // #2. create table row
    /*
        [
            ....
                "data" => [
                    "row_name" => char(255)
                ]
            ....
        ]
        row setting data
        ai() -----> autoincrement row
        char(255) ------> VARCHAR 255 //number can custome 1 - 255
        textlong() ------> set for text long
        no(11) ------> integer data 
        timestamp() ------> set timestamp value for auto date
        timestampupdate() ------> timestamp auto update on update data
        relation(table, table_row, table_relation, table_relation_row) ----> relationship database setting
    */

    // dalam penggunaan metode ini user harus paham karakteristk dari array.
    // #4. form setting

        // comming soon

        /*
            -> no condition form tidak akan di tampilkan dalam kata lain form tidak akan dibuat untuk row table tersebut
            [
                ....
                    "form" => [
                        "id" => "no"
                    ],
                ....
            ]

            -> text condition digunakan untuk membuat text form format
            [
                ....
                    "form" => [
                        "username" => "text"
                    ],
                ....
            ]

            -> number condition digunakan untuk membuat number form format
            [
                ....
                    "form" => [
                        "total" => "number"
                    ],
                ....
            ]

            -> username condition digunakan untuk membuat username form format
            [
                ....
                    "form" => [
                        "total" => "username"
                    ],
                ....
            ]

            -> password condition digunakan untuk membuat password form format
            [
                ....
                    "form" => [
                        "total" => "password"
                    ],
                ....
            ]

            -> editor condition digunakan untuk membuat edito form format dalam hal ini summernote editor
            [
                ....
                    "form" => [
                        "total" => "number"
                    ],
                ....
            ] 

            -> select condition digunakan untuk membuat selection dalam hal ini selection membutuhkan database untuk menopangnya
            -> multiple condition yang digunakan untuk membuat multipple selection
            [
                ....
                    "category_id" => [ 
                        "type" => "select / multiple",  // type digunakan untuk menentukan tipe form
                        "data" => [                     // data merupakan setting dari selection 
                            "db" => "category",         // db disini anda akan memilih data dari table mana yang ingin anda ambil
                            "data" => "id",             // data merupakan setting untuk value yang akan digunakan pada option
                            "name" => "nama_kategori"   // name digunakan untuk tampilan dari option
                        ]
                    ],
                ....
            ] 

            -> login condition yang digunakan untuk membuat dengan nilai default id user yang aktif/ dan hidden form
            [
                ....
                    "user" => "login"
                ....
            ] 

        */ 


    // #4. array condition for join table for view
        // coming soon

    /*
        [
            ....
                "data" => [
                    "row_name" => char(255)
                ]
            ....
        ]
    */

    // #4. array condition for join table for view
        // coming soon


    // #5. set default nilai table
        
        // coming soon

    // #6 title page of admin crud sistem setting
    /*
        [
            ....
                "title" => [
                    "view" => "Customer", -> set for view page
                    "edit" => "Ubah Customer", -> set for edit page
                    "new" => "Tambahkan Customer" -> set for page create new data
                ],
            ....
        ]
    */
    
    // #6 commandAll digunakan untuk membuat command process for create all system
                // coming soon data setting like below
    /*
        [
            ....
               'command' => command("link_name", "table_name"),
               'commandAll' => true,
            ....
        ]
    */
    
    // #7 email setting confige page
        
    // coming soon

    // #8 table design automaticaly
        // coming soon

    // #9 selection icon with modal for font awesome

    // builder with database
    
    $arr = []; 

    // load db set

    $files = scandir('gugus_artisan/dbset');

    foreach($files as $set){
        if($set != "." && $set != ".."){
            eval(ffread('gugus_artisan/dbset/'.$set));
        }
    }

    return $arr;
}
