<?php
class DataPKP extends CI_Controller
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
        $data['title'] = "Data PKP";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataPKP', $data);
        $this->load->view('templates_admin/footer');
    }
    public function masterPPH()
    {
        $data = $this->penggajianModel->get_data('data_pph')->result();
        echo json_encode($data);
    }
    public function hapusPKP()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        $data = $this->penggajianModel->checkDataPKP($this->input->post('id'));
        // if (count($data) != 0) {
        //     print json_encode(array("status" => "failed", "message" => "Gagal Hapus, Terdapat Data yang Terpakai"));
        // } else {
        $this->penggajianModel->delete_data($id, 'data_pph');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Hapus"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Hapus"));
        }
        // }
    }
    public function ubahPKP()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        $data = array(
            'persen' => $this->input->post('persen'),
            'batas_atas' => $this->input->post('batasAtas'),
            'batas_bawah' => $this->input->post('batasBawah'),
        );
        $this->penggajianModel->update_data('data_pph', $data, $id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Ubah"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Ubah"));
        }
    }
    public function tambahPKP()
    {
        $this->db->trans_start();
        $data = array(
            'persen' => $this->input->post('persen'),
            'batas_atas' => $this->input->post('batasAtas'),
            'batas_bawah' => $this->input->post('batasBawah'),
        );
        $this->penggajianModel->insert_data($data, 'data_pph');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
