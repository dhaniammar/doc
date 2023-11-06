<?php

class Master_doc_model extends CI_Model {

    public function insert_doc($data_input){
        $this->db->insert('document',$data_input);
    }
    
}