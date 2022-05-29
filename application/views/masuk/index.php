<div class="card p-3">

    <div class="row">
        <div class="col">
            <a href="<?= base_url(); ?>masuk/tambah" class="btn btn-primary mb-3">Tambah Data</a>
        </div>
    </div>

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>

        <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
            <?=  $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php endif ; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($masuk as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_masuk']; ?></td>
                        <td>
                            <?php $tgl = explode(" ", $row['tgl_masuk']) ; ?>
                            <?= $this->_Date->formatTanggal( $tgl[0] ); ?> <?= $tgl[1]; ?>
                        </td>
                        <td>
                            <?= $this->Masuk_model->totalMasuk($row['kode_masuk']); ?>
                        </td>
                        <td>
                            <a href="<?= base_url();?>masuk/detail/<?= $row['kode_masuk'];?>" data-toggle='tooltip' title='Rincian Data Barang' class="badge badge-primary"><i class="fa fa-eye"></i></a>
                            <a href="<?= base_url();?>masuk/hapus/<?= $row['kode_masuk'];?>" data-toggle='tooltip' title='Hapus Data Barang' class="badge badge-danger" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>

</div>
