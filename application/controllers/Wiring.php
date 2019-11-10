<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wiring extends CI_Controller {

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
		$this->load->model('wiring_model','',TRUE);
		$this->load->model('checklist_model','',TRUE);
		error_reporting(0);
	}
	
	
	function viewall()
	{
	$jenis=$this->wiring_model->get_by_all()->result();
	$this->output->set_content_type('application/json');
	$callback = $this->input->get('callback',TRUE);
	if(empty($callback)){
		$this->output->set_output(json_encode($jenis));
	}else{
		$this->output->set_output($callback."(".json_encode($jenis).")");
	}
	}
	
	function last()
	{
	$jenis=$this->wiring_model->get_by_last()->result();
	$this->output->set_content_type('application/json');
	$callback = $this->input->get('callback',TRUE);
	if(empty($callback)){
		$this->output->set_output(json_encode($jenis));
	}else{
		$this->output->set_output($callback."(".json_encode($jenis).")");
	}
	}
	
	function search2()
	{
	$keyword = $this->input->post('keyword');
	$jenis=$this->wiring_model->get_search($keyword)->result();
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
	$jenis=$this->wiring_model->get_search($keyword)->result();
	$hasil=array();
	foreach($jenis as $value){
		$lastchecked=$this->checklist_model->get_last_checked($value->id)->row()->tanggal;
		$lastuser=$this->checklist_model->get_last_checked($value->id)->row()->user;
		$hasil[]=array(
				'id'=>$value->id,
				'looptag'=>$value->looptag,
				'devicetag'=>$value->devicetag,
				'description'=>$value->description,
				'card_type'=>$value->card_type,
				'signal_type'=>$value->signal_type,
				'node'=>$value->node,
				'card'=>$value->card,
				'channel'=>$value->channel,
				'brand'=>$value->brand,
				'io_panel'=>$value->io_panel,
				'signal'=>$value->signal,
				'cc_panel'=>$value->cc_panel,
				'relay'=>$value->relay,
				'tb_set'=>$value->tb_set,
				'terminal'=>$value->terminal,
				'terminal2'=>$value->terminal2,
				'jb'=>$value->jb,
				'jb_terminal'=>$value->jb_terminal,
				'lastchecked'=>$lastchecked,
				'lastuser'=>$lastuser
		);
	}
	$this->output->set_content_type('application/json');
	$callback = $this->input->get('callback',TRUE);
	if(empty($callback)){
		$this->output->set_output(json_encode($hasil));
	}else{
		$this->output->set_output($callback."(".json_encode($hasil).")");
	}
	}
}
