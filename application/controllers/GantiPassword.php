<?php

class GantiPassword extends CI_Controller {

    public function index() {
        $data['title'] = "Ubah Password";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('formGantiPassword', $data);
        $this->load->view('templates_admin/footer');
    }

    public function gantiPasswordAksi() {
        $passBaru   = $this->input->post('passBaru');
        $ulangPass  = $this->input->post('ulangPass');

        $this->form_validation->set_rules('passBaru', 'password baru', 'required|matches[ulangPass]', 
            array('matches' => 'Password yang anda masukan tidak sama silahkan ulangi'));
        $this->form_validation->set_rules('ulangPass', 'ulangi password', 'required');

        if ($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($passBaru));
            $id = array('nip' => $this->session->userdata('nip'));

            $this->penggajianModel->update_data('data_pegawai', $data, $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password berhasil diubah!</strong> <button type="button" class="close" data-dismiss="alert" 
            aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        } else {
            $data['title'] = "Ubah Password";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('formGantiPassword', $data);
            $this->load->view('templates_admin/footer');
        }
    }

}

?>
