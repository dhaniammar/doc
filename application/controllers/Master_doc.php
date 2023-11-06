<?php

class Master_doc extends CI_Controller {

    public function index()
    {
        // $this->load->view('doc_add');
        $data_dokumen = $this->db->query("SELECT * FROM document")->result();
        $title = 'Data Dokumen';

        $data = array(
            'data_dokumen' => $data_dokumen,
            'title' => $title
                );
        
        $this->load->view('header');
        $this->load->view('template', $data);
        $this->load->view('footer');

        // include ('doc_add.php')
    }
    
    public function add(){
            $data = array(
            'title' => "Tambah Dokumen"
                );
        $this->load->view('header');
        $this->load->view('doc_form', $data);
        $this->load->view('footer');

    }
    public function add_action(){
        $nama_dokumen = $this->input->post('nama_dokumen');

        // mapping ke database
        $data_input = array(
            'nama_dokumen'  => $nama_dokumen,
            'tanggal_dibuat' => date('Y-m-d H:i:s'),
            'status' => 1,
          );

            $this->load->model('master_doc_model');
            $this->master_doc_model->insert_doc($data_input);

        redirect('master_doc');
    }

    public function delete($id){
        // query delete
        $this->db->query("DELETE FROM document WHERE id=".$id);
        // redirect
        redirect('master_doc');

    }

}

/* End of file Controllername.php */