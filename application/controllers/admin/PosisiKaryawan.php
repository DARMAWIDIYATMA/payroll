<?php
class PosisiKaryawan extends CI_Controller
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
        $data['title'] = "Posisi Karyawan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/posisiKaryawan', $data);
        $this->load->view('templates_admin/footer');
    }
    public function dataKaryawan()
    {
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
        $data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result();
        $data['lokasi_kerja'] = $this->penggajianModel->get_data('lokasi_kerja')->result();
        echo json_encode($data);
    }
    public function dataPosisi()
    {
        $data['promosi'] = $this->penggajianModel->getDataPromosi();
        $data['mutasi'] = $this->penggajianModel->getDataMutasi();
        $data['PHK'] = $this->penggajianModel->getDataPHK();
        echo json_encode($data);
    }
    public function tambahPosisiKaryawan()
    {
        $this->db->trans_start();
        $pengajuan = $this->input->post('pengajuan');
        if ($pengajuan == 'PROMOSI' || $pengajuan == 'DEMOSI') {
            $data = array(
                'nip_pk' => $this->input->post('nip'),
                'id_jabatan_new_pk' => $this->input->post('jabatan_baru'),
                'id_jabatan_recent_pk' => $this->input->post('jabatan_lama'),
                'alasan_promosi' => $this->input->post('alasan'),
                'tanggal' => $this->input->post('tanggal'),
                'bulan' => $this->input->post('bulan'),
                'status' => 'PENDING',
                'keterangan' => $pengajuan,
            );
            $this->penggajianModel->insert_data($data, 'riwayat_promosi');
        } else if ($pengajuan == 'MUTASI') {
            $data = array(
                'nip_pk' => $this->input->post('nip'),
                'id_jabatan_new_pk' => $this->input->post('jabatan_baru'),
                'id_jabatan_recent_pk' => $this->input->post('jabatan_lama'),
                'id_lokasi_kerja_new_pk' => $this->input->post('lokasi_baru'),
                'id_lokasi_kerja_recent_pk' => $this->input->post('lokasi_lama'),
                'alasan_mutasi' => $this->input->post('alasan'),
                'tanggal' => $this->input->post('tanggal'),
                'bulan' => $this->input->post('bulan'),
                'status' => 'PENDING',
            );
            $this->penggajianModel->insert_data($data, 'riwayat_mutasi');
        } else {
            $data = array(
                'nip_pk' => $this->input->post('nip'),
                'alasan_phk' => $this->input->post('alasan'),
                'tanggal' => $this->input->post('tanggal'),
                'bulan' => $this->input->post('bulan'),
                'status' => 'PENDING',
            );
            $this->penggajianModel->insert_data($data, 'riwayat_phk');
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
