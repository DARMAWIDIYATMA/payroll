<?php

class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_akses')!='3')
        {
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                    aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard Direktur";
        $pegawai = $this->db->query("SELECT * FROM data_pegawai");
        $admin = $this->db->query("SELECT * FROM data_pegawai WHERE id_akses ='1'");
        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['pegawai']=$pegawai->num_rows();
        $data['admin']=$admin->num_rows();
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/dashboard', $data);
        $this->load->view('templates_direktur/footer');
    }
}
