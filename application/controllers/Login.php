<?php 

    class Login extends CI_Controller{
        public function __construct()
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Login_model');
        }

        public function index()
        {
            $data['judul'] = 'Login '; 
            $data['header'] = 'Login'; 
            // $data['bread'] = 'Dashboard'; 

            if( $this->session->userdata('kunci') == null ){

                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header' , $data) ;
                    $this->load->view('login/index') ;
                    $this->load->view('temp/footer') ;
                }else{
                    $name = $this->input->post('username') ;
                    $pass = $this->input->post('password') ;
                    $this->Login_model->cekLogin($name, $pass) ;
                }
            }else{
                redirect("home") ;
            }
        }

        public function logout()
        {
            $this->session->sess_destroy() ;
            redirect("login") ;
        }
    }

?>