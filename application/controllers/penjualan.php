<?php 

class Penjualan extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('login') != 1){
            redirect('login');
        }
        $this->load->model('penjualan_model','penjualan');
    }

    public function index() 
    {   
        $data_penjualan = $this->penjualan->get_list();
        $data = array(
            'title'          => 'List Penjualan',
            'data_penjualan' => $data_penjualan
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

            // Kurangi Stok
            // Update Produk set stok=stok-qtypenjualan where id_porduk="idproduk"
            $this->db->query("UPDATE produk SET stok=stok-".$post['qty'][$i]." where id=".$post['id_produk'][$i]);

        }
        

        redirect('penjualan','refresh');

        // Kurangi Stok
        // Update Produk set stok=stok-qtypenjualan where id_porduk="idproduk"
        
        

    }

    public function detail($id){
        // ambil data penjualan
        $penjualan        = $this->penjualan->get_penjualan($id);
        // ambil detail penjualan
        $detail_penjualan = $this->penjualan->get_detail_penjualan($id);
        //ambil data history pembayaran
        $pembayaran = $this->db->get_where('credit_debit', ['id_penjualan_pembelian'=>$id])->result();
        // tampil data
        $data = array(
            'title' => 'Detail Penjualan',
            'penjualan' => $penjualan,
            'detail_penjualan' => $detail_penjualan,
            'history_pembayaran' => $pembayaran
        );
        $this->load->view('header');
        $this->load->view('penjualan/detail', $data);
        $this->load->view('footer');
    }
    public function delete(){

        $id = $this->input->post('id');
        // delete detail
        $this->db->delete('detail_penjualan', array('id_penjualan' => $id));
        //delete penjualan
        $this->db->delete('penjualan', array('id' => $id));

        $hasil = array(
            'status' => true,
            'message' => ''

        );
        echo json_encode($hasil);

    }

    public function faktur($id){
        // ambil data penjualan
        $penjualan        = $this->penjualan->get_penjualan($id);
        // ambil detail penjualan
        $detail_penjualan = $this->penjualan->get_detail_penjualan($id);
        // tampil data
        $data = array(
            'title' => 'Faktur/Invoice',
            'penjualan' => $penjualan,
            'detail_penjualan' => $detail_penjualan,
        );

        $this->load->view('penjualan/faktur', $data);
    }

    public function surat($id){
        // ambil data penjualan
        $penjualan        = $this->penjualan->get_penjualan($id);
        // ambil detail penjualan
        $detail_penjualan = $this->penjualan->get_detail_penjualan($id);
        // tampil data
        $data = array(
            'title' => 'Surat Jalan',
            'penjualan' => $penjualan,
            'detail_penjualan' => $detail_penjualan,
        );

        $this->load->view('penjualan/surat', $data);
    }

    public function pembayaran(){
        $id_penjualan = $this->input->post('id_penjualan');
        $total_bayar  = $this->input->post('total_bayar');
        $data = array(
            'debit' => $total_bayar,
            'id_penjualan_pembelian' => $id_penjualan,
            'tgl_transaksi' => date('Y-m-d')
        );
        $this->db->insert('credit_debit', $data);
        $this->db->query("UPDATE penjualan SET total_pembayaran=total_pembayaran+".$total_bayar." WHERE id=".$id_penjualan);

        $response = array(
            'status' => true,   
        );

        echo json_encode($response);
    }
    
}

?>