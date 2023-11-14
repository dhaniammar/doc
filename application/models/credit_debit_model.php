<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class credit_debit_model extends CI_Model {

    public function get_list(){
        return $this->db->get("credit_debit")->result();
    }


}


?>