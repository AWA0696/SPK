<?php defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }
    public function index() 
    {
        // cek user yang login dan redirect ke masing-masing halaman


        if ($this->ion_auth->in_group('Database_spk')) { 
            redirect('Database_spk/perumahan');
        } else {
            $this->session->set_flashdata('msg_danger', 'Username atau Passwor yang anda masukan Salah!');
            redirect('Auth/login');
        }
    }
}