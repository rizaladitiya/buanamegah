<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
		private $primary_key='id';
		private $table_name='user';
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
	$this->db->select();    
	$this->db->from($this->table_name);
	$this->db->where('id',$id);
	return $this->db->get();
}
function get_login($user,$password){
	$this->db->select();    
	$this->db->from($this->table_name);
	$where=array('user'=>$user,
				'password'=>$password
			);
	$this->db->where($where);
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
