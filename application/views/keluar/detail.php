<div class="card p-3">
    <?php $kode = 'OUT'.substr(md5($keluar['tgl_keluar']), 0, 7); ?>
    <?php $t = explode(" ",$keluar['tgl_keluar']); ?>
    <div class="row"><div class="col"><h4>

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
                    <input type="hidden" name="tgl_keluar" value="<?= $keluar['tgl_keluar'] ;?>">
                </tr>
            </table>

    </h4></div></div>

    <div id="keluar"></div>
</div>


<script>
    $('#keluar').load("<?= base_url(); ?>keluar/itemTambah/<?= $kode; ?>") ;      
</script>