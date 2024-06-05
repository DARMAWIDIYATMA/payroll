<?php
class DataKalenderTHR extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('id_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                        aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }
    public function index()
    {
        $data['title'] = "Data Kalender THR";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataKalenderTHR', $data);
        $this->load->view('templates_admin/footer');
    }
    public function masterKalender()
    {
        $data = $this->penggajianModel->get_data('kalender_thr')->result();
        echo json_encode($data);
    }
    public function checkAvailableKalenderTHR()
    {
        $data = $this->penggajianModel->checkAvailableKalenderTHR($this->input->post('date'));
        echo json_encode($data);
    }
    public function hapusKalenderTHR()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        // if (count($data) != 0) {
        //     print json_encode(array("status" => "failed", "message" => "Gagal Hapus, Terdapat Data yang Terpakai"));
        // } else {
        $this->penggajianModel->delete_data($id, 'kalender_thr');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Hapus"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Hapus"));
        }
        // }
    }
    public function ubahKalenderTHR()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        $data = array(
            'tanggal_thr' => $this->input->post('tanggal_thr'),
            'bulan_thr' => $this->input->post('bulan_thr'),
        );
        $this->penggajianModel->update_data('kalender_thr', $data, $id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Ubah"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Ubah"));
        }
    }
    public function tambahKalenderTHR()
    {
        $this->db->trans_start();
        $data = array(
            'tanggal_thr' => $this->input->post('tanggal_thr'),
            'bulan_thr' => $this->input->post('bulan_thr'),
        );
        $this->penggajianModel->insert_data($data, 'kalender_thr');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
