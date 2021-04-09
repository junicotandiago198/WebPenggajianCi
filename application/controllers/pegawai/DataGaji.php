<?php 

Class DataGaji extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('hak_akses') !='2'){
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
        $data['title'] = "Data Gaji Pegawai";
        $nik = $this->session->userdata('nik');
        $data['potongan'] = $this->penggajianModel->get_data('tbl_potongan_gaji')->result();
        $data['gaji'] = $this->db->query("SELECT tbl_pegawai.nama_pegawai,tbl_pegawai.nik,tbl_jabatan.gaji_pokok,tbl_jabatan.tj_transport,
        tbl_jabatan.uang_makan,tbl_kehadiran.jumlah_alpha,tbl_kehadiran.bulan,tbl_kehadiran.id_kehadiran
        FROM tbl_pegawai
        INNER JOIN tbl_kehadiran ON tbl_kehadiran.nik=tbl_pegawai.nik 
        INNER JOIN tbl_jabatan ON tbl_jabatan.nama_jabatan=tbl_pegawai.jabatan
        WHERE tbl_kehadiran.nik= '$nik'
        ORDER BY tbl_kehadiran.bulan DESC")->result();
        $this->load->view('templates_pegawai/header',$data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dataGaji',$data);
        $this->load->view('templates_pegawai/footer');
    }

    public function cetakSlip($id)
    {
        $data['title'] = "Cetak Slip Gaji";
        $data['title'] = "Cetak Slip Gaji";
        $data['potongan'] = $this->penggajianModel->get_data('tbl_potongan_gaji')->result();

        $data['print_slip'] = $this->db->query("SELECT tbl_pegawai.nik,tbl_pegawai.nama_pegawai,tbl_jabatan.nama_jabatan,tbl_jabatan.gaji_pokok,
        tbl_jabatan.tj_transport,tbl_jabatan.uang_makan,tbl_kehadiran.jumlah_alpha,tbl_kehadiran.bulan
        FROM tbl_pegawai
        INNER JOIN tbl_kehadiran ON tbl_kehadiran.nik=tbl_pegawai.nik
        INNER JOIN tbl_jabatan ON tbl_jabatan.nama_jabatan=tbl_pegawai.jabatan
        WHERE tbl_kehadiran.id_kehadiran='$id'")->result();  
        $this->load->view('templates_pegawai/header',$data);
        $this->load->view('pegawai/cetakSlipGaji',$data);
    }
}
