<?php
class dataTHR extends CI_Controller
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
        $data['title'] = "Data THR";
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dataTHR', $data);
        $this->load->view('templates_pegawai/footer');
    }
    public function dataKaryawan()
    {
        $nip = $this->session->userdata('nip');
        $tgl_thr = $this->session->userdata('tgl_thr');
        $data['thr'] = $this->penggajianModel->semuaTHRnip($tgl_thr, $nip);
        echo json_encode($data);
    }
    public function dataKalender()
    {
        $nip = $this->session->userdata('nip');
        $data['kalender'] = $this->penggajianModel->get_data('kalender_thr')->result();
        $data['seleksi'] = $this->penggajianModel->getTableId('riwayat_thr', 'nip_pk', $nip);
        echo json_encode($data);
    }

    public function slipTHRPerPerson($tgl_thr)
    {
        $data['title'] = 'Cetak Slip THR';
        $nip = $this->session->userdata('nip');
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawanId($nip);
        $data['masaKaryawan'] = $this->penggajianModel->listMasaKaryawanId($tgl_thr, $nip);
        $data['thr'] = $this->penggajianModel->semuaTHRnip($tgl_thr, $nip);
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('pegawai/cetakSlipTHRId', $data);
    }
}
