<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Dashboard extends CI_Controller {


        public function __construct(){

            parent::__construct();
            if ($this->session->userdata('login') != 1){
                redirect('login');
            }
        }

        public function index()
        {   
            
            $this->load->model('penjualan_model', 'penjualan');
            $data_grafik = $this->db->query("SELECT sum(total_harga) as total, MONTH(tgl_transaksi) as bulan FROM penjualan GROUP BY MONTH(tgl_transaksi)")->result();
            $penjualan = $this->penjualan->get_resume();
            $this->load->model('pembelian_model', 'pembelian');
            $pembelian = $this->pembelian->get_resume();
            $data = array(
                'title'    => 'Dashboard',
                'penjualan'=> $penjualan,
                'pembelian'=> $pembelian,
                'data_grafik' => $data_grafik
            );

            $this->load->view('header');
            $this->load->view('dashboard', $data);
            $this->load->view('footer');

        }

    }
?>