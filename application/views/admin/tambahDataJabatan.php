<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="card" style="width: 60%" style="margin-bottom: 80px">
    <div class="card-body">
        <form method="post" action="<?= base_url('admin/dataJabatan/tambahDataAksi') ?>">
        <div class="form-group">
            <label>Nama Jabatan</label>
            <input type="text" class="form-control" name="nama_jabatan">
            <?= form_error('nama_jabatan','<div class="text-danger text-small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Gaji Pokok</label>
            <input type="text" class="form-control" name="gaji_pokok">
            <?= form_error('gaji_pokok','<div class="text-danger text-small">','</div>') ?>
        </div>

         <div class="form-group">
            <label>Tunjangan Transport</label>
            <input type="text" class="form-control" name="tj_transport">
            <?= form_error('tj_transport','<div class="text-small text-danger">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Uang Makan</label>
            <input type="text" class="form-control" name="uang_makan">
            <?= form_error('uang_makan','<div class="text-small text-danger">','</div>') ?>
        </div>
        

        <button type="submit" class="btn btn-success">Simpan</button>
        </form> 
    </div>
</div>

</div>