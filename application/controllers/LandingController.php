<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// class untuk berhasil login
class LandingController extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('LandingModel');
    }
	
	public function index()
	{
        $content['main_view'] = 'LandingView';
				$content['data'] = $this->LandingModel->getAllPetisi();
        $this->load->view('Body', $content);
	}
}
?>