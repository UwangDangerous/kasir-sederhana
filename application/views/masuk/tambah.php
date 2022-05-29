<div class="card p-3">
    <?php $kode = 'IN'.substr(md5($tanggal), 0, 8); ?>
    <?php $t = explode(" ",$tanggal); ?>
    <div class="row"><div class="col"><h4>
        <form action="" method="post" id="addMasuk">

            <table cellpadding=3 cellspacing=3> 
                <tr>
                    <th>Kode Transaksi</th>
                    <th>:</th>
                    <td><?= $kode; ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <th>:</th>
                    <td><?= $this->_Date->formatTanggal($t[0]); ?> <?= $t[1]; ?></td>
                    <input type="hidden" name="tgl_masuk" value="<?= $tanggal ;?>">
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        <br>
                        <div id="btn-simpan">
                            <button type="submit" class="btn btn-primary">Lanjutkan Transaksi</button>
                        </div>
                    </th>
                </tr>
            </table>

        </form>

    </h4></div></div>

    <div id="masuk"></div>
</div>


<script>
    $("#addMasuk").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>masuk/addMasuk/<?= $kode; ?>',
                type: 'post',
                data: $(this).serialize(),             
                success: function(data) {               
                    $('#btn-simpan').hide() ;      
                    $('#masuk').html(data) ;      
                }
            });
        }) ;
</script>