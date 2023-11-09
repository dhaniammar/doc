<?php

class User extends CI_Controller {

    public function __construct(){

        parent::__construct();
        if ($this->session->userdata('login') != 1){
            redirect('login');
        }
        $this->load->model('user_model');
    }

    public function index() {
        // Load data from the database
        $user = $this->db->get('user')->result();
        $data = array(
            'title' => 'List user',
            'user' => $user
        );
    
        $this->load->view('header');
        $this->load->view('user/list', $data);
        $this->load->view('footer');
    }

    public function add_actions() {
        // Get form input data
        $nama_user = $this->input->post('nama_user');
        $username_user = $this->input->post('username_user');
        $password_user = $this->input->post('password_user');
        $tanggalcreate_user = $this->input->post('tanggalcreate_user');
        // Perform database insertion
        $data_input = array(
            'nama_user' => $nama_user,
            'username_user' => $username_user,
            'password_user' => $password_user,
            'tanggalcreate_user' => date('Y-m-d H:i:s'),
            
        );
    
        // Insert data into the database
        $this->load->model('user_model');
        $this->user_model->insert_doc($data_input);

        // $this->db->insert('user',$data);

        $result = array(
            'status' => true,
            'message' => ''
        );

        echo json_encode($result);
    

    }

    public function delete(){
        // // query delete
        // $this->db->query("DELETE FROM user WHERE id=".$id);
        // // redirect
        // redirect('user');

        $id = $this->input->post('id');
        $this->user_model->delete_user($id);

        $hasil = array(
            'status' => true,
            'message' => ''

        );
        echo json_encode($hasil);

    }

    public function edit_user(){

        $id = $this->input->post('id');
        $where = array(
            'id'=>$id
        );
        $data = $this->db->get_where('user', $where)->row();

        $result = array(
            'status' => true,
            'data' => $data
        );
        echo json_encode($result);
    }

    public function update() {
        // Get form input data
        $id = $this->input->post('id');
        $nama_user = $this->input->post('nama_user');
        $username_user = $this->input->post('username_user');
        $password_user = $this->input->post('password_user');
        $tanggalcreate_user = $this->input->post('tanggalcreate_user');
        
    
        // Perform database insertion
        $data_input = array(
            'nama_user' => $nama_user,
            'username_user' => $username_user,
            'password_user' => $password_user,
            'tanggalcreate_user' => date('Y-m-d H:i:s'),
        );
        
        $result = array(
            'status' => true,
            'data' => $data_input
        );
        echo json_encode($result);

        $this->user_model->update_doc($id,$data_input);

        }
        
    
}

    