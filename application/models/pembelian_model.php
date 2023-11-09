<?php

defined('BASEPATH') or exit('No direct script access allowed');

class pembelian_model extends CI_Model {

    public function get_list(){

        // SELECT pembelian.*, supplier.nama FROM pembelian JOIN supplier ON pembelian.id_supplier = supplier.id;
        $this->db->select("pembelian.*, supplier.nama_supplier");
        $this->db->from("pembelian");
        $this->db->join("supplier","pembelian.id_supplier=supplier.id");
        return $this->db->get()->result();

    }

    public function get_detail_pembelian($id_pembelian){
        $this->db->select("detail.id, detail.qty, detail.diskon, produk.nama_produk, produk.harga_beli, round((produk.harga_beli*detail.qty) - (produk.harga_beli*detail.diskon/100)) as total");
        $this->db->from("detail_pembelian detail");
        $this->db->join("produk", "detail.id_produk=produk.id");
        $this->db->where("detail.id_pembelian", $id_pembelian);
        return $this->db->get()->result();


    }

    public function get_pembelian($id){
        $this->db->select("pembelian.*, supplier.nama_supplier");
        $this->db->from("pembelian");
        $this->db->join("supplier","pembelian.id_supplier=supplier.id");
        $this->db->where("pembelian.id", $id);
        return $this->db->get()->row();
    }

    public function get_resume(){
        $this->db->select("sum(total_harga) as omset, count(id) as total_pembelian");
        $this->db->from("pembelian");
        return $this->db->get()->row();

    }
}







?>