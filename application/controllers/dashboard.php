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
            $penjualan = $this->penjualan->get_resume();
            $data = array(
                'title'    => 'Dashboard',
                'penjualan'=> $penjualan
            );
            $this->load->view('header');
            $this->load->view('dashboard', $data);
            $this->load->view('footer');








        }
    }
?>