<?php 

    class Home extends CI_Controller{

        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
        } 

        public function index() {
            if( $this->session->userdata('id_user') != null ){
                $data['judul'] = '' ;
                $data['header'] = 'Dashboard' ;
                $data['bread'] = '
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                ' ;
                $this->load->view('temp/header', $data) ;
                $this->load->view('temp/dsbHeader') ;

                $this->load->view('home/index') ;

                $this->load->view('temp/dsbFooter') ;
                $this->load->view('temp/footer') ;
            }else{
                redirect("login") ;
            }
        }

        

    }
?>