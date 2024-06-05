<?php
class DataTHR extends CI_Controller
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
        $data['title'] = "Data THR";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataTHR', $data);
        $this->load->view('templates_admin/footer');
    }
    public function dataKaryawan()
    {
        $tgl_thr = $this->input->post('tgl_thr');
        $id = $this->input->post('id');
        $seleksi = $this->penggajianModel->getTableId('riwayat_thr', 'id_kalender_thr_pk', $id);
        if (count($seleksi) == 0) {
            $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
            $data['masaKaryawan'] = $this->penggajianModel->listMasaKaryawan($tgl_thr);
        } else {
            $data['karyawan'] = [];
            $data['masaKaryawan'] = [];
        }
        echo json_encode($data);
    }
    public function dataKalender()
    {
        $data = $this->penggajianModel->listKalenderTHR();
        echo json_encode($data);
    }
    public function simpan()
    {
        $this->db->trans_start();
        $tanggal = $this->input->post('tanggal_thr');
        $detail = $this->input->post('detail');
        foreach ($detail as $key => $value) {
            $data = array(
                'id_kalender_thr_pk' => $tanggal,
                'nip_pk' => $value['nip'],
                'nominal' => $value['nominal'],
            );
            $this->penggajianModel->insert_data($data, 'riwayat_thr');
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
