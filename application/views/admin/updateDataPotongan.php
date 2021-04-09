<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="card" style="width: 60%" style="margin-bottom: 80px">
    <div class="card-body">

    <?php foreach($potongan as $p) : ?>
        <form method="post" action="<?= base_url('admin/potonganGaji/updateDataAksi') ?>">
        <div class="form-group">
            <label>Jenis Potongan</label>
            <input type="hidden" class="form-control" name="id" value="<?= $p->id ?>">
            <input type="text" class="form-control" name="potongan" value="<?= $p->potongan ?>">
            <?= form_error('potongan','<div class="text-danger text-small">','</div>') ?>
        </div>

        <div class="form-group">
            <label>Jumlah Potongan</label>
            <input type="number" class="form-control" name="jml_potongan" value="<?= $p->jml_potongan ?>">
            <?= form_error('jml_potongan','<div class="text-danger text-small">','</div>') ?>
        </div> 

        <button type="submit" class="btn btn-success">Update</button>
        </form> 
    <?php endforeach ; ?>
    </div>
</div>

</div>