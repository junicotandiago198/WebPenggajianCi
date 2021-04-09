<?php 

class dataPegawai extends CI_Controller{

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
        $data['title'] = "Data Pegawai";
        $data['pegawai'] = $this->penggajianModel->get_data('tbl_pegawai')->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataPegawai',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahData()
    {
        $data['title'] = "Tambah Data Pegawai";
        $data['jabatan'] = $this->penggajianModel->get_data('tbl_jabatan')->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/tambahDataPegawai',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambahDataAksi()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE)
        {
            $this->tambahData();
        }else {
            $nik                = $this->input->post('nik');
            $nama_pegawai       = $this->input->post('nama_pegawai');
            $jenis_kelamin      = $this->input->post('jenis_kelamin');
            $jabatan            = $this->input->post('jabatan');
            $tanggal_masuk      = $this->input->post('tanggal_masuk');
            $status             = $this->input->post('status');
            $hak_akses          = $this->input->post('hak_akses');
            $username           = $this->input->post('username');
            $password           = md5($this->input->post('password'));
            $photo              = $_FILES['photo']['name'];

            if($photo=''){}else{
                $config ['upload_path']      = './assets/photo';
                $config ['allowed_types']    = 'jpg|jpeg|png|gif';
                $this->load->library('upload',$config);

            if(!$this->upload->do_upload('photo')){
                echo "Photo gagal diupload!";
                }else{
                    $photo=$this->upload->data('file_name');
                }
            }   

        $data = array(
            'nik'           => $nik,
            'nama_pegawai'  => $nama_pegawai,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan'       => $jabatan,
            'tanggal_masuk' => $tanggal_masuk,
            'status'        => $status,
            'hak_akses'     => $hak_akses,
            'username'      => $username,
            'password'      => $password,
            'photo'         => $photo
        );

        $this->penggajianModel->insert_data($data,'tbl_pegawai');
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Ditambah!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/dataPegawai');
    }
        }

        public function updateData($id)
        {
            $where = array('id_pegawai' => $id);
            $data['title'] = "Update Data Pegawai"; 
            $data['jabatan'] = $this->penggajianModel->get_data('tbl_jabatan')->result();
            $data['pegawai'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE id_pegawai='$id'")->result();  
            $this->load->view('templates_admin/header',$data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/updateDataPegawai',$data);
            $this->load->view('templates_admin/footer');
        }

        
    public function updateDataAksi()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE)
        {
            $this->updateData();
        }else {
            $id                 = $this->input->post('id_pegawai');
            $nik                = $this->input->post('nik');
            $nama_pegawai       = $this->input->post('nama_pegawai');
            $jenis_kelamin      = $this->input->post('jenis_kelamin');
            $jabatan            = $this->input->post('jabatan');
            $tanggal_masuk      = $this->input->post('tanggal_masuk');
            $status             = $this->input->post('status');
            $hak_akses          = $this->input->post('hak_akses');
            $username           = $this->input->post('username');
            $password           = md5($this->input->post('password'));
            $photo              = $_FILES['photo']['name'];

            if($photo){
                $config ['upload_path']      = './assets/photo';
                $config ['allowed_types']    = 'jpg|jpeg|png|gif';
                $this->load->library('upload',$config);

            if($this->upload->do_upload('photo')){
                $photo=$this->upload->data('file_name');
                $this->db->set('photo',$photo);
                }else{
                    echo $this->upload->display_errors();
                }
            }   

        $data = array(
            'nik'           => $nik,
            'nama_pegawai'  => $nama_pegawai,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan'       => $jabatan,
            'tanggal_masuk' => $tanggal_masuk,
            'status'        => $status,
            'hak_akses'     => $hak_akses,
            'username'      => $username,
            'password'      => $password,
        );

        $where = array('id_pegawai' => $id);

        $this->penggajianModel->update_data('tbl_pegawai',$data,$where);
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Berhasil Diupdate!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/dataPegawai');
    }
        }

    public function _rules()
    {
        $this->form_validation->set_rules('nik','Nik','required');
        $this->form_validation->set_rules('nama_pegawai','Nama_Pegawai','required');
        $this->form_validation->set_rules('jenis_kelamin','Jenis_Kelamin','required');
        $this->form_validation->set_rules('jabatan','Jabatan','required');
        $this->form_validation->set_rules('tanggal_masuk','Tanggal_Masuk','required');
        $this->form_validation->set_rules('status','Status','required');
    }

    public function deleteData($id)
    {
        $where = array('id_pegawai' => $id);
        $this->penggajianModel->delete_data($where,'tbl_pegawai');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Pegawai Berhasil Hapus!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('admin/dataPegawai');
    }
}

?>