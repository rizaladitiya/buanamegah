<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
	
		private $primary_key='id';
		private $table_name='laporan';
function __construct()
	{
		parent::__construct();
	}
function get_by_all(){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db->select();  
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db->order_by('id asc');
	return $this->db->get();
}
function get_by_id($id){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db->where('id',$id);
	return $this->db->get();
}
function get_by_tgl($tgl,$tgl2){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$where=array(
			'laporan.tanggal >='=> $tgl,
			'laporan.tanggal <='=> $tgl2
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_tgl_user($tgl,$tgl2,$user){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$where=array(
			'laporan.tanggal >='=> $tgl,
			'laporan.tanggal <='=> $tgl2,
			'laporan.user' => $user
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_last(){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db->order_by('id desc');
	$this->db->limit(10);
	return $this->db->get();
}
function get_search($keyword){
	$select=array(
				'laporan.id',
				'laporan.masalah',
				'laporan.tindakan',
				'laporan.koreksi',
				'laporan.keterangan',
				'laporan.main_wiring',
				'laporan.tanggal',
				'laporan.dari',
				'laporan.hingga',
				'laporan.user'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'laporan.main_wiring = main_wiring.id', 'left');
	$this->db->like('laporan.masalah',$keyword);
	$this->db->or_like('laporan.tindakan', $keyword);
	$this->db->or_like('laporan.koreksi', $keyword);
	$this->db->order_by('laporan.tanggal asc');
	$this->db->limit(10);
	return $this->db->get();
}
function add($data){
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function update($id,$data) {
	$this->db->where('id',$id);
	$this->db->update($this->table_name,$data);
}

}
