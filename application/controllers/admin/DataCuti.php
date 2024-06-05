<?php
class DataCuti extends CI_Controller
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
        $data['title'] = "Data Cuti";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataCuti', $data);
        $this->load->view('templates_admin/footer');
    }
    public function masterCuti()
    {
        $data = $this->penggajianModel->get_data('cuti')->result();
        echo json_encode($data);
    }
    public function masterRelation()
    {
        $id = $this->input->get('id');
        $data = $this->penggajianModel->getDataRelation($id);
        echo json_encode($data);
    }
    public function hapusCuti()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        $data = $this->penggajianModel->checkData($this->input->post('id'));
        if (count($data) != 0) {
            print json_encode(array("status" => "failed", "message" => "Gagal Hapus, Terdapat Data yang Terpakai"));
        } else {
            $this->penggajianModel->delete_data($id, 'cuti');
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                print json_encode(array("status" => "success", "message" => "Berhasil Hapus"));
            } else {
                print json_encode(array("status" => "failed", "message" => "Gagal Hapus"));
            }
        }
    }
    public function ubahCuti()
    {
        $this->db->trans_start();
        $id = array('id' => $this->input->post('id'));
        $data = array(
            'nama_cuti' => $this->input->post('nama'),
            'batas_hari' => $this->input->post('batas_hari'),
        );
        $this->penggajianModel->update_data('cuti', $data, $id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Ubah"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Ubah"));
        }
    }
    public function tambahCuti()
    {
        $this->db->trans_start();
        $data = array(
            'nama_cuti' => $this->input->post('nama'),
            'batas_hari' => $this->input->post('batas_hari'),
        );
        $this->penggajianModel->insert_data($data, 'cuti');
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
