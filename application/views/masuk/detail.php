<div class="card p-3">
    <?php $kode = 'IN'.substr(md5($masuk['tgl_masuk']), 0, 8); ?>
    <?php $t = explode(" ",$masuk['tgl_masuk']); ?>
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
                    <input type="hidden" name="tgl_masuk" value="<?= $masuk['tgl_masuk'] ;?>">
                </tr>
            </table>

    </h4></div></div>

    <div id="masuk"></div>
</div>


<script>
    $('#masuk').load("<?= base_url(); ?>masuk/itemTambah/<?= $kode; ?>") ;      
</script>