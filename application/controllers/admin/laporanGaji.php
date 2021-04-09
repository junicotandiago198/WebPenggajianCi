<?php 
class LaporanGaji extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='1'){
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda Belum Login!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Gaji Pegawai";
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/filterLaporanGaji');
        $this->load->view('templates_admin/footer');
    }

    public function cetakLaporanGaji()
    {
        $data['title'] = "Cetak Laporan Gaji Pegawai";
        if((isset($_GET['bulan']) && $_GET['bulan']!='' ) && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
        $data['potongan'] = $this->penggajianModel->get_data('tbl_potongan_gaji')->result();
        $data['cetakGaji'] = $this->db->query("SELECT tbl_pegawai.nik,tbl_pegawai.nama_pegawai,tbl_pegawai.jenis_kelamin,tbl_jabatan.nama_jabatan,
        tbl_jabatan.gaji_pokok,tbl_jabatan.tj_transport,tbl_jabatan.uang_makan,tbl_kehadiran.jumlah_alpha
        FROM tbl_pegawai
        INNER JOIN tbl_kehadiran ON tbl_kehadiran.nik=tbl_pegawai.nik   
        INNER JOIN tbl_jabatan ON tbl_jabatan.nama_jabatan=tbl_pegawai.jabatan
        WHERE tbl_kehadiran.bulan='$bulantahun'
        ORDER BY tbl_pegawai.nama_pegawai ASC")->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('admin/cetakDataGaji',$data);
    }
}

?>