<div id="keluar">
    <?php if(!empty($this->session->flashdata('pesan') )) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php endif ; ?>
    <br>
    <h5>Unit Barang Keluar <button class="btn btn-primary" id='refresh' data-toggle='tooltip' title='Refresh'><i class="fa fa-sync"></i></button></h5> 
    <form action="" method='post' id='tambah_item_barang'>
        <div class="row">
            <div class="col-md-12">
                <label for="id_barang">Barang</label>
                <select name="id_barang" id="id_barang" class='form-control mb-3'>
                    <option value="">-pilih-</option>
                    <?php foreach ($barang as $b) : ?>
                        <option value="<?= $b['id_barang']; ?>|<?= $b['satuan'];?>|<?= $b['harga_jual'];?>"><?= $b['nama_barang']; ?></option>
                    <?php endforeach ; ?>
                </select><br><br>
            </div>
            <div class="col-md-2">
                <label for="qty">Jumlah</label>
                <input type="number" name="qty" id="qty" class='form-control mb-3'>
            </div>
            <div class="col-md-2">
                <label for="satuan">Satuan</label>
                <input type="text" name="satuan" id="satuan" class='form-control mb-3'>
            </div>
            <div class="col-md-4">
                <label for="harga_jual">Harga Beli</label>
                <input type="number" name="harga_jual" id="harga_jual" class='form-control mb-3'>
            </div>
            <div class="col-md-4">
                <label for="total_jual">Total</label>
                <div class="input-group mb-3">
                    <input type="number" name="total_jual" id="total_jual" class='form-control'>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="sumbit" id="button-addon2">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($item as $row) : ?>
                    <tr>
                        <td><?= $row['kode_keluar']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['qty']; ?></td>
                        <td><?= $row['satuan']; ?></td>
                        <td><?= $row['harga_jual']; ?></td>
                        <td><?= $row['total_jual']; ?></td>
                        <td>
                            <a href="#" class="badge badge-danger" id='hapusItem_<?= $row['id_keluar']; ?>'><i class="fa fa-trash" data-toggle='tooltip' title='Hapus Data'></i></a>
                        </td>
                    </tr>

                    <script>
                        $("#hapusItem_<?= $row['id_keluar']; ?>").click(function(e){
                            if(confirm("Yakin ?")) {
                                e.preventDefault();
                                $.ajax({
                                    url: '<?= base_url(); ?>keluar/deleteItemKeluar/<?= $kode; ?>/<?= $row['id_keluar'];?>',
                                    type: 'post',
                                    data: $(this).serialize(),             
                                    success: function(data) {               
                                        $('#keluar').html(data) ;      
                                    }
                                });
                            }else{
                                return false ;
                            }
                        }) ;
                    </script>
                    <?php $total += $row['total_jual'] ; ?>
                <?php endforeach ; ?>
                <tr>
                    <th colspan=5>Total</th>
                    <th><?= $total; ?></th>
                    <th><a href="<?= base_url(); ?>cetak/cetakNotaKeluar/<?= $kode; ?>" target='blank' class="badge badge-info" data-toggle='tooltip' title='Cetak Nota'><i class="fa fa-print"></i></a></th>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script>
        $("#id_barang").select2({
            theme: 'bootstrap4'
        });

        $("#id_barang").change(function(){
            if( $("#id_barang").val() != 0 ){
                var satuan = $("#id_barang").val().split("|") ;
                // console.log(satuan[1]) ;
                $("#satuan").val(satuan[1]) ;
                $("#harga_jual").val(satuan[2]) ;
            }else{
                $("#satuan").val('') ;
                $("#harga_jual").val('') ;
            }
        });
        

        $('#qty').keyup(function(){
            if($("#harga_jual").val()) {
                var total = $("#harga_jual").val() * $("#qty").val() ;
                $("#total_jual").val(total) ;
            }
        }) ;

        $('#harga_jual').keyup(function(){
            if($("#qty").val()) {
                var total = $("#harga_jual").val() * $("#qty").val() ;
                $("#total_jual").val(total) ;
            }
        }) ;


        $("#tambah_item_barang").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>keluar/addItemKeluar/<?= $kode; ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#keluar').html(data) ;      
                }
            });
        }) ;

        $("#refresh").click(function(){
            $("#keluar").load("<?= base_url() ;?>keluar/itemTambah/<?= $kode; ?>")
        });
    </script>
</div>








