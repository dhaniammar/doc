<?php

class supplier_model extends CI_Model {

    public function insert_doc($data_input){
        $this->db->insert('supplier',$data_input);
    }
    
    public function update_doc($id,$data_input){
        $this->db->where('id', $id);
        $this->db->update('supplier', $data_input);
    }

    public function delete_supplier($id){
        $this->db->delete('supplier', array('id' => $id));
    }

}