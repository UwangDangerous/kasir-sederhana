<div class="card p-3">

    <div class="row">
        <div class="col">
            <a href="<?= base_url(); ?>keluar/tambah" class="btn btn-primary mb-3">Tambah Data</a>
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
                <?php foreach ($keluar as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_keluar']; ?></td>
                        <td>
                            <?php $tgl = explode(" ", $row['tgl_keluar']) ; ?>
                            <?= $this->_Date->formatTanggal( $tgl[0] ); ?> <?= $tgl[1]; ?>
                        </td>
                        <td>
                            <?= $this->Keluar_model->totalKeluar($row['kode_keluar']); ?>
                        </td>
                        <td>
                            <a href="<?= base_url();?>keluar/detail/<?= $row['kode_keluar'];?>" data-toggle='tooltip' title='Rincian Data Barang' class="badge badge-primary"><i class="fa fa-eye"></i></a>
                            <a href="<?= base_url();?>keluar/hapus/<?= $row['kode_keluar'];?>" data-toggle='tooltip' title='Hapus Data Barang' class="badge badge-danger" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>

</div>
