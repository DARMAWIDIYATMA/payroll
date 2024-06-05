<?php

class KelolaIjin extends CI_Controller
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

        $data['title'] = "Data Ijin";
        $data['nip'] = $this->session->userdata('nip');
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dataIjin', $data);
        $this->load->view('templates_pegawai/footer');
    }
    public function data_ijin()
    {
        $nip = $this->session->userdata('nip');
        $data = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        b.nama_pegawai,
        a.jumlah_hari,
        a.status,
        a.jenis_sia,
        a.tanggal_pengajuan,
        a.tanggal_awal,
        a.tanggal_akhir,
        e.nama_jabatan
    FROM riwayat_sia a
    JOIN data_pegawai b ON a.nip_pk = b.nip 
    JOIN data_jabatan e ON a.id_jabatan_pk = e.id_jabatan
    WHERE a.nip_pk = '$nip'
    ORDER BY a.id DESC;")->result();
        echo json_encode($data);
    }
    public function insertIjin()
    {
        $this->db->trans_start();
        $id_jabatan = $this->session->userdata('id_jabatan');
        $data = array(
            'nip_pk' => $this->input->post('nip'),
            'jenis_sia' => $this->input->post('jenis_sia'),
            'jumlah_hari' => $this->input->post('jumlah_hari'),
            'status' => $this->input->post('status'),
            'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan'),
            'tanggal_awal' => $this->input->post('tanggal_awal'),
            'tanggal_akhir' => $this->input->post('tanggal_akhir'),
            'keterangan' => $this->input->post('keterangan'),
            'bulan' => $this->input->post('bulan'),
            'id_jabatan_pk' => $id_jabatan,
        );
        $this->penggajianModel->insert_data($data, 'riwayat_sia');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
