<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

    public function get_list(){

        // SELECT penjualan.*, customer.nama FROM penjualan JOIN customer ON penjualan.id_customer = customer.id;
        $this->db->select("penjualan.*, customer.nama_customer");
        $this->db->from("penjualan");
        $this->db->join("customer","penjualan.id_customer=customer.id");
        return $this->db->get()->result();

    }

    public function get_detail_penjualan($id_penjualan){
        $this->db->select("detail.id, detail.qty, detail.diskon, produk.nama_produk, produk.harga_jual, round((produk.harga_jual*detail.qty) - (produk.harga_jual*detail.diskon/100)) as total");
        $this->db->from("detail_penjualan detail");
        $this->db->join("produk", "detail.id_produk=produk.id");
        $this->db->where("detail.id_penjualan", $id_penjualan);
        return $this->db->get()->result();


    }

    public function get_penjualan($id){
        $this->db->select("penjualan.*, customer.nama_customer");
        $this->db->from("penjualan");
        $this->db->join("customer","penjualan.id_customer=customer.id");
        $this->db->where("penjualan.id", $id);
        return $this->db->get()->row();
    }

    public function get_resume(){
        $this->db->select("sum(total_harga) as omset, count(id) as total_penjualan");
        $this->db->from("penjualan");
        return $this->db->get()->row();

    }
}







?>