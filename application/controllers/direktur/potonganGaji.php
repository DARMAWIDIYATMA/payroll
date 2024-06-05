<?php

class PotonganGaji extends CI_Controller
{
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
        $data['title'] = "Setting Potongan Gaji";
        $data['pot_gaji'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/potonganGaji', $data);
        $this->load->view('templates_direktur/footer');
    }

    public function tambahData()
    {
        $data['title'] = "Tambah Potongan Gaji";
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/formPotonganGaji', $data);
        $this->load->view('templates_direktur/footer');
    }

    public function tambahDataAksi()
    {
        $this->_rules();

        if($this->form_validation->run() == FALSE){
            $this->tambahData();
        }else{
            $potongan       =$this->input->post('potongan');
            $jml_potongan   =$this->input->post('jml_potongan');

            $data=array(
                'potongan'      =>$potongan,
                'jml_potongan'  =>$jml_potongan
            );
            $this->penggajianModel->insert_data($data,'potongan_gaji');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong> <button type="button" class="close" data-dismiss="alert" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/potonganGaji');
        }
    }

    public function updateData($id)
    {
        $where = array('id_pot' => $id);
        $data['title'] = "Update Potongan Gaji";
        $data['pot_gaji'] = $this->db->query("SELECT * FROM potongan_gaji WHERE id_pot='$id'")->result();
        $this->load->view('templates_direktur/header', $data);
        $this->load->view('templates_direktur/sidebar');
        $this->load->view('direktur/updatePotonganGaji', $data);
        $this->load->view('templates_direktur/footer');
    }

    public function updateDataAksi()
    {
        $this->_rules();

        if($this->form_validation->run()==FALSE){
            $this->updateData();
        }else{
            $id_pot         = $this->input->post('id_pot');
            $potongan       = $this->input->post('potongan');
            $jml_potongan   = $this->input->post('jml_potongan');
            

            $data = array(

                'id_pot'        => $id_pot,
                'potongan'      => $potongan,
                'jml_potongan'  => $jml_potongan,
            );

            $where = array(
                'id_pot' => $id_pot
            );

            $this->penggajianModel->update_data('potongan_gaji', $data, $where);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate!</strong> <button type="button" class="close" data-dismiss="alert" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/potonganGaji');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('potongan','jenis potongan','required');
        $this->form_validation->set_rules('jml_potongan','jumlah potongan','required');
    }

    public function deleteData($id)
    {
        $where = array('id_pot' => $id);
        $this->penggajianModel->delete_data($where, 'potongan_gaji');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong> <button type="button" class="close" data-dismiss="alert" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/potonganGaji');
    }
}


?>