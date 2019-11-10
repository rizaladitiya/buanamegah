<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusrun extends CI_Controller {

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
		$this->load->model('statusrun_model','',TRUE);
		error_reporting(0);
	}
	
	
	function viewall()
	{
	$jenis=$this->statusrun_model->get_by_all()->result();
	$this->output->set_content_type('application/json');
	$callback = $this->input->get('callback',TRUE);
	if(empty($callback)){
		$this->output->set_output(json_encode($jenis));
	}else{
		$this->output->set_output($callback."(".json_encode($jenis).")");
	}
	}
	
	
}
