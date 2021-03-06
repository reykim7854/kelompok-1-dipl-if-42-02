<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Class Register
// Class untuk melakukan navigasi pada proses registrasi
class RegisterController extends CI_Controller {

    // Function __construct
    // Fungsi konstruktor pada class
    public function __construct()
    {
        parent::__construct();
        // Load model "registerModel"
        $this->load->model('RegisterModel');
    }

    // Function Index
    // Fungsi untuk menampilkan halaman register
	public function index()
	{
        $content['main_view'] = 'RegisterView';
        $this->load->view('Body', $content);
	}

    // Function register
    // Fungsi untuk mmelakukan proses registrasi
    public function register()
    {
        // Menentukan rules dari form registrasi
        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('password','password','required');
        
        // Jika rule form tidak terpenuhi maka load ulang halaman register
        if($this->form_validation->run() == false){
            redirect(base_url('RegisterController'));
        } else { // Else lakukan registrasi ke database
            $username = $this->input->post('username');
            $cek = $this->RegisterModel->check_username($username);
            if($cek){
                $data1 = [
                    'email' => $this->input->post('email', true),
                    'username' => $this->input->post('username', true),
                    'password' => $this->input->post('password', true),
                    'no_hp' => $this->input->post('nohp', true)
                ];

                $data2 = [
                    'nik' => $this->input->post('nik', true),
                    'username' => $this->input->post('username', true),
                    'no_rekening' => $this->input->post('norek', true),
                    'nama' => $this->input->post('fullname', true)
                ];
                $this->RegisterModel->add_user($data1, $data2);
                redirect(base_url('LoginController'));
            }
            else{
                redirect(base_url('RegisterController'));
            }
        }
    }
}
?>