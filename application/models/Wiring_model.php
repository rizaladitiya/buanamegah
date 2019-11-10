<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wiring_model extends CI_Model {
	
		private $primary_key='id';
		private $table_name='main_wiring';
function __construct()
	{
		parent::__construct();
	}
function get_by_all(){
	/*
	$select=array(
				'id',
				'description'
			);
	$this->db->select($select);  
	*/	
	$this->db->select();  
	$this->db->from($this->table_name);
	$this->db->order_by('id asc');
	return $this->db->get();
}
function get_by_id($id){
	$select=array(
				'id',
				'looptag',
				'devicetag',
				'description',
				'card_type',
				'signal_type',
				'node,card',
				'channel',
				'plc',
				'io_panel',
				'signal',
				'cc_panel',
				'relay',
				'tb_set',
				'terminal',
				'terminal2',
				'jb',
				'jb_terminal'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->where('id',$id);
	return $this->db->get();
}
function get_by_last(){
	$select=array(
				'id',
				'looptag',
				'devicetag',
				'description',
				'card_type',
				'signal_type',
				'node',
				'card',
				'channel',
				'plc',
				'io_panel',
				'signal',
				'cc_panel',
				'relay',
				'tb_set',
				'terminal',
				'terminal2',
				'jb',
				'jb_terminal'
			);
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->order_by('id desc');
	$this->db->limit(10);
	return $this->db->get();
}
function get_search($keyword){
	
	$select=array(
				'main_wiring.id',
				'main_wiring.looptag',
				'main_wiring.devicetag',
				'main_wiring.description',
				'main_wiring.card_type',
				'main_wiring.signal_type',
				'main_wiring.node',
				'main_wiring.card',
				'main_wiring.channel',
				'plc.brand',
				'main_wiring.io_panel',
				'main_wiring.signal',
				'main_wiring.cc_panel',
				'main_wiring.relay',
				'main_wiring.tb_set',
				'main_wiring.terminal',
				'main_wiring.terminal2',
				'main_wiring.jb',
				'main_wiring.jb_terminal'
			);
	
	$this->db->select($select);    
	$this->db->from($this->table_name);
	$this->db->join('plc', 'plc.id = main_wiring.plc', 'inner');
	$this->db->like('main_wiring.devicetag',$keyword);;
	$this->db->or_like('main_wiring.looptag', $keyword);
	$this->db->or_like('main_wiring.description', $keyword);
	$this->db->order_by('main_wiring.devicetag asc');
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
