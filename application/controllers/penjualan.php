<?php 

class penjualan extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        
    }

    public function index() 
    {   
        $data = array(
            'title' => 'List Penjualan'
        );
        $this->load->view('header');
        $this->load->view('penjualan/list', $data);
        $this->load->view('footer');
    }

    public function form(){
        $data_customer = $this->db->get('customer')->result();
        $data = array(
            'title' => 'Form Penjualan',
            'customers' => $data_customer
        );
        $this->load->view('header');
        $this->load->view('penjualan/form', $data);
        $this->load->view('footer');

    }

    public function get_produk(){
        $data_produk = $this->db->get('produk')->result();
        if($data_produk){
            $data = array(
                'status' => true,
                'data' => $data_produk
            );
        }else{
            $data = array(
                'status' => false,
                'data' => null
            );
        }
        echo json_encode($data);
    }
}

?>