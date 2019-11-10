<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist_model extends CI_Model {
	
		private $primary_key='id';
		private $table_name='checklist';
function __construct()
	{
		parent::__construct();
	}
function get_by_all(){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db->select();  
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->order_by('id asc');
	return $this->db->get();
}
function get_by_id($id){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->where('id',$id);
	return $this->db->get();
}
function get_last_checked($id){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->where('checklist.main_wiring',$id);
	$this->db->order_by('tanggal desc');
	$this->db->limit(1);
	return $this->db->get();
}
function get_by_tgl($tgl,$tgl2){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$where=array(
			'checklist.tanggal >='=> $tgl,
			'checklist.tanggal <='=> $tgl2,
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_tgl_user($tgl,$tgl2,$user){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$where=array(
			'checklist.tanggal >='=> $tgl,
			'checklist.tanggal <='=> $tgl2,
			'checklist.user' => $user
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->where($where);
	return $this->db->get();
}
function get_by_last(){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->order_by('id desc');
	$this->db->limit(10);
	return $this->db->get();
}
function get_search($keyword){
	$select=array(
				'checklist.id',
				'main_wiring.devicetag',
				'main_wiring.description',
				'plc.brand',
				'plc.name',
				'checklist.user',
				'checklist.regulator',
				'checklist.keterangan',
				'checklist.label',
				'checklist.wrapping',
				'checklist.waktu',
				'checklist.tanggal'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('main_wiring', 'checklist.main_wiring = main_wiring.id', 'left');
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'left');
	$this->db->like('main_wiring.devicetag',$keyword);
	$this->db->or_like('main_wiring.looptag', $keyword);
	$this->db->or_like('main_wiring.description', $keyword);
	$this->db->order_by('main_wiring.devicetag asc');
	$this->db->limit(30);
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
