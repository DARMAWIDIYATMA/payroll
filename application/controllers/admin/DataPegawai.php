<?php
    class dataPegawai extends CI_Controller{

        public function __construct(){
            parent::__construct();
    
            if($this->session->userdata('id_akses')!='1')
            {
                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                        aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('welcome');
            }
        }
        
        
        public function index()
        {
            $data['title'] = "Data Pegawai";
            $data['pegawai'] = $this->db->query(" SELECT dp. * , dj.nama_jabatan
            FROM data_pegawai dp
            LEFT JOIN data_jabatan dj ON dp.id_jabatan = dj.id_jabatan
            ORDER BY dp.nip ASC ")->result();
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/dataPegawai', $data);
            $this->load->view('templates_admin/footer');
        }

        public function tambahData()
        {
            $data['id']= $this->penggajianModel->auto_code('nip','data_pegawai');
            $data['title'] = "Tambah Data Pegawai";
            $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/formTambahPegawai', $data);
            $this->load->view('templates_admin/footer');
        }

        public function tambahDataAksi()
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE) {
                $this->tambahData();
            }else{
                $nip                    = $this->input->post('nip');
                $nik                    = $this->input->post('nik');
                $nama_pegawai           = $this->input->post('nama_pegawai');
                $jenis_kelamin          = $this->input->post('jenis_kelamin');
                $alamat                 = $this->input->post('alamat');
                $no_telp                = $this->input->post('no_telp');
                $email                  = $this->input->post('email');
                $id_jabatan             = $this->input->post('id_jabatan');
                $tgl_masuk              = $this->input->post('tgl_masuk');
                $status                 = $this->input->post('status');
                $id_akses               = $this->input->post('id_akses');
                $status_keaktifan       = $this->input->post('status_keaktifan');
                $username               = $this->input->post('username');
                $password               = md5($this->input->post('password'));
                $photo                  = $_FILES['photo']['name'];
                if($photo=''){}else{
                    $config ['upload_path']     = './assets/photo';
                    $config ['allowed_types']   = 'jpg|jpeg|png|tiff';
                    $this->load->library('upload', $config);
                    if(!$this->upload->do_upload('photo')){
                        echo "Photo Gagal diupload!";
                    }else{
                        $photo=$this->upload->data('file_name');
                    }
                }

                $data = array(
                    'nip'               => $nip,
                    'nik'               => $nik,
                    'nama_pegawai'      => $nama_pegawai,
                    'jenis_kelamin'     => $jenis_kelamin,
                    'alamat'            => $alamat,
                    'no_telp'           => $no_telp,
                    'email'             => $email,
                    'id_jabatan'        => $id_jabatan,
                    'tgl_masuk'         => $tgl_masuk,
                    'status'            => $status,
                    'id_akses'          => $id_akses,
                    'status_keaktifan'  => $status_keaktifan,
                    'username'          => $username,
                    'password'          => $password,
                    'photo'             => $photo,
                );

                $this->penggajianModel->insert_data($data,'data_pegawai');
                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong> <button type="button" class="close" data-dismiss="alert" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/dataPegawai');
            }
        }

        public function updateData($id)
        {
            $where = array('nip' => $id);
            $data['title'] = 'Update Data Pegawai';
                    $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
                    $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE nip='$id'")->result();
                    $this->load->view('templates_admin/header', $data);
                    $this->load->view('templates_admin/sidebar');
                    $this->load->view('admin/formUpdatePegawai', $data);
                    $this->load->view('templates_admin/footer');
        }

        public function updateDataAksi()
        {
            $this->_rulesupdate();

            if($this->form_validation->run()==FALSE) {
                $id                     = $this->input->post('nip');
                $this->updateData($id);
            }else{
                $id                     = $this->input->post('nip');
                $nik                    = $this->input->post('nik');
                $nama_pegawai           = $this->input->post('nama_pegawai');
                $alamat                 = $this->input->post('alamat');
                $no_telp                = $this->input->post('no_telp');
                $email                  = $this->input->post('email');
                $jenis_kelamin          = $this->input->post('jenis_kelamin');
                $id_jabatan             = $this->input->post('id_jabatan');
                $tgl_masuk              = $this->input->post('tgl_masuk');
                $status                 = $this->input->post('status');
                $status_keaktifan       = $this->input->post('status_keaktifan');
                $id_akses               = $this->input->post('id_akses');
                $photo                  = $_FILES['photo']['name'];
                if($photo){
                    $config ['upload_path']     = './assets/photo';
                    $config ['allowed_types']   = 'jpg|jpeg|png|tiff';
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('photo')){
                        $photo=$this->upload->data('file_name');
                        $this->db->set('photo', $photo);
                    }else{
                        echo $this->upload->display_errors();
                    }
                }

                $data = array(
                    'nik'               => $nik,
                    'nama_pegawai'      => $nama_pegawai,
                    'alamat'            => $alamat,
                    'no_telp'           => $no_telp,
                    'email'             => $email,
                    'jenis_kelamin'     => $jenis_kelamin,
                    'id_jabatan'        => $id_jabatan,
                    'tgl_masuk'         => $tgl_masuk,
                    'status'            => $status,
                    'status_keaktifan'  => $status_keaktifan,
                    'id_akses'          => $id_akses,
                );

                $where = array(
                    'nip' => $id
                );

                $this->penggajianModel->update_data('data_pegawai', $data, $where);
                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diupdate!</strong> <button type="button" class="close" data-dismiss="alert" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/dataPegawai');
            }
        }

        public function _rules()
        {
            $this->form_validation->set_rules('nip','NIP','required');
            $this->form_validation->set_rules('nik','NIK','required');
            $this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('no_telp','No Telepon','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
            $this->form_validation->set_rules('id_jabatan','Jabatan','required');
            $this->form_validation->set_rules('id_akses','Id Akses','required');
            $this->form_validation->set_rules('status','Status','required');
            $this->form_validation->set_rules('tgl_masuk','Tanggal Masuk','required');
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('status_keaktifan','Status Keaktifan','required');
        }

        public function _rulesupdate()
        {
            $this->form_validation->set_rules('nip','NIP','required');
            $this->form_validation->set_rules('nik','NIK','required');
            $this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('no_telp','No Telepon','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
            $this->form_validation->set_rules('id_jabatan','Jabatan','required');
            $this->form_validation->set_rules('id_akses','Id Akses','required');
            $this->form_validation->set_rules('status','Status','required');
            $this->form_validation->set_rules('tgl_masuk','Tanggal Masuk','required');
            $this->form_validation->set_rules('status_keaktifan','Status Keaktifan','required');
        }

        public function deleteData($id)
        {
            $where = array('nip' => $id);
            $this->penggajianModel->delete_data($where, 'data_pegawai');
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong> <button type="button" class="close" data-dismiss="alert" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/dataPegawai');
        }
    }
