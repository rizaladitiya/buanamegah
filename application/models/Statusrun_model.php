<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusrun_model extends CI_Model {
	
		private $primary_key='id';
		private $table_name='status_run';
function __construct()
	{
		parent::__construct();
	}
function get_by_all(){
	$select=array(
				'status_run.id',
				'status_run.name',
				'status_run.value',
				'status_run.lastupdate',
				'machine.name as machinename'
			);
	$this->db->select($select);  
	$this->db->from($this->table_name);
	$this->db->join('machine', 'machine.id = status_run.machine', 'inner');
	$this->db->order_by('machine.name asc');
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
function add($data){
	$this->db->insert($this->table_name,$data);
	return $this->db->insert_id();
}
function update($id,$data) {
	$this->db->where('id',$id);
	$this->db->update($this->table_name,$data);
}

}
