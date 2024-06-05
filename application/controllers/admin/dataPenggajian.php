<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataPenggajian extends CI_Controller
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
        $data['title'] = "Data Gaji Pegawai";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $data['pph21'] = $this->penggajianModel->get_data('data_pph')->result();
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
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataGaji', $data);
        $this->load->view('templates_admin/footer');
    }

    public function cetakGaji()
    {
        $data['title'] = "Cetak Data Gaji Pegawai";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['karyawan'] = $this->penggajianModel->listActiveKaryawan();
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
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/cetakDataGaji', $data);
    }
    
public function exportToExcel()
{
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;
    }

    // Definisikan nilai $alpha. Contoh:
    $alpha = 50000; // Nilai potongan per ketidakhadiran. Sesuaikan dengan kebutuhan Anda.

    // Modifikasi query untuk hanya mengambil karyawan yang statusnya 'aktif'
    $gaji = $this->db->query("SELECT data_pegawai.nip, 
            data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin,
            data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, 
            data_jabatan.transport, data_jabatan.uang_makan,
            data_kehadiran.alpha FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
            INNER JOIN data_jabatan ON data_jabatan.id_jabatan=data_kehadiran.id_jabatan
            WHERE data_kehadiran.bulan='$bulantahun' AND data_pegawai.status_keaktifan='aktif'
            ORDER BY data_pegawai.nama_pegawai ASC")->result();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'NIP');
    $sheet->setCellValue('C1', 'Nama Pegawai');
    $sheet->setCellValue('D1', 'Jenis Kelamin');
    $sheet->setCellValue('E1', 'Jabatan');
    $sheet->setCellValue('F1', 'Gaji Pokok');
    $sheet->setCellValue('G1', 'Tj. Transport');
    $sheet->setCellValue('H1', 'Uang Makan');
    $sheet->setCellValue('I1', 'Potongan');
    $sheet->setCellValue('J1', 'Total Gaji');

    $row = 2;
    $no = 1;
    foreach ($gaji as $g) {
        // Menghitung potongan
        $potongan = $g->alpha * $alpha + (($g->gaji_pokok + $g->transport + $g->uang_makan) * 0.03);
        $total_gaji = $g->gaji_pokok + $g->transport + $g->uang_makan - $potongan;

        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $g->nip);
        $sheet->setCellValue('C' . $row, $g->nama_pegawai);
        $sheet->setCellValue('D' . $row, $g->jenis_kelamin);
        $sheet->setCellValue('E' . $row, $g->nama_jabatan);
        $sheet->setCellValue('F' . $row, $g->gaji_pokok);
        $sheet->setCellValue('G' . $row, $g->transport);
        $sheet->setCellValue('H' . $row, $g->uang_makan);
        $sheet->setCellValue('I' . $row, $potongan);
        $sheet->setCellValue('J' . $row, $total_gaji);

        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'Data-Gaji-Pegawai-' . $bulantahun . '.xlsx';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

}    

