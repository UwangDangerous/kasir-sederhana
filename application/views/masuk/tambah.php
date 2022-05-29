<div class="card p-3">
    <?php $kode = 'IN'.substr(md5($tanggal), 0, 8); ?>
    <?php $t = explode(" ",$tanggal); ?>
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
            </tr>
        </table>

    </h4></div></div>

    <div id="masuk"></div>
</div>


<script>
    $(document).ready(function(){
        $("#masuk").load("<?= base_url(); ?>masuk/itemTambah/<?= $kode; ?>") ;
    });
</script>