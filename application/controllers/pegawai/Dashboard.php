<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_akses') != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                    aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard Pegawai";
        $id = $this->session->userdata('nip');
        $data['pegawai'] = $this->db->query("SELECT dp. * , dj.nama_jabatan
        FROM data_pegawai dp
        LEFT JOIN data_jabatan dj ON dp.id_jabatan = dj.id_jabatan WHERE nip='$id'")->result();
        $data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan='$id'")->result();
        $data['historyJabatan'] = $this->penggajianModel->listDataHistoryJabatan($id);
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dashboard', $data);
        $this->load->view('templates_pegawai/footer');
    }
}
