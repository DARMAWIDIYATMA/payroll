<?php

    class LaporanPresensi extends CI_Controller{

        public function __construct(){
            parent::__construct();
    
            if($this->session->userdata('id_akses')!='3')
            {
                $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Anda belum Login!</strong> <button type="button" class="close" data-dismiss="alert" 
                        aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('welcome');
            }
        }
        
        public function index()
        {
            $data['title'] = "Laporan Presensi";
            if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun'])&& $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;
            }
            $data['presensi'] = $this->db->query("SELECT * FROM data_kehadiran
            WHERE bulan='$bulantahun'
            ORDER BY nip ASC")->result();
            $this->load->view('templates_direktur/header', $data);
            $this->load->view('templates_direktur/sidebar');
            $this->load->view('direktur/filterLaporanPresensi');
            $this->load->view('templates_direktur/footer');
            
        }

        public function cetakLaporanPresensi()
        {
            $data['title'] = "Cetak Laporan Presensi Pegawai";
            if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun'])&& $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;
            }
            $bulantahun=$bulan.$tahun;
            $data['lap_kehadiran'] = $this->db->query("SELECT * FROM data_kehadiran
            WHERE bulan='$bulantahun'
            ORDER BY nip ASC")->result();
            $this->load->view('templates_direktur/header', $data);
            $this->load->view('direktur/cetakLaporanPresensi');
        }
    }