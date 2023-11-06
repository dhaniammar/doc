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

    public function tambah_penjualan(){
        $post = $this->input->post();

        $tgl_jatuh_tempo = date('Y-m-d', strtotime($post['tgl_transaksi'] . ' +'.$post['tempo'].' day'));//tgl transaksi + tempo
        $randomNumber = rand(10000, 99999);
        $no_invoice = "INV-".date('md').$randomNumber;

        $data_transaksi = array(
            'no_invoice' => $no_invoice,
            'id_customer' => $post['id_customer'],
            'tgl_transaksi' => $post['tgl_transaksi'],
            'total_pembayaran' => $post['total_pembayaran'],
            'total_harga' => $post['total_penjualan'],
            'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
            'total_barang' => 0,

        );

        $this->db->insert('penjualan', $data_transaksi);
        $id_penjualan = $this->db->insert_id();

        for ($i=0; $i < count ($post['id_produk']) ; $i++){
            $data_produk = array(
                'id_penjualan' => $id_penjualan,
                'id_produk' => $post['id_produk'][$i],
                'qty' => $post['qty'][$i],
                'diskon' => $post['diskon'][$i],
            );

            $this->db->insert('detail_penjualan', $data_produk);

        }

        redirect('penjualan','refresh');
    }
}

?>