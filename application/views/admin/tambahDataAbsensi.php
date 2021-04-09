<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>         

<div class="card mb-3">
    <div class="card-header bg-primary text-white">
        Input Absensi Pegawai
    </div>
        <div class="card-body">
    
<form class="form-inline">
    <div class="form-group mb-2">
        <label for="bulan">Bulan:</label>
        <select name="bulan" class="form-control ml-2">
            <option value="">--Pillih Bulan--</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>

    <div class="form-group mb-2 ml-5">
        <label for="tahun">Tahun:</label>
        <select name="tahun" class="form-control ml-3">
            <option value="">--Pillih Tahun--</option>
        <?php $tahun = date('Y'); 
        for ($i=2020;$i<$tahun+5;$i++) { ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php } ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye">Generete</i></button>
    </form>
      
        
    </div>
    </div>
    
    <?php 
    if((isset($_GET['bulan']) && $_GET['bulan']!='' ) && (isset($_GET['tahun']) && $_GET['tahun']!='')){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan.$tahun;
    }else{
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan.$tahun;
    }
    ?>
    
    <div class="alert alert-info">
        Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?= $bulan ?></span> Tahun: <span class="text-weight-bold"><?= $tahun ?></span>
    </div>


    <form method="POST">
    <button type="submit" name="submit" class="btn btn-success mb-3" value="submit">Simpan</button>
    <table class="table table-striped table-bordered">
        <tr>
            <td class="text-center">No</td>
            <td class="text-center">Nik</td>
            <td class="text-center">Nama Pegawai</td>
            <td class="text-center">Jenis Kelamin</td>
            <td class="text-center">Jabatan</td>
            <td class="text-center" width="8%">Hadir</td>
            <td class="text-center" width="8%">Sakit</td>
            <td class="text-center" width="8%">Alpha</td>
        </tr>

        <?php
        $no = 1;
        foreach ($input_absensi as $a) : ?>
            <tr>

                <input type="hidden" name="bulan[]" class="form-control" value="<?= $bulantahun ?>">
                <input type="hidden" name="nik[]" class="form-control" value="<?= $a->nik ?>">
                <input type="hidden" name="nama_pegawai[]" class="form-control" value="<?= $a->nama_pegawai ?>">
                <input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?= $a->jenis_kelamin ?>">
                <input type="hidden" name="nama_jabatan[]" class="form-control" value="<?= $a->nama_jabatan ?>">
                <td><?= $no++ ?></td>
                <td><?= $a->nik ?></td>
                <td><?= $a->nama_pegawai ?></td>
                <td><?= $a->jenis_kelamin ?></td>
                <td><?= $a->nama_jabatan ?></td>
                <td><input type="number" name="jumlah_hadir[]" class="form-control" value="0"></td>
                <td><input type="number" name="jumlah_sakit[]" class="form-control" value="0"></td>
                <td><input type="number" name="jumlah_alpha[]" class="form-control" value="0"></td>
            </tr>
        <?php endforeach ; ?>
    </table>
    </form>
</div>
<br><br><br><br><br><br>
