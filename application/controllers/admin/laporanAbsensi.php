<?php 
class LaporanAbsensi extends CI_Controller{

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
        $data['title'] = "Laporan Absensi";
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/filterLaporanAbsensi');
        $this->load->view('templates_admin/footer');
    }

    public function cetakLaporanAbsensi()
    {
       $data['title'] = "Cetak Laporan Absensi";
    if((isset($_GET['bulan']) && $_GET['bulan']!='' ) && (isset($_GET['tahun']) && $_GET['tahun']!='')){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan.$tahun;
    }else{
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan.$tahun;
    }
       $data['lap_kehadiran'] = $this->db->query("SELECT * FROM tbl_kehadiran WHERE bulan='$bulantahun'
       ORDER BY nama_pegawai ASC")->result();
       $this->load->view('templates_admin/header',$data);
       $this->load->view('admin/cetakLaporanAbsensi',$data);

    }
}

?>