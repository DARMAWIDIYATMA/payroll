<?php

class Dashboard extends CI_Controller{

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
        $data['title'] = "Dashboard Admin";
        $pegawaii = $this->db->query("SELECT * FROM data_pegawai");
        $admin = $this->db->query("SELECT * FROM data_pegawai WHERE id_jabatan ='1'");
        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['pegawai'] = $this->db->query(" SELECT dp. * , dj.nama_jabatan
        FROM data_pegawai dp
      
        LEFT JOIN data_jabatan dj ON dp.id_jabatan = dj.id_jabatan
        ORDER BY dp.nip ASC ")->result();
        $data['pegawaii']=$pegawaii->num_rows();
        $data['admin']=$admin->num_rows();
        $data['jabatan']=$jabatan->num_rows();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates_admin/footer');
    }
    
}
?>