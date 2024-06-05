<?php

class LaporanGaji extends CI_Controller
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
        $data['title'] = "Laporan Gaji Pegawai";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['gaji'] = $this->db->query("SELECT data_pegawai.nip, 
            data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin,
            data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, 
            data_jabatan.transport, data_jabatan.uang_makan,
            data_kehadiran.alpha FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
            INNER JOIN data_jabatan ON data_jabatan.id_jabatan=data_kehadiran.id_jabatan
            WHERE data_kehadiran.bulan='$bulantahun'
            ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $data['potongan_cuti'] = $this->penggajianModel->potonganCutiBulanTahun($bulantahun);
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/filterLaporanGaji');
        $this->load->view('templates_direktur/footer');
    }

    public function cetakLaporanGaji()
    {
        $data['title'] = "Cetak Laporan Gaji Pegawai";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['pph21'] = $this->penggajianModel->get_data('data_pph')->result();
        $data['cetakGaji'] = $this->db->query("SELECT data_pegawai.nip, 
                data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin,
                data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, 
                data_jabatan.transport, data_jabatan.uang_makan,
                data_kehadiran.alpha FROM data_pegawai
                INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
                INNER JOIN data_jabatan ON data_jabatan.id_jabatan=data_kehadiran.id_jabatan
                WHERE data_kehadiran.bulan='$bulantahun'
                ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $data['potongan_cuti'] = $this->penggajianModel->potonganCutiBulanTahun($bulantahun);
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('direktur/cetakDataGaji', $data);
    }
}
