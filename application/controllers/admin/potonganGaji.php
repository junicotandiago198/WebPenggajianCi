<?php 
class PotonganGaji extends CI_Controller{

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
        $data['title'] = "Setting Potongan Gaji";
        $data['pot_gaji'] = $this->penggajianModel->get_data('tbl_potongan_gaji')->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/potonganGaji',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahData()
    {
        $data['title'] = "Tambah Data Potongan Gaji";
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formPotonganGaji',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahDataAksi()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE){
            $this->tambahData();
        }else{
            $potongan       = $this->input->post('potongan');
            $jml_potongan   = $this->input->post('jml_potongan');
        
        $data = array (
            'potongan'      => $potongan,
            'jml_potongan'  => $jml_potongan
        );

        $this->penggajianModel->insert_data($data,'tbl_potongan_gaji');
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Type Berhasil Ditambah!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>');
                redirect('admin/potonganGaji');
        }
    }

    public function updateData($id)
    {
        $where = array('id' => $id);
        $data['potongan'] = $this->db->query("SELECT * FROM tbl_potongan_gaji WHERE id='$id'")->result();  
        $data['title'] = 'Update Data Potongan Gaji';
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/updateDataPotongan',$data);
        $this->load->view('templates_admin/footer');
    }

    public function updateDataAksi()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE){
            $this->updateData();
        }else {
            $id             = $this->input->post('id');
            $potongan       = $this->input->post('potongan');
            $jml_potongan   = $this->input->post('jml_potongan');
        

        $data = array (
            'potongan'      => $potongan,
            'jml_potongan'  => $jml_potongan
        );

        $where = array (
            'id'       => $id
        );

        $this->penggajianModel->update_data('tbl_potongan_gaji',$data,$where);
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Diupdate!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/potonganGaji');
    }
}

    public function _rules()
    {
        $this->form_validation->set_rules('potongan','Potongan','required');
        $this->form_validation->set_rules('jml_potongan','Jml_Potongan','required');
    }

    public function hapusData($id){
        $where = array('id' => $id);
        $this->penggajianModel->delete_data($where,'tbl_potongan_gaji');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Pegawai Berhasil Hapus!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/potonganGaji');
    }
}

?>