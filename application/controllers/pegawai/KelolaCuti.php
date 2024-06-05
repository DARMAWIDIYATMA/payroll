<?php

class KelolaCuti extends CI_Controller
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

        $data['title'] = "Data Cuti";
        $data['nip'] = $this->session->userdata('nip');
        $data['master_cuti'] = $this->db->query("SELECT * FROM cuti")->result();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dataCuti', $data);
        $this->load->view('templates_pegawai/footer');
    }
    public function data_cuti()
    {
        $nip = $this->session->userdata('nip');
        $data = $this->db->query("SELECT 
            a.id,
            a.nip,
            b.nama_pegawai,
            d.nama_cuti,
            a.jumlah_hari,
            a.status_approval,
            c.nama_pegawai as nama_atasan,
            a.tanggal_pengajuan,
            a.tgl_mulai_cuti,
            a.tgl_akhir_cuti,
            e.nama_jabatan
        FROM data_cuti a
        JOIN data_pegawai b ON a.nip = b.nip 
        JOIN data_pegawai c ON a.nip_atasan = c.nip
        JOIN cuti d ON a.id_cuti = d.id
        JOIN data_jabatan e ON a.id_jabatan = e.id_jabatan
        WHERE a.nip = '$nip'
        ORDER BY a.id DESC")->result();
        echo json_encode($data);
    }
    public function insertCuti()
    {
        $this->db->trans_start();
        $id_jabatan = $this->session->userdata('id_jabatan');
        $data = array(
            'nip' => $this->input->post('nip'),
            'id_cuti' => $this->input->post('id_cuti'),
            'jumlah_hari' => $this->input->post('jumlah_hari'),
            'status_approval' => $this->input->post('status_approval'),
            'nip_atasan' => $this->input->post('nip_atasan'),
            'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan'),
            'tgl_mulai_cuti' => $this->input->post('tgl_mulai_cuti'),
            'tgl_akhir_cuti' => $this->input->post('tgl_akhir_cuti'),
            'id_jabatan' => $id_jabatan,
        );
        $this->penggajianModel->insert_data($data, 'data_cuti');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
    public function batas_cuti()
    {
        $nip = $this->input->post('nip');
        $id_cuti = $this->input->post('id_cuti');
        $year = $this->input->post('year');
        $data = $this->db->query("SELECT SUM(a.jumlah_hari) as jumlah_cuti, a.nip, YEAR(a.tanggal_pengajuan), a.id_cuti, b.nama_cuti,b.batas_hari FROM data_cuti a JOIN cuti b ON a.id_cuti = b.id WHERE a.nip = $nip AND a.id_cuti = $id_cuti AND YEAR(a.tanggal_pengajuan) = $year  AND (a.status_approval = 'PENDING' OR a.status_approval = 'SUCCESS') GROUP BY YEAR(a.tanggal_pengajuan), a.id_cuti, a.nip;")->result();
        // print_r($data);
        if (count($data) == 0) {
            $data = $this->db->query("SELECT *,0 as jumlah_cuti FROM cuti WHERE id = $id_cuti;")->result();
        }
        echo json_encode($data);
    }
}
