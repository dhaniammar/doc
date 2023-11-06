<?php

class customer_model extends CI_Model {

    public function insert_doc($data_input){
        $this->db->insert('customer',$data_input);
    }
    
    public function update_doc($id,$data_input){
        $this->db->where('id', $id);
        $this->db->update('customer', $data_input);
    }

    public function delete_customer($id){
        $this->db->delete('customer', array('id' => $id));
    }

}