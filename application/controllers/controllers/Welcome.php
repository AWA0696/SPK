<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function layout()

	{
		// $this->load->view('sb_layout');
		$this->load->view('t/top');
		$this->load->view('content');
		$this->load->view('t/bottom');
	}

	public function redir()
	{
		$this->session->set_flashdata('msg_danger', 'error');
		redirect(base_url('Welcome/layout'));
	}

}
