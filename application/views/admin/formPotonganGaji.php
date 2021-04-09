<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>         

    <div class="card" style="width: 65%">
        <div class="card-body">

        <form method="post" action="<?= base_url('admin/potonganGaji/tambahDataAksi') ?>">

            <div class="form-group">
                <label>Jenis Potongan</label>
                <input type="text" name="potongan" class="form-control">
                <?= form_error('potongan','<span class="text-danger text-small">','</span>') ?>
            </div>

            <div class="form-group">
                <label>Jumlah Potongan</label>
                <input type="number" name="jml_potongan" class="form-control">
                <?= form_error('jml_potongan','<span class="text-danger text-small">','</span>') ?>
            </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>

</div>
