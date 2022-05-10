<div class="row">
    <div class="col-4">
        <b><?= $brg['nama_perusahaan']; ?></b> <br>
        <?= $brg['alamat']; ?>
        <br>
        <?= $brg['pos']; ?><br>
        <?= $brg['nama_kota']; ?>
        <?= $brg['nama_prov']; ?> Indonesia
        <br>
        Telepon : <?= $brg['phone']; ?> <br>
        Email : <?= $brg['email']; ?>
    </div>
    <div class="col-4">
        <b>PPPOMN-BMN</b> <br>
        Gudang BMN <br>
        Jalan Percetakan Negara Nomor 23 <br><br>

        Jakarta - 10560 - Indonesia <br><br>

        Telpon: +6221 4244691 <br>
        Email: ppid@pom.go.id
    </div>
    <div class="col-4"> 
        <b>
            Referensi : <br>
            <?= $brg['kode_brg_masuk']; ?> <br>
            <?= $this->_Code->getBarcodeSVG($brg['kode_brg_masuk']); ?>
        </b>
    </div>
</div>
<br>

<div class="card p-2">
    <h4>Tambah Item</h4>
    <form action="<?= base_url();?>admin/barangMasuk/tambahItem/<?= $brg['id_brg_masuk'] ;?>" method='post'>
        <div class="row">
            <div class="col-md-10">
                <label for="flexibel">Deskripsi</label>
                <select name="id_barang" id="flexibel" class='form-control'>
                    <option value="">--pilih--</option>
                    <?php foreach ($barang as $b) : ?>
                        <option value="<?= $b['id_barang']; ?>"> <?= $b['nama_barang']; ?> </option>
                    <?php endforeach ; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label for="jumlah_brg_masuk">Kuantitas</label>
                <input type="number" name="jumlah_brg_masuk" id="jumlah_brg_masuk" class='form-control'>
            </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        
    </form>
</div>

<?php if(!empty($this->session->flashdata('pesan') )) : ?>
                    
    <div class="alert alert-<?= $this->session->flashdata('warna') ;?> alert-dismissible fade show" role="alert">
        <?=  $this->session->flashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <br>

<?php endif ; ?>

<br>
<div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Deskripsi</th>
                <th>Kuantitas</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
            <?php $no=1 ; ?>
            <?php $total = 0; ?>
            <?php foreach ($item as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <?php $id = $row['id_brg_masuk_item']; ?>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['jumlah_brg_masuk']; ?></td>
                    <td><?= $row['nama_unit']; ?></td>
                    <td>
                        <a href="" class="badge badge-success" data-toggle='modal' data-target='#edit_item_<?= $id?>' data-toggle='tooltip' title='Ubah Item'><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url(); ?>admin/barangMasuk/hapusItem/<?= $id; ?>/<?= $brg['id_brg_masuk'] ;?>" class="badge badge-danger" data-toggle='tooltip' title='Hapus Item' onclick='return confirm("Yakin hapus data ini?")'><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit_item_<?= $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubah Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url();?>admin/barangMasuk/ubahItem/<?= $id; ?>/<?= $brg['id_brg_masuk'];?>" method='post'>
                                <div class="modal-body">
                                    <label for="nama_barang">Deskripsi</label>
                                    <input type="text" id="nama_barang" class='form-control' disabled value="<?= $row['nama_barang'];?>">
                                    <label for="jumlah_brg_masuk_<?= $id;?>" class='mt-3'>Kuantitas</label>
                                    <input type="number" name="jumlah_brg_masuk_<?= $id;?>" id="jumlah_brg_masuk_<?= $id;?>" class='form-control' value="<?= $row['jumlah_brg_masuk'];?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

            <?php endforeach ; ?>
        </thead>
    </table>

    <?php if($brg['note'] != '') : ?>
        <i class="text-danger">*catatan : <?= $brg['note']; ?></i>
    <?php endif ; ?>

    <br>

    <a href="<?= base_url(); ?>cetak/cetakBarangMasuk/<?= $brg['id_brg_masuk'] ; ?>" target="blank" class="btn btn-primary" data-toggle='tooltip' title='Cetak'><i class="fa fa-print"></i></a>
</div>