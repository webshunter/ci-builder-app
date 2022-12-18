<!-- datatable server side  -->
<div class="content-wrapper">
    <section class="content">
        <div id="table">

        </div>
    </section>
</div>


<script>

async function newTable(){

    var params = new URLSearchParams();
    params.append('draw', 1);
    params.append('start', 10);
    params.append('length', 10);
    var _url = '<?= site_url(); ?>';
    var data = await axios.post(_url+'admin/akun/table_show/show/', params);
    data = data.data;
    console.log(data);
    var tbl = div();
    tbl.display('flex');
    tbl.width('100%')
    tbl.child(
        tabel().id('table1').class('table')
    )
    getElementById('table1', function(tblKolom){
        for (let x = 0; x < data.data.length; x++) {
            var isi = tr()
            for (let i = 0; i < data.data[x].length; i++) {
                isi.child(
                    td().html(data.data[x][i])
                )
            }
            tblKolom.child(
                isi
            )
        }
    });
    domp('table', tbl);
}
newTable();

</script>


<!-- by kang js -->
