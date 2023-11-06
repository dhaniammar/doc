<?php

class Customer extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->model('customer_model');
    }

    public function index() {
        // Load data from the database
        $customer = $this->db->get('customer')->result();
        $data = array(
            'title' => 'List Customer',
            'customer' => $customer
        );
    
        $this->load->view('header');
        $this->load->view('customer/list', $data);
        $this->load->view('footer');
    }

    public function add_actions() {
        // Get form input data
        $nama_customer = $this->input->post('nama_customer');
        $alamat_customer = $this->input->post('alamat_customer');
        $telp_customer = $this->input->post('telp_customer');
        
        // Perform database insertion
        $data_input = array(
            'nama_customer' => $nama_customer,
            'alamat_customer' => $alamat_customer,
            'telp_customer' => $telp_customer
            
        );
    
        // Insert data into the database
        $this->load->model('customer_model');
        $this->customer_model->insert_doc($data_input);

        // $this->db->insert('customer',$data);

        $result = array(
            'status' => true,
            'message' => ''
        );

        echo json_encode($result);
    

    }

    public function delete(){
        // // query delete
        // $this->db->query("DELETE FROM customer WHERE id=".$id);
        // // redirect
        // redirect('customer');

        $id = $this->input->post('id');
        $this->customer_model->delete_customer($id);

        $hasil = array(
            'status' => true,
            'message' => ''

        );
        echo json_encode($hasil);

    }

    public function edit_customer(){

        $id = $this->input->post('id');
        $where = array(
            'id'=>$id
        );
        $data = $this->db->get_where('customer', $where)->row();

        $result = array(
            'status' => true,
            'data' => $data
        );
        echo json_encode($result);
    }

    public function update() {
        // Get form input data
        $id = $this->input->post('id');
        $nama_customer = $this->input->post('nama_customer');
        $alamat_customer = $this->input->post('alamat_customer');
        $telp_customer = $this->input->post('telp_customer');
        
    
        // Perform database insertion
        $data_input = array(
            'nama_customer' => $nama_customer,
            'alamat_customer' => $alamat_customer,
            'telp_customer' => $telp_customer,
            
        );
        
        $result = array(
            'status' => true,
            'data' => $data_input
        );
        echo json_encode($result);

        $this->customer_model->update_doc($id,$data_input);

        }
        
    
}

    