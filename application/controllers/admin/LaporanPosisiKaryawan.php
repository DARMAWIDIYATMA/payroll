<?php
class LaporanPosisiKaryawan extends CI_Controller
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
        $data['title'] = "Laporan Posisi Karyawan";
        $data['karyawan'] = $this->penggajianModel->get_data('data_pegawai')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/laporanPosisiKaryawan', $data);
        $this->load->view('templates_admin/footer');
    }
    public function dataPromosi()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $nip = $this->input->post('nip');
        $data = $this->penggajianModel->getDataPromosiDate($tanggal_awal, $tanggal_akhir, $nip);
        echo json_encode($data);
    }
    public function dataMutasi()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $nip = $this->input->post('nip');
        $data  = $this->penggajianModel->getDataMutasiDate($tanggal_awal, $tanggal_akhir, $nip);
        echo json_encode($data);
    }
    public function dataPHK()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $nip = $this->input->post('nip');
        $data  = $this->penggajianModel->getDataPHKDate($tanggal_awal, $tanggal_akhir, $nip);
        echo json_encode($data);
    }
    public function cetakLaporan($kategori, $tanggal_awal, $tanggal_akhir, $nip)
    {
        $data['title'] = 'Cetak Laporan Posisi';
        if ($kategori == 'PROMOSI') {
            $data['laporan'] = $this->penggajianModel->getDataPromosiDate($tanggal_awal, $tanggal_akhir, $nip);
        } else if ($kategori == 'MUTASI') {
            $data['laporan'] = $this->penggajianModel->getDataMutasiDate($tanggal_awal, $tanggal_akhir, $nip);
        } else {
            $data['laporan'] = $this->penggajianModel->getDataPHKDate($tanggal_awal, $tanggal_akhir, $nip);
        }
        $data['kategori'] = $kategori;
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['nip'] = $nip;
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/cetakLaporanPosisi', $data);
    }
}
