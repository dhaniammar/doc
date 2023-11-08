<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Login extends CI_Controller {

        public function __construct(){

            parent::__construct();

        }

        public function index()
        {   
            if ($this->session->userdata('login') == 1){
                redirect('dashboard');
            }
            $this->load->view('login');

        }

        public function action(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $where = array(
                'username_user' => $username,
                'password_user' => $password
            );
            $user = $this->db->get_where('user', $where)->row();
            if ($user){
                $data_sesi = array(
                    'nama' => $user->nama_user,
                    'login' => 1,

                );

                $this->session->set_userdata($data_sesi);

                redirect('dashboard');
            }else{
                $this->session->set_flashdata('error', "Username atau password salah");
                redirect('login', 'refresh');
            }
        }

        public function logout(){
            $this->session->unset_userdata('login');
            $this->session->sess_destroy();
            redirect('login', 'refresh');
        }
    }
?>