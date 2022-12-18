<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Createtable extends CI_Model{


    private $table_name;
    private $target_table;
    private $row_table;
    private $table_location;
    private $option_delete;
    private $option_update;

    private function config_csrf(){
        $html = "
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                }
            })
        ";
        return $html;
    }

    public function location($location)
    {
        $this->table_location = $location;
    }

    public function table_name($name)
    {
        $this->table_name = $name;
    }

    public function set_delete($aa){
        $this->option_delete = $aa;
    }

    public function set_update($aa){
        $this->option_update = $aa;
    }

    private function create_delete_action(){
        $html = '
            $(document).on("click", ".delete",function(){
                event.preventDefault();
                var dataId = $(this).attr("data-id");
                swal({
                  title: "Hapus Data",
                  text: "Anda yakin ingin menghapus data ini",
                  type: "info",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  showLoaderOnConfirm: true
                }, function () {
                  setTimeout(function () {
                    $.ajax({
                        url: "'.site_url($this->table_location).'/delete",
                        method: "post",
                        dataType: "text",
                        data: {
                            id: dataId
                        }, success:function(){
                            '.$this->table_name.'.ajax.reload();
                            $(".modal").modal("toggle");
                        }
                    })
                    swal("Data Telah Dihapus !");
                  }, 1000);
                });


            })
        ';

        return $html;
    }

    private function create_update_action(){
        $html = '
            $(document).on("click", ".edit",function(){
                event.preventDefault();
                var dataId = $(this).attr("data-id");
                location.href = "'.site_url($this->table_location).'/update/"+dataId;
            })
        ';
        return $html;
    }

    public function create_row($arr)
    {
        $create_row = "";
        foreach($arr as $key => $val){
            $create_row .= "<th>".$val."</th>";
        }
        $this->row_table = $create_row;
    }

    public function order_set($aa){
        $this->target_table = $aa;
    }

    public function create()
    {
        $html =
        '
        <table id="'.$this->table_name.'" class="table" style="width:100%">
                    <thead>
                        <tr style="background-color: #4c8bf5; color: #ffffff;">
                            '.$this->row_table.'
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <script>


                    '.$this->config_csrf().'

                    var func = function(a, b){

                    }

                    globalThis.tableUrlStart = "'.site_url($this->table_location).'/show";

                    globalThis.tableUrl = "'.site_url($this->table_location).'/show";

                    var '.$this->table_name.' = null;

                    function loadTable(){
                        '.$this->table_name.' = $("#'.$this->table_name.'").DataTable({
                            responsive: {
                                details: {
                                    display: $.fn.dataTable.Responsive.display.modal( {
                                        header: function ( row ) {
                                            var data = row.data();
                                            return "Details for "+data[0]+" "+data[1];
                                        }
                                    } ),
                                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                                        tableClass: "table"
                                    } )
                                }
                            },
                            processing: true,
                            serverSide: true,
                            order: [],
                            ajax: {
                                "url"       : globalThis.tableUrl,
                                "type"      : "POST"
                            },
                            deferRender: true,
                            columnDefs:[
                                {
                                    targets:['.$this->target_table.'],
                                    orderable: false
                                }
                            ],
                            "initComplete": func
                        })

                        globalThis.'.$this->table_name.' = '.$this->table_name.';

                        '.$this->create_update_action().'

                        '.$this->create_delete_action().'

                    }

                    $(document).ready(loadTable);

                    let getTh = document.querySelectorAll("th");
                    getTh.forEach(th => {
                        if (th.innerText == "ACTION") {
                            th.style.minWidth = "180px";
                        }
                    })

                    var ubahAction = Array.from(document.querySelectorAll("th"))
                    var varAction = ubahAction.length - 1;

                    ubahAction[varAction].innerText = "Tindakan";


                </script>

        ';
        return $html;
    }

}
