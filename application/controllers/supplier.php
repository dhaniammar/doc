<?php

class Supplier extends CI_Controller {

    public function __construct(){

        parent::__construct();
        if ($this->session->userdata('login') != 1){
            redirect('login');
        }
        $this->load->model('supplier_model');
    }

    public function index() {
        // Load data from the database
        $supplier = $this->db->get('supplier')->result();
        $data = array(
            'title' => 'List supplier',
            'supplier' => $supplier
        );
    
        $this->load->view('header');
        $this->load->view('supplier/list', $data);
        $this->load->view('footer');
    }

    public function add_actions() {
        // Get form input data
        $nama_supplier = $this->input->post('nama_supplier');
        $alamat_supplier = $this->input->post('alamat_supplier');
        $telp_supplier = $this->input->post('telp_supplier');
        
        // Perform database insertion
        $data_input = array(
            'nama_supplier' => $nama_supplier,
            'alamat_supplier' => $alamat_supplier,
            'telp_supplier' => $telp_supplier
            
        );
    
        // Insert data into the database
        $this->load->model('supplier_model');
        $this->supplier_model->insert_doc($data_input);

        // $this->db->insert('supplier',$data);

        $result = array(
            'status' => true,
            'message' => ''
        );

        echo json_encode($result);
    

    }

    public function delete(){
        // // query delete
        // $this->db->query("DELETE FROM supplier WHERE id=".$id);
        // // redirect
        // redirect('supplier');

        $id = $this->input->post('id');
        $this->supplier_model->delete_supplier($id);

        $hasil = array(
            'status' => true,
            'message' => ''

        );
        echo json_encode($hasil);

    }

    public function edit_supplier(){

        $id = $this->input->post('id');
        $where = array(
            'id'=>$id
        );
        $data = $this->db->get_where('supplier', $where)->row();

        $result = array(
            'status' => true,
            'data' => $data
        );
        echo json_encode($result);
    }

    public function update() {
        // Get form input data
        $id = $this->input->post('id');
        $nama_supplier = $this->input->post('nama_supplier');
        $alamat_supplier = $this->input->post('alamat_supplier');
        $telp_supplier = $this->input->post('telp_supplier');
        
    
        // Perform database insertion
        $data_input = array(
            'nama_supplier' => $nama_supplier,
            'alamat_supplier' => $alamat_supplier,
            'telp_supplier' => $telp_supplier,
            
        );
        
        $result = array(
            'status' => true,
            'data' => $data_input
        );
        echo json_encode($result);

        $this->supplier_model->update_doc($id,$data_input);

        }
        
    
}

    