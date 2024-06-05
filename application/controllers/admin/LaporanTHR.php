<?php
class LaporanTHR extends CI_Controller
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
        $data['title'] = "Laporan THR";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/laporanTHR', $data);
        $this->load->view('templates_admin/footer');
    }
    public function dataKaryawan()
    {
        $tgl_thr = $this->input->post('tgl_thr');
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
        $data['masaKaryawan'] = $this->penggajianModel->listMasaKaryawan($tgl_thr);
        $data['thr'] = $this->penggajianModel->semuaTHR($tgl_thr);
        echo json_encode($data);
    }
    public function dataKalender()
    {
        $data = $this->penggajianModel->get_data('kalender_thr')->result();
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
    public function slipTHRPerPerson($tgl_thr, $nip)
    {
        $data['title'] = 'Cetak Slip THR';
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawanId($nip);
        $data['masaKaryawan'] = $this->penggajianModel->listMasaKaryawanId($tgl_thr, $nip);
        $data['thr'] = $this->penggajianModel->semuaTHRnip($tgl_thr, $nip);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/cetakSlipTHRId', $data);
    }
    public function slipTHR($tgl_thr)
    {
        $data['title'] = 'Cetak Slip THR';
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
        $data['masaKaryawan'] = $this->penggajianModel->listMasaKaryawan($tgl_thr);
        $data['thr'] = $this->penggajianModel->semuaTHR($tgl_thr);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/cetakSlipTHR', $data);
    }
}
