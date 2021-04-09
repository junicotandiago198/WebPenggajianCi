<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>         

    <?= $this->session->flashdata('pesan') ?>
    <a class="btn btn-success mb-3 btn-sm" href="<?= base_url('admin/dataPegawai/tambahData') ?>"><i class="fas fa-plus"> Tambah Pegawai</i></a>

    <table class="table table-bordered table-striped table-hover">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nik</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Jenis Kelamin</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Tanggal Masuk</th>
                <th class="text-center">Status</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Hak Akses</th>
                <th class="text-center">Action</th>
            </tr>

    <?php 
    $no = 1;
    foreach ($pegawai as $p) : ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p->nik ?></td>
            <td><?= $p->nama_pegawai ?></td>
            <td><?= $p->jenis_kelamin ?></td>
            <td><?= $p->jabatan ?></td>
            <td><?= $p->tanggal_masuk ?></td>
            <td><?= $p->status ?></td>
            <td><img src="<?= base_url().'assets/photo/'.$p->photo ?>" width="80px"></td>
 
            <?php if($p->hak_akses == '1') { ?>
            <td>Admin</td>
            <?php }else { ?>
            <td>Pegawai</td>
            <?php } ?>
            
            <?= $p->hak_akses ?>
        <td>
            <a class="btn btn-sm btn-primary" href="<?= base_url('admin/dataPegawai/updateData/'.$p->id_pegawai) ?>"><i class="fas fa-edit"></i></a>
            <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/dataPegawai/deleteData/'.$p->id_pegawai) ?>"><i class="fas fa-trash"></i></a>
        </td>
        </tr>

    <?php endforeach ; ?>

    </table>

</div>
