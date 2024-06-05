<?php

class KelolaIjin extends CI_Controller
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

        $data['title'] = "Data Ijin Karyawan";
        $data['nip'] = $this->session->userdata('nip');
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/dataIjin', $data);
        $this->load->view('templates_direktur/footer');
    }
    public function data_ijin()
    {
        $nip = $this->session->userdata('nip');
        $data = $this->db->query("SELECT 
        a.id,
        a.nip_pk,
        b.nama_pegawai,
        a.jumlah_hari,
        a.status,
        a.jenis_sia,
        a.tanggal_pengajuan,
        a.tanggal_awal,
        a.tanggal_akhir,
        e.nama_jabatan,
        a.bulan,
        a.keterangan
    FROM riwayat_sia a
    JOIN data_pegawai b ON a.nip_pk = b.nip 
    JOIN data_jabatan e ON a.id_jabatan_pk = e.id_jabatan
    ORDER BY a.id DESC;")->result();
        echo json_encode($data);
    }
    public function approvalIjin()
    {
        $this->db->trans_start();
        $bulan = $this->input->post('bulan');
        $nip = $this->input->post('nip');
        $sia = $this->input->post('sia');
        $jumlah_hari = $this->input->post('jumlah_hari');
        if ($this->input->post('status') == 'SUCCESS') {
            $dataKehadiran = $this->penggajianModel->getDataKehadiran($bulan, $nip);
            $hadir =  $dataKehadiran[0]->hadir;
            $izin =  $dataKehadiran[0]->izin;
            $sakit =  $dataKehadiran[0]->sakit;
            $id_kehadiran =  $dataKehadiran[0]->id_kehadiran;
            if ($sia == 'SAKIT') {
                $sakit = $sakit + $jumlah_hari;
            } else {
                $izin = $izin + $jumlah_hari;
            }
            $hadir = $hadir - $jumlah_hari;
            $id2 = array('id_kehadiran' => $id_kehadiran);
            $data2 = array(
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
            );
            $this->penggajianModel->update_data('data_kehadiran', $data2, $id2);
        }
        $id = array('id' => $this->input->post('id'));
        $data = array(
            'status' => $this->input->post('status'),
        );
        $this->penggajianModel->update_data('riwayat_sia', $data, $id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
