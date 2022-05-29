<div id="halaman">
    <div class="card p-3">

        <?php if($aksi == 'Ubah') : ?>
            <?php $nama_barang = "value='$barang[nama_barang]'" ; ?>
            <?php $harga_jual = "value='$barang[harga_jual]'" ; ?>
            <?php $stok = "value='$barang[stok]'" ; ?>
            <?php $satuan = "value='$barang[satuan]'" ; ?>
        <?php else : ?>
            <?php $nama_barang = "" ; ?>
            <?php $harga_jual = "" ; ?>
            <?php $stok = "" ; ?>
            <?php $satuan = "" ; ?>
        <?php endif ; ?>

        <form action="" method='post'>
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class='form-control mb-3' <?= $nama_barang; ?>>
            <small id="usernameHelp" class="form-text text-danger"><?= form_error('nama_barang'); ?></small>
            <div class="row">
                <div class="col-md-6">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" name="harga_jual" id="harga_jual" class='form-control mb-3' <?= $harga_jual; ?>>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('harga_jual'); ?></small>
                </div>
                <div class="col-md-3">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" id="satuan" class='form-control mb-3' <?= $satuan; ?>>
                    <small id="usernameHelp" class="form-text text-danger"><?= form_error('satuan'); ?></small>
                </div>
                <div class="col-md-3">
                    <label for="stok">STOK</label>
                    <input type="number" name="stok" id="stok" class='form-control mb-3' <?= $stok; ?>>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>