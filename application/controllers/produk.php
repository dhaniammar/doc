<?php

class Produk extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->model('produk_model');
    }

    public function index() {
        // Load data from the database
        $produk = $this->db->get('produk')->result();
        $data = array(
            'title' => 'List Produk',
            'produk' => $produk
        );
    
        $this->load->view('header');
        $this->load->view('produk/list', $data);
        $this->load->view('footer');
    }

    public function add_actions() {
        // Get form input data
        $nama_produk = $this->input->post('nama_produk');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $varian = $this->input->post('varian');
        $stok = $this->input->post('stok');

        $path = "produk";

        $config = array(
            'upload_path'  => './uploads/'.$path, //uploads/produk
            'allowed_types' => 'jpg|jpeg|png',
            'overwrite'    => false,
            'max_size'     => 5000
        );
        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('foto_produk')){
            //error
            $result = array(
                'status' => false,
                'message' => $this->upload->display_errors()
            );
    
            echo json_encode($result); die;
        }else{
            $data = $this->upload->data();
            $file_name = $data['file_name'];

        }
    
        // Perform database insertion
        $data_input = array(
            'nama_produk' => $nama_produk,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'varian' => $varian,
            'stok' => $stok,
            'foto_produk' => $file_name
        );
    
        // Insert data into the database
        $this->load->model('produk_model');
        $this->produk_model->insert_doc($data_input);

        // $this->db->insert('produk',$data);

        $result = array(
            'status' => true,
            'message' => ''
        );

        echo json_encode($result);
    

    }

    public function delete(){
        // // query delete
        // $this->db->query("DELETE FROM produk WHERE id=".$id);
        // // redirect
        // redirect('produk');

        $id = $this->input->post('id');
        $this->produk_model->delete_produk($id);

        $hasil = array(
            'status' => true,
            'message' => ''

        );
        echo json_encode($hasil);

    }

    public function edit_produk (){

        $id = $this->input->post('id');
        $where = array(
            'id'=>$id
        );
        $data = $this->db->get_where('produk', $where)->row();

        $result = array(
            'status' => true,
            'data' => $data
        );
        echo json_encode($result);
    }

    public function update() {
        // Get form input data
        $id = $this->input->post('id');
        $nama_produk = $this->input->post('nama_produk');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $varian = $this->input->post('varian');
        $stok = $this->input->post('stok');

        if(isset($_FILES['foto_produk']) && $_FILES['foto_produk']['error'] == 0){
            $path = "produk";

            $config = array(
                'upload_path'  => './uploads/'.$path, //uploads/produk
                'allowed_types' => 'jpg|jpeg|png',
                'overwrite'    => false,
                'max_size'     => 5000
            );
            $this->load->library('upload', $config);
            
            if(!$this->upload->do_upload('foto_produk')){
                //error
                $result = array(
                    'status' => false,
                    'message' => $this->upload->display_errors()
                );
        
                echo json_encode($result); die;
            }else{
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                
                $data_input = array(
                    'nama_produk' => $nama_produk,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'varian' => $varian,
                    'stok' => $stok,
                    'foto_produk' => $file_name
                );

            }
        }else{
            $data_input = array(
                'nama_produk' => $nama_produk,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'varian' => $varian,
                'stok' => $stok,
            );
        }
        
        $result = array(
            'status' => true,
            'data' => $data_input
        );
        echo json_encode($result);

        $this->produk_model->update_doc($id,$data_input);

        }
        
    
}

    