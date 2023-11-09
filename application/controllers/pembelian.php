<?php 

class Pembelian extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') != 1){
            redirect('login');
        }
        $this->load->model('pembelian_model','pembelian');
    }

    public function index() 
    {   
        $data_pembelian = $this->pembelian->get_list();
        $data = array(
            'title'          => 'List pembelian',
            'data_pembelian' => $data_pembelian
        );
        $this->load->view('header');
        $this->load->view('pembelian/list', $data);
        $this->load->view('footer');
    }

    public function form(){
        $data_supplier = $this->db->get('supplier')->result();
        $data = array(
            'title' => 'Form pembelian',
            'suppliers' => $data_supplier
        );
        $this->load->view('header');
        $this->load->view('pembelian/form', $data);
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

    public function tambah_pembelian(){
        $post = $this->input->post();

        $tgl_jatuh_tempo = date('Y-m-d', strtotime($post['tgl_transaksi'] . ' +'.$post['tempo'].' day'));//tgl transaksi + tempo
        $randomNumber = rand(10000, 99999);
        $no_invoice = "INV-".date('md').$randomNumber;

        $data_transaksi = array(
            'no_invoice' => $no_invoice,
            'id_supplier' => $post['id_supplier'],
            'tgl_transaksi' => $post['tgl_transaksi'],
            'total_pembayaran' => $post['total_pembayaran'],
            'total_harga' => $post['total_pembelian'],
            'tgl_jatuh_tempo' => $tgl_jatuh_tempo,

        );

        $this->db->insert('pembelian', $data_transaksi);
        $id_pembelian = $this->db->insert_id();

        for ($i=0; $i < count ($post['id_produk']) ; $i++){
            $data_produk = array(
                'id_pembelian' => $id_pembelian,
                'id_produk' => $post['id_produk'][$i],
                'qty' => $post['qty'][$i],
                'diskon' => $post['diskon'][$i],
            );

            $this->db->insert('detail_pembelian', $data_produk);
            // Tambah Stok
            // Update Produk set stok=stok+qtypenjualan where id_porduk="idproduk"
            $this->db->query("UPDATE produk SET stok=stok+".$post['qty'][$i]." where id=".$post['id_produk'][$i]);

        }

        redirect('pembelian','refresh');
    }

    public function detail($id){
        // ambil data pembelian
        $pembelian        = $this->pembelian->get_pembelian($id);
        // ambil detail pembelian
        $detail_pembelian = $this->pembelian->get_detail_pembelian($id);
        // tampil data
        $data = array(
            'title' => 'Detail pembelian',
            'pembelian' => $pembelian,
            'detail_pembelian' => $detail_pembelian,
        );
        $this->load->view('header');
        $this->load->view('pembelian/detail', $data);
        $this->load->view('footer');
    }
    public function delete(){

        $id = $this->input->post('id');
        // delete detail
        $this->db->delete('detail_pembelian', array('id_pembelian' => $id));
        //delete pembelian
        $this->db->delete('pembelian', array('id' => $id));

        $hasil = array(
            'status' => true,
            'message' => ''

        );
        echo json_encode($hasil);

    }
}

?>