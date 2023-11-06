<?php

class produk_model extends CI_Model {

    public function insert_doc($data_input){
        $this->db->insert('produk',$data_input);
    }
    
    public function update_doc($id,$data_input){
        $this->db->where('id', $id);
        $this->db->update('produk', $data_input);
    }

    public function delete_produk($id){
        $this->db->delete('produk', array('id' => $id));
    }

}