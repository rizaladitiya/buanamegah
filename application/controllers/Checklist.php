<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('checklist_model','',TRUE);
	}
	
	
	function viewall()
	{
		$jenis=$this->checklist_model->get_by_all()->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	
	function viewtgl()
	{
		
		$from = (!empty($from)) ? $this->input->post('from') : date('Y-m-d H:i:s');
		$to = (!empty($to)) ? $this->input->post('to') : date('Y-m-d H:i:s');
		$jenis=$this->checklist_model->get_by_tgl($from,$to)->result();
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	
	function viewtgluser()
	{
		if(empty($this->input->post('from'))){
			$from = date('Y-m-d');
		}else{
			$from = $this->input->post('from');
		}
		if(empty($this->input->post('to'))){
			$to = date('Y-m-d');
		}else{
			$to = $this->input->post('to');
		}
		if(empty($this->input->post('user'))){
			$user="";
		}else{
			$user=$this->input->post('user');
		}
		$jenis=$this->checklist_model->get_by_tgl_user($from,$to,$user)->result();
		
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($jenis));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	
	function add()
	{
		$checklist['main_wiring']=$this->input->post('main_wiring');
		$checklist['user']=$this->input->post('user');
		$checklist['label']=filter_var($this->input->post('label'),FILTER_VALIDATE_BOOLEAN);
		$checklist['wrapping']=filter_var($this->input->post('wrapping'),FILTER_VALIDATE_BOOLEAN);
		$checklist['regulator']=filter_var($this->input->post('regulator'),FILTER_VALIDATE_BOOLEAN);
		$checklist['keterangan']=$this->input->post('keterangan');
		$checklist['waktu']=date('Y-m-d H:i:s');
		$checklist['tanggal']=date('Y-m-d');
		if(!empty($checklist['main_wiring']))
		{
			$id=$this->checklist_model->add($checklist);
		}else{
			$id=0;
		}
		if($id!=0){
			$result=array('status'=>'success',
						'id'=>$id);
		}else{
			$result=array('status'=>'error',
						'id'=>0);
		}
		$this->output->set_content_type('application/json');
		$callback = $this->input->get('callback',TRUE);
		if(empty($callback)){
			$this->output->set_output(json_encode($result));
		}else{
			$this->output->set_output($callback."(".json_encode($jenis).")");
		}
	}
	
	function last()
	{
	$jenis=$this->checklist_model->get_by_last()->result();
	$this->output->set_content_type('application/json');
	$callback = $this->input->get('callback',TRUE);
	if(empty($callback)){
		$this->output->set_output(json_encode($jenis));
	}else{
		$this->output->set_output($callback."(".json_encode($jenis).")");
	}
	}
	
	function search()
	{
	$keyword = $this->input->post('keyword');
	$jenis=$this->checklist_model->get_search($keyword)->result();
	$this->output->set_content_type('application/json');
	$callback = $this->input->get('callback',TRUE);
	if(empty($callback)){
		$this->output->set_output(json_encode($jenis));
	}else{
		$this->output->set_output($callback."(".json_encode($jenis).")");
	}
	}
}
