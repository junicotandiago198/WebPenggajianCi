<?php 

class SlipGaji extends CI_Controller{

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
        $data['title'] = "Fillter Slip Gaji Pegawai";
        $data['pegawai'] = $this->penggajianModel->get_data('tbl_pegawai')->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/filterSlipGaji',$data);
        $this->load->view('templates_admin/footer');
    }

    public function cetakSlipGaji()
    {
        $data['title'] = "Cetak Slip Gaji";
        $data['potongan'] = $this->penggajianModel->get_data('tbl_potongan_gaji')->result();
        $nama = $this->input->post('nama_pegawai');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $bulan.$tahun;

    $data['print_slip'] = $this->db->query("SELECT tbl_pegawai.nik,tbl_pegawai.nama_pegawai,tbl_jabatan.nama_jabatan,tbl_jabatan.gaji_pokok,
        tbl_jabatan.tj_transport,tbl_jabatan.uang_makan,tbl_kehadiran.jumlah_alpha,tbl_kehadiran.bulan
        FROM tbl_pegawai
        INNER JOIN tbl_kehadiran ON tbl_kehadiran.nik=tbl_pegawai.nik
        INNER JOIN tbl_jabatan ON tbl_jabatan.nama_jabatan=tbl_pegawai.jabatan
        WHERE tbl_kehadiran.bulan='$bulantahun' AND tbl_kehadiran.nama_pegawai='$nama'")->result();  

        $this->load->view('templates_admin/header',$data);
        $this->load->view('admin/cetakSlipGaji',$data);
    }
}

?>