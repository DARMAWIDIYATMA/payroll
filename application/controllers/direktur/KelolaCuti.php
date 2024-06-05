<?php

class KelolaCuti extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_akses') != '3') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                    aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {

        $data['title'] = "Data Cuti Karyawan";
        $data['nip'] = $this->session->userdata('nip');
        $data['master_cuti'] = $this->db->query("SELECT * FROM cuti")->result();
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/kelolaCuti', $data);
        $this->load->view('templates_direktur/footer');
    }
    public function data_cuti()
    {
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
        JOIN data_jabatan e ON a.id_jabatan = e.id_jabatan
        JOIN cuti d ON a.id_cuti = d.id
        ORDER BY a.id DESC;")->result();
        echo json_encode($data);
    }
    public function approvalCuti()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        $data = array(
            'status_approval' => $this->input->post('status_approval'),
        );
        $this->penggajianModel->update_data('data_cuti', $data, $id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
