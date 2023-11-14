<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Credit_Debit extends CI_Controller {


    public function __construct(){

        parent::__construct();
        if ($this->session->userdata('login') != 1){
            redirect('login');
        }
        $this->load->model('credit_debit_model', 'cdm');
    }

    public function index()
    {  
        $this->load->model('penjualan_model', 'penjualan');
        $debit = $this->penjualan->get_resume_debit();
        $this->load->model('pembelian_model', 'pembelian');
        $credit = $this->pembelian->get_resume_credit();
        $data_credit_debit = $this->cdm->get_list();
        $data = array(
            'title' => 'Credit Debit',
            'data_cd' => $data_credit_debit,
            'debit' => $debit,
            'credit' => $credit
        );

        $this->load->view('header');
        $this->load->view('credit_debit/list', $data);
        $this->load->view('footer');


    }

}






?>