<?php
class PosisiKaryawan extends CI_Controller
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
        $data['title'] = "Posisi Karyawan";
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/posisiKaryawan', $data);
        $this->load->view('templates_direktur/footer');
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
    public function approvalPosisi()
    {
        $this->db->trans_start();
        $id = $this->input->post('id');
        $status_approval = $this->input->post('status_approval');
        $jenis = $this->input->post('jenis');
        if ($jenis == 0) {
            // promosi demosi
            $nama_tabel = 'riwayat_promosi';
            if ($status_approval == 'SUCCESS') {
                $data = $this->penggajianModel->getTableId($nama_tabel, 'id', $id);
                $nip =  $data[0]->nip_pk;
                $jabatan_new =  $data[0]->id_jabatan_new_pk;
                $id2 = array('nip' => $nip);
                $data2 = array(
                    'id_jabatan' => $jabatan_new,
                );
                $this->penggajianModel->update_data('data_pegawai', $data2, $id2);
            }
        } else if ($jenis == 1) {
            // mutasi
            $nama_tabel = 'riwayat_mutasi';
            if ($status_approval == 'SUCCESS') {
                $data = $this->penggajianModel->getTableId($nama_tabel, 'id', $id);
                $nip =  $data[0]->nip_pk;
                $jabatan_new =  $data[0]->id_jabatan_new_pk;
                $lokasi_kerja_new =  $data[0]->id_lokasi_kerja_new_pk;
                $id2 = array('nip' => $nip);
                $data2 = array(
                    'id_jabatan' => $jabatan_new,
                    'id_lokasi_kerja_pk' => $lokasi_kerja_new,
                );
                $this->penggajianModel->update_data('data_pegawai', $data2, $id2);
            }
        } else {
            // phk
            $nama_tabel = 'riwayat_phk';
            if ($status_approval == 'SUCCESS') {
                $data = $this->penggajianModel->getTableId($nama_tabel, 'id', $id);
                $nip =  $data[0]->nip_pk;
                $id2 = array('nip' => $nip);
                $data2 = array(
                    'status_keaktifan' => 'Non Aktif',
                );
                $this->penggajianModel->update_data('data_pegawai', $data2, $id2);
            }
        }
        $id = array('id' => $id);
        $data = array(
            'status' => $status_approval,
        );
        $this->penggajianModel->update_data($nama_tabel, $data, $id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            print json_encode(array("status" => "success", "message" => "Berhasil Input"));
        } else {
            print json_encode(array("status" => "failed", "message" => "Gagal Input"));
        }
    }
}
