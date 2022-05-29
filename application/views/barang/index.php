<div class="card p-3">

    <?php if(!empty($this->session->flashdata('pesan') )) : ?>

    <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php endif ; ?>

    <div class="row">
        <div class="col">
            <a href="<?= base_url(); ?>barang/tambah" class="btn btn-primary mb-3">Tambah Data</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ; ?>
                <?php foreach ($barang as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['harga_jual']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="<?= base_url();?>barang/ubah/<?= $row['id_barang'];?>" data-toggle='tooltip' title='Ubah Data Barang' class="badge badge-success"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url();?>barang/hapus/<?= $row['id_barang'];?>" data-toggle='tooltip' title='Hapus Data Barang' class="badge badge-danger" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </tbody>
        </table>
    </div>

</div>
